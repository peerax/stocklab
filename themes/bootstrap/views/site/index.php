<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
    'heading'=>CHtml::encode(Yii::app()->name),
)); ?>
<p>รุ่นทดสอบ V.1.0</p>
<p></p>
<?php $this->endWidget(); 
if(Yii::app()->user->isGuest):
    echo 'username : demo';
    echo 'password : demo';
endif;
    ; ?>

