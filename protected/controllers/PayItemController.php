<?php

class PayItemController extends Controller
{
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('index', 'update', 'delete', 'AutoCompleteLookup', 'AddTemp','Savebill'),
                'expression' => 'Yii::app()->user->isAdmin()',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
        public function actionIndex() {
        unset(Yii::app()->session['cart']);
        unset(Yii::app()->session['count']);
        $cart = array();
        $this->render('index');
    }
    
        // Autocomplete ชื่อสินค้า
    public function actionAutoCompleteLookup() {
        if (Yii::app()->request->isAjaxRequest && isset($_GET['q'])) {
            $name = "%" . $_GET['q'] . "%";
            $sql = "SELECT stock_id,item_amnt,item_price,s.item_id,item_name,concat(item_name,' (หมดอายุ:',s.item_exp,')') as exp_date,unit_name 
                       FROM  ls_stock s left outer join ls_item i on i.Item_id = s.item_id 
                             left outer join ls_unit p on p.unit_id=i.unit_id 
                       where item_name like :name and item_amnt>0
                       order by item_name,s.item_exp";
            $qitem = Yii::app()->db->createCommand($sql);
            $qitem->bindParam(":name", $name, PDO::PARAM_STR);
            $ritem = $qitem->query();
            $returnVal = '';
            foreach ($ritem as $items) {
                $returnVal .=
                        $items["exp_date"] . '|'
                        . $items["item_id"] . '|'
                        . $items["unit_name"] . '|'
                        . $items["item_price"] . '|'
                        . $items["item_amnt"] . '|'
                        . $items["stock_id"] . "\n";
            }
            echo $returnVal;
        }
    }
    
    public function actionAddTemp() {
        $cc = Yii::app()->session['count'];
        $cart = Yii::app()->session['cart'];
        if (isset($_GET['ajax'])) {
            
        } else {

            if ($cc == 0) {
                $cc = 0;
            };
            $arr = array('count' => $cc,
                'item_id' => $_POST['item_id'],
                'item_name' => $_POST['item_name'],
                'item_pack' => $_POST['item_pack'],
                'amnt' => $_POST['amnt'],
                'price' => $_POST['price'],
                'stock_id' => $_POST['stock_id']
            );
            Yii::app()->session['count'] = $cc + 1;
            if ($cart == null) {
                $cart[] = $arr;
            } else {
                array_push($cart, $arr);
            }
        }
        Yii::app()->session['cart'] = $cart;

        $dataProvider = new CArrayDataProvider($cart, array(
            'keyField' => 'count',
        ));
        $this->renderPartial('_formDet', array('dataProvider' => $dataProvider), false, true);
    }
    
    public function actionDelete() {
        if ($_GET['id'] == '') {
            
        } else {
            $id = $_GET['id'];
            $cart = Yii::app()->session['cart'];

            for ($i = 0; $i < count($cart); $i++) {
                if ($cart[$i]['count'] == $id) {
                    array_splice($cart, $i, 1);
                }
            }
            Yii::app()->session['cart'] = $cart;
            $dataProvider = new CArrayDataProvider($cart, array(
                'keyField' => 'count',
            ));
            $this->renderPartial('_formDet', array('dataProvider' => $dataProvider), false, true);
        }
    }

    public function actionSavebill() {
        $cart = Yii::app()->session['cart'];
        if($cart == null){
            
        }else{
        
        $model = new LsPay;
        $model->pay_add_date = date('Y-m-d H:i:s');
        $model->u_id = Yii::app()->user->id;
        $model->paid = 0;
        $res = $model->save();
        $lid = $model->pay_id;

        if ($res) {
            echo 'บันทึกสำเร็จ';
        } else {
            echo 'Error: ' . print_r($model->getErrors(), true);
        }

        foreach ($cart as $cc) {

            $criteria = new CDbCriteria;
            $criteria->select = 'item_amnt';
            $criteria->condition = 'stock_id = :sid';
            $criteria->params = array(':sid' => $cc['stock_id'],
            );

            $nowst = LsStock::model()->find($criteria);

            if ($nowst >= $cc['amnt']) {

                $amnt =   $nowst['item_amnt'] - $cc['amnt'];

                $post = LsStock::model()->find('stock_id=:sid', array(':sid' => $cc['stock_id']));
                $post->item_amnt = $amnt;
                $post->stock_last_update = date('Y-m-d H:i:s');
                $post->save();
                
                $model = new LsPayDet;
                $model->amnt = $cc['amnt'];
                $model->stock_id = $cc['stock_id'];
                $model->pay_id = $lid;
                $res = $model->save();
            } else {

            }
        }
        Yii::app()->user->setFlash('success','บันทึกบิลสำเร็จ');
        }
        $this->redirect(array('PayItem/index'));
    }
}