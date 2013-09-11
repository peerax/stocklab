<?php

class AddItemController extends Controller {

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('index', 'update', 'delete'),
                'expression' => 'Yii::app()->user->isAdmin()',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        Yii::app()->user->setFlash('success', "");
        $model = new LsItem;
        if (isset($_POST["LsItem"])) {
            $model->_attributes = $_POST["LsItem"];
            $model->item_last_edit = date("Y-m-d H:i:s");
            if ($model->save()) {
                Yii::app()->user->setFlash('success', "บันทึกสำเร็จ!");
            }
        };

        $unitcb = AddItemController::CallUnitCB();

        $this->render('index', array(
            'model' => $model,
            'unitcb' => $unitcb,
        ));
    }

    public function actionDelete() {
        $model = new LsItem;
        if ($model->deleteByPk($_GET["id"])) {
            Yii::app()->user->setFlash('success', "ลบสำเร็จ!");
        }
        $unitcb = AddItemController::CallUnitCB();
        $this->render('index', array(
            'model' => $model,
            'unitcb' => $unitcb
        ));
    }

    public function actionUpdate() {

        $model = new LsItem;
        $unitcb = AddItemController::CallUnitCB();

        if (isset($_POST["LsItem"])) {
            $post = LsItem::model()->findByPk($_POST["LsItem"]["item_id"]);
            $post->item_name = $_POST["LsItem"]["item_name"];
            $post->item_barcode = $_POST["LsItem"]["item_barcode"];
            $post->unit_id = $_POST["LsItem"]["unit_id"];
            $post->item_last_edit = date("Y-m-d H:i:s");
            $post->item_rop = $_POST["LsItem"]["item_rop"];
            $post->in_use = $_POST["LsItem"]["in_use"];
            $post->save();
            $this->redirect(array('AddItem/index'));
        } else {
            $this->render('_form', array(
                'model' => $model,
                'item_name' => $_GET['item_name'],
                'item_barcode' => $_GET['item_barcode'],
                'item_id' => $_GET['item_id'],
                'item_rop' => $_GET['item_rop'],
                'unit_id' => $_GET['unit_id'],
                'in_use' => $_GET['in_use'],
                'unitcb' => $unitcb
            ));
        }
    }

    public function CallUnitCB() {
        $criteria = new CDbCriteria;
        $criteria->order = 'unit_name ASC';
        $unitcb = LsUnit::model()->findAll($criteria);
        $unitcb = CHtml::listData($unitcb, 'unit_id', 'unit_name');
        return $unitcb;
    }

}