<?php

class RecItemController extends Controller {

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
        $qCom = LsCom::model()->findAll();
        $model = new LsRec;
        $this->render('index', array(
            'model' => $model,
            'qCom' => $qCom,
        ));
    }

    // Autocomplete ชื่อสินค้า
    public function actionAutoCompleteLookup() {
        if (Yii::app()->request->isAjaxRequest && isset($_GET['q'])) {
            $name = "%" . $_GET['q'] . "%";
            $sql = "SELECT item_id,item_name,unit_name 
                       FROM ls_item i left outer join ls_unit p on p.unit_id=i.unit_id 
                       where item_name like :name and in_use = 1
                       order by item_name";
            $qitem = Yii::app()->db->createCommand($sql);
            $qitem->bindParam(":name", $name, PDO::PARAM_STR);
            $ritem = $qitem->query();
            $returnVal = '';
            foreach ($ritem as $items) {
                $returnVal .=
                        $items["item_name"] . '|'
                        . $items["item_id"] . '|'
                        . $items["unit_name"] . "\n";
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
                'lot' => $_POST['lot'],
                'exp_date' => $_POST['exp_date']
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

    private function ConDate2DB($datestr) {
        $tt = explode('-', $datestr);
        $ret = $tt[2] . '-' . $tt[1] . '-' . $tt[0];
        return $ret;
    }

    public function actionSavebill() {
        $cart = Yii::app()->session['cart'];
        if($cart == null){}else{
        $sum = 0;

        $_POST['LsRec']['rec_date'] = RecItemController::ConDate2DB($_POST['LsRec']['rec_date']);

        $model = new LsRec;
        $model->attributes = $_POST['LsRec'];
        $model->rec_add_date = date('Y-m-d H:i:s');
        $model->u_id = Yii::app()->user->id;
        $res = $model->save();
        $lid = $model->rec_id;

        if ($res) {
            echo 'บันทึกสำเร็จ';
        } else {
            echo 'Error: ' . print_r($model->getErrors(), true);
        }

        foreach ($cart as $cc) {
            $cc['exp_date'] = RecItemController::ConDate2DB($cc['exp_date']);

            $criteria = new CDbCriteria;
            $criteria->select = 'item_amnt';
            $criteria->condition = 'item_id = :itid 
                                    and item_price = :price
                                    and item_lot = :lot';
            $criteria->params = array(':itid' => $cc['item_id'],
                                      ':price' => $cc['price'],
                                      ':lot' => $cc['lot']
            );

            $i = LsStock::model()->count($criteria);
            $nowst = LsStock::model()->find($criteria);

            if ($i > 0) {

                $amnt = $cc['amnt'] + $nowst['amnt'];

                $post = LsStock::model()->find('item_id=:idm and item_price = :pri and item_lot = :lot', array(':idm' => $cc['item_id']
                    , ':pri' => $cc['price'], ':lot' => $cc['lot']));
                $post->item_amnt = $amnt;
                $post->stock_last_update = date('Y-m-d H:i:s');
                $post->save();
                
                $model = new LsRecDet;
                $model->item_id = $cc['item_id'];
                $model->item_price = $cc['price'];
                $model->item_amnt = $cc['amnt'];
                $model->item_lot = $cc['lot'];
                $model->item_exp = $cc['exp_date'];
                $model->rec_id = $lid;
                $res = $model->save();
            } else {
                $model = new LsStock;
                $model->item_id = $cc['item_id'];
                $model->item_price = $cc['price'];
                $model->item_amnt = $cc['amnt'];
                $model->item_lot = $cc['lot'];
                $model->item_exp = $cc['exp_date'];
                $model->stock_last_update = date('Y-m-d H:i:s');
                $res = $model->save();

                $model = new LsRecDet;
                $model->item_id = $cc['item_id'];
                $model->item_price = $cc['price'];
                $model->item_amnt = $cc['amnt'];
                $model->item_lot = $cc['lot'];
                $model->item_exp = $cc['exp_date'];
                $model->rec_id = $lid;
                $res = $model->save();
            }
        }
        Yii::app()->user->setFlash('success','บันทึกบิลสำเร็จ');
        }
        $this->redirect(array('RecItem/index'));
    }

}