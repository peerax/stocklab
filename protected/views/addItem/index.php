<?php

/* @var $this AddUnitController */

$this->breadcrumbs = array(
    'ตั้งค่าวัสดุ',
);

echo '<h1>ตั้งค่าวัสดุ</h1>';
foreach (Yii::app()->user->getFlashes() as $type => $flash) {
    echo "<div class='{$type}'>{$flash}</div>";
}

Yii::app()->user->setFlash('success', '<strong>Re-order point</strong> คือปริมาณที่ต้องสั่งของมาเพิ่ม');
$this->widget('bootstrap.widgets.TbAlert', array(
    'block' => true, // display a larger alert block?
    'fade' => true, // use transitions?
    'closeText' => 'X', // close link text - if set to false, no close link is displayed
));
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'type' => 'verticalForm',
    'htmlOptions' => array('class' => 'well'),
        ));
echo $form->textFieldRow($model, 'item_barcode', array(
    'placeholder' => 'กรุณาระบุBarcode',
    'value' => ''));
echo $form->textFieldRow($model, 'item_name', array(
    'placeholder' => 'กรุณาระบุชื่อวัสดุ',
    'value' => ''));
echo $form->dropdownList($model, 'unit_id', $unitcb, array('prompt' => 'กรุณาระบุหน่วยนับ'));
echo $form->textFieldRow($model, 'item_rop', array(
    'placeholder' => 'กรุณาระบุ re-order point',
    'value' => '')) . '<br>';
echo $form->checkboxRow($model, 'in_use');
$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType' => 'submit',
    'label' => 'บันทึก',
));

$this->endWidget();

$data1 = new CActiveDataProvider('LsItem');
$this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider' => $data1,
    'columns' => array(
        array(
            'name' => 'Barcode',
            'value' => '$data->item_barcode',
        ),
        array(
            'name' => 'ชื่อวัสดุ',
            'value' => '$data->item_name',
        ),
        array(
            'name' => 'หน่วยนับ',
            'value' => 'conUnit($data->unit_id)',
        ),
        array(
            'name' => 'ปริมาณ Re-order point',
            'value' => '$data->item_rop',
        ),
        array(
            'type' => 'html',
            'name' => 'ใช้งาน',
            'value' => 'conUse($data->in_use)',
            ),
        array(
            'header' => 'การแก้ไข',
            'class' => 'CButtonColumn',
            'template' => '{delete}{update}',
            'deleteConfirmation' => "js:'คุณต้องการลบข้อมูลวัสดุนี้ ('+$(this).parent().parent().children(':nth-child(2)').text()+')?'",
            'buttons' => array(
                'update' =>
                array(
                    'url' => '$this->grid->controller->createUrl("update", 
                                        array("item_id"=>$data->primaryKey,
                                              "item_name"=>$data->item_name,
                                              "item_rop"=>$data->item_rop,
                                              "item_barcode"=>$data->item_barcode,
                                              "unit_id"=>$data->unit_id,
                                              "in_use"=>$data->in_use
                                              )
                                        )',
                ),
            ),
        ),
    ),
));

function ConUnit($i) {
    $seid = Yii::app()->db->createCommand(
                    "SELECT unit_name FROM ls_unit where unit_id = " . $i)->queryScalar();
    return $seid;
}
 function ConUse($i){
     if($i == '1'):
         $res = CHtml::image('images/on.png','',array('width'=>48,'height'=>48));

         else:
          $res = CHtml::image('images/off.png','',array('width'=>48,'height'=>48));
     endif;
     return $res;
 }
?>
