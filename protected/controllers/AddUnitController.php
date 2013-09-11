<?php

class AddUnitController extends Controller {

    public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','update','delete'),
				'expression'=>'Yii::app()->user->isAdmin()',    
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
 

    public function actionIndex() {
        Yii::app()->user->setFlash('บันทึก', "");
        $model = new LsUnit;
        if (isset($_POST["LsUnit"])) {
            $model->_attributes = $_POST["LsUnit"];
            if($model->save()){
            Yii::app()->user->setFlash('บันทึก', "บันทึกสำเร็จ!");
            }
        };
        $this->render('index', array(
            'model' => $model
        ));

    }
     public function actionDelete()
	{
         
            $model = new LsUnit; 
            $model->deleteByPk($_GET["id"]);
		$this->render('index',array(
                    'model' => $model
                ));
	}
        public function actionUpdate()
	{
            
            $model = new LsUnit; 
            if(isset($_POST["LsUnit"])){
                $post=  LsUnit::model()->findByPk($_POST["LsUnit"]["unit_id"]);
                $post->unit_name = $_POST["LsUnit"]["unit_name"];
                $post->save();
		$this->redirect('index.php?r=AddUnit/index');
            }else{
		$this->render('_form',array(
                    'model' => $model,
                    'unit_id' =>$_GET['unit_id'],
                    'unit_name' => $_GET['unit_name']
                ));
            }
            
	}
        public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}
?>