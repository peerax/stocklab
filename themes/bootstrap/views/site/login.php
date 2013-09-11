<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - เข้าระบบ';
$this->breadcrumbs=array(
	'เข้าระบบ',
);
?>

<h1>เข้าระบบ</h1>

<p>กรุณากรอกให้ถูกต้องเพื่อเข้าระบบ</p>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form',
    'type'=>'horizontal',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">ช่องที่มี <span class="required">*</span> ต้องกรอกข้อมูล.</p>

	<?php echo $form->textFieldRow($model,'username'); ?>

	<?php echo $form->passwordFieldRow($model,'password'); ?>

	<?php echo $form->checkBoxRow($model,'rememberMe'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'เข้าระบบ',
        )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
