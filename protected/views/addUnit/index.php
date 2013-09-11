<?php
/* @var $this AddUnitController */

$this->breadcrumbs=array(
	'เพิ่มหน่วยนับ',
);

echo '<h1>ตั้งค่าหน่วยนับ</h1>';

            foreach (Yii::app()->user->getFlashes() as $type=>$flash) {
                echo "<div class='{$type}'>{$flash}</div>";
            }	
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'type'=> 'verticalForm',
    'htmlOptions' => array('class'=>'well'),
));
echo $form->textFieldRow($model,'unit_name',array(
    'class'=>'normal',
    'placeholder'=>'กรุณาระบุหน่วยนับ',
    'value'=>'')).'<br>'; 
$this->widget('bootstrap.widgets.TbLabel', array(
    'type'=>'info', // 'success', 'warning', 'important', 'info' or 'inverse'
    'label'=>'ต้องระบุและไม่ซ้ำ',
));
$this->widget('bootstrap.widgets.TbButton',array(
   'buttonType' => 'submit',
    'label' => 'บันทึก',
));

$this->endWidget();

$data1 = new CActiveDataProvider('LsUnit');
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$data1,
    'columns'=>array(
        array(
            'name'=>'ชื่อหน่วยนับ',
            'value'=>'$data->unit_name',
        ),
        array(
            'header'=>'การแก้ไข',
            'class'=>'CButtonColumn',
            'template'=>'{delete}{update}',
            'deleteConfirmation'=>"js:'คุณต้องการลบข้อมูลหน่วยนับนี้ ('+$(this).parent().parent().children(':nth-child(2)').text()+')?'",
       'buttons'=>array(
                        'update'=>
                            array(
                                    'url'=>'$this->grid->controller->createUrl("update", array("unit_id"=>$data->primaryKey,"unit_name"=>$data->unit_name))',
                                      ),
                            ),
        ),
    ),
));
?>