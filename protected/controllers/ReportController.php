<?php

class ReportController extends Controller {

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('view', 'recpay', 'repstock','reppay','viewpay'),
                'expression' => 'Yii::app()->user->isAdmin()',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    function ConCom($i) {
        $seid = Yii::app()->db->createCommand(
                        "SELECT com_name FROM ls_com where  com_id = " . $i)->queryScalar();
        return $seid;
    }

    function ConUser($i) {
        $seid = Yii::app()->db->createCommand(
                        "SELECT u_fname FROM ls_user where u_id = " . $i)->queryScalar();
        return $seid;
    }

    function ConDate($i) {
        $i = explode(' ', $i);

        $tt = explode('-', $i[0]);
        $tmonth = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        $tt[0]+=543;
        $ret = intval($tt[2]) . ' ' . $tmonth[intval($tt[1] - 1)] . ' ' . $tt[0];
        if (!empty($i[1])) {
            $ret = $ret . ' เวลา ' . $i[1] . ' น.';
        }
        return $ret;
    }

    public function actionRecpay() {
        $qCom = LsCom::model()->findAll();
        $data = new CActiveDataProvider('LsRec');
        $this->render('recpay', array(
            'dataProvider' => $data,
            'qCom' => $qCom,
        ));
    }

    public function actionRepstock() {
        $count = Yii::app()->db->createCommand('SELECT COUNT(*) FROM ls_stock')->queryScalar();
        $sql = 'SELECT stock_id,item_barcode,item_name,item_amnt,unit_name,item_price,item_lot,item_exp 
                    FROM ls_stock ls,ls_item i,ls_unit u
                    WHERE 
                          u.unit_id = i.unit_id AND 
                          i.item_id = ls.item_id and
                          ls.item_amnt >0';

        $dataProvider = new CSqlDataProvider($sql, array(
            'totalItemCount' => $count,
            'keyField' => 'stock_id',
            'sort' => array(
                'attributes' => array(
                    'item_name','item_exp'
                ),
            ),
            'pagination' => array(
                'pageSize' => 10,
            ),
        ));
        $this->render('repstock', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionView() {
        if (Yii::app()->request->isAjaxRequest) {
            $ids = $_GET['id'];
            $count = Yii::app()->db->createCommand('SELECT COUNT(*) FROM ls_rec_det where rec_id = "' . $ids . '"')->queryScalar();
            $sql = 'SELECT rec_det_id,item_barcode,item_name,item_amnt,unit_name,item_price,item_lot,item_exp 
                    FROM ls_rec_det ls,ls_item i,ls_unit u
                    WHERE rec_id ="' . $ids . '" and u.unit_id = i.unit_id AND i.item_id = ls.item_id';

            $dataProvider = new CSqlDataProvider($sql, array(
                'totalItemCount' => $count,
                'keyField' => 'rec_det_id',
                'pagination' => array(
                    'pageSize' => 10,
                ),
            ));
            $billno = Yii::app()->db->createCommand('SELECT rec_bill_no
                    FROM ls_rec r,ls_com c,ls_user u
                    WHERE rec_id ="' . $ids . '" and c.com_id = r.com_id AND u.u_id = r.u_id')->queryScalar();
            $billcom = Yii::app()->db->createCommand('SELECT com_name
                    FROM ls_rec r,ls_com c,ls_user u
                    WHERE rec_id ="' . $ids . '" and c.com_id = r.com_id AND u.u_id = r.u_id')->queryScalar();
            $billuname = Yii::app()->db->createCommand('SELECT u_fname
                    FROM ls_rec r,ls_com c,ls_user u
                    WHERE rec_id ="' . $ids . '" and c.com_id = r.com_id AND u.u_id = r.u_id')->queryScalar();
            $billdate = Yii::app()->db->createCommand('SELECT rec_date
                    FROM ls_rec r,ls_com c,ls_user u
                    WHERE rec_id ="' . $ids . '" and c.com_id = r.com_id AND u.u_id = r.u_id')->queryScalar();
            $billadd = Yii::app()->db->createCommand('SELECT rec_add_date
                    FROM ls_rec r,ls_com c,ls_user u
                    WHERE rec_id ="' . $ids . '" and c.com_id = r.com_id AND u.u_id = r.u_id')->queryScalar();

            $this->renderPartial('_view', array(
                'dataProvider' => $dataProvider,
                'billno' => $billno,
                'billcom' => $billcom,
                'billuname' => $billuname,
                'billdate' => $billdate,
                'billadd' => $billadd,
                'asDialog' => !empty($_GET['asDialog']),
                    ), false, true);
            Yii::app()->end();
        }
        else
            $this->render('recpay');
    }

        public function actionReppay() {
        $qCom = LsCom::model()->findAll();
        $data = new CActiveDataProvider('LsPay');
        $this->render('reppay', array(
            'dataProvider' => $data,
            'qCom' => $qCom,
        ));
    }

        public function actionViewpay() {
        if (Yii::app()->request->isAjaxRequest) {
            $ids = $_GET['id'];
            $count = Yii::app()->db->createCommand('SELECT COUNT(*) FROM ls_pay_det where pay_id = "' . $ids . '"')->queryScalar();
            $sql = 'SELECT pay_det_id,item_barcode,item_name,amnt,unit_name,item_price,item_lot,item_exp 
                    FROM ls_pay_det ls,ls_item i,ls_unit u,ls_stock st
                    WHERE pay_id ="' . $ids . '" and u.unit_id = i.unit_id AND i.item_id = st.item_id and st.stock_id=ls.stock_id';

            $dataProvider = new CSqlDataProvider($sql, array(
                'totalItemCount' => $count,
                'keyField' => 'pay_det_id',
                'pagination' => array(
                    'pageSize' => 10,
                ),
            ));
            $billuname = Yii::app()->db->createCommand('SELECT u_fname
                    FROM ls_pay r,ls_user u
                    WHERE pay_id ="' . $ids . '" and u.u_id = r.u_id')->queryScalar();
            $billadd = Yii::app()->db->createCommand('SELECT pay_add_date
                    FROM ls_pay r
                    WHERE pay_id =' . $ids )->queryScalar();

            $this->renderPartial('_viewpay', array(
                'dataProvider' => $dataProvider,
                'billno' => $ids,
                'billuname' => $billuname,
                'billadd' => $billadd,
                'asDialog' => !empty($_GET['asDialog']),
                    ), false, true);
            Yii::app()->end();
        }
        else
            $this->render('reppay');
    }
        }