<?php
/* @var $this AddUnitController */

$this->breadcrumbs=array(
	'ตั้งค่าบริษัท',
);

echo '<h1>ตั้งค่าบริษัท</h1>';
            foreach (Yii::app()->user->getFlashes() as $type=>$flash) {
                echo "<div class='{$type}'>{$flash}</div>";
            }	
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'type'=> 'verticalForm',
    'htmlOptions' => array('class'=>'well'),
));
echo $form->textFieldRow($model,'com_name',array(
    'class'=>'normal',
    'placeholder'=>'กรุณาระบุชื่อบริษัท',
    'value'=>'')); 
echo $form->textFieldRow($model,'com_addr',array(
    'class'=>'normal',
    'placeholder'=>'กรุณาระบุที่อยู่',
    'value'=>'')); echo $form->textFieldRow($model,'com_tel',array(
    'class'=>'normal',
    'placeholder'=>'กรุณาระบุเบอร์ติดต่อ',
    'value'=>'')).'<br>'; 
$this->widget('bootstrap.widgets.TbButton',array(
   'buttonType' => 'submit',
    'label' => 'บันทึก',
));

$this->endWidget();

$data1 = new CActiveDataProvider('LsCom');
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$data1,
    'columns'=>array(
        array(
            'name'=>'ชื่อบริษัท',
            'value'=>'$data->com_name',
        ),
        array(
            'name'=>'ที่อยู่บริษัท',
            'value'=>'$data->com_addr',
        ),
        array(
            'name'=>'เบอร์ติดต่อบริษัท',
            'value'=>'$data->com_tel',
        ),
        array(
            'header'=>'การแก้ไข',
            'class'=>'CButtonColumn',
            'template'=>'{delete}{update}',
            'deleteConfirmation'=>"js:'คุณต้องการลบข้อมูลบริษัทนี้ ('+$(this).parent().parent().children(':nth-child(2)').text()+')?'",
       'buttons'=>array(
                        'update'=>
                            array(
                                    'url'=>'$this->grid->controller->createUrl("update", 
                                        array("com_id"=>$data->primaryKey,"com_name"=>$data->com_name,"com_addr"=>$data->com_addr,"com_tel"=>$data->com_tel)
                                        )',
                                      ),
                            ),
        ),
    ),
));
?>
