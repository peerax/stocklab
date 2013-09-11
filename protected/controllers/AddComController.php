<?php

class AddComController extends Controller {

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
        Yii::app()->user->setFlash('บันทึก', "");
        $model = new LsCom;
        if (isset($_POST["LsCom"])) {
            $model->_attributes = $_POST["LsCom"];
            $model->com_last_update = date("Y-m-d H:i:s");
            $model->u_id = Yii::app()->user->id;
            if ($model->save()) {
                Yii::app()->user->setFlash('บันทึก', "บันทึกสำเร็จ!");
            }
        };
        $this->render('index', array(
            'model' => $model
        ));
    }

    public function actionDelete() {
        $model = new LsCom;
        $model->deleteByPk($_GET["id"]);
        $this->render('index', array(
            'model' => $model
        ));
    }

    public function actionUpdate() {

        $model = new LsCom;
        if (isset($_POST["LsCom"])) {
            $post = LsCom::model()->findByPk($_POST["LsCom"]["com_id"]);
            $post->com_name = $_POST["LsCom"]["com_name"];
            $post->com_addr = $_POST["LsCom"]["com_addr"];
            $post->com_tel = $_POST["LsCom"]["com_tel"];
            $post->com_last_update = date("Y-m-d H:i:s");
            $post->u_id = Yii::app()->user->id;
            $post->save();
            $this->redirect('index.php?r=AddCom/index');
        } else {
            $this->render('_form', array(
            'model' => $model,
            'com_id' => $_GET['com_id'],
            'com_name' => $_GET['com_name'],
            'com_addr' => $_GET['com_addr'],
            'com_tel' => $_GET['com_tel']
            ));
        }
    }
}