<h3>แก้ไขสินค้า</h3>
<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'type'=> 'verticalForm',
    'htmlOptions' => array('class'=>'well'),
    'action' => array('AddItem/update')
));
echo $form->hiddenField($model,'item_id',array(
    'value'=>$item_id));
echo $form->textFieldRow($model,'item_barcode',array(
    'value'=>$item_barcode));
echo $form->textFieldRow($model,'item_name',array(
    'value'=>$item_name));
echo $form->dropdownList($model,'unit_id',$unitcb,
        array('empty'=>'กรุณาระบุหน่วยนับ'
        ,'options'=>array($unit_id=>array('selected'=>'selected'))
            )
        );
echo $form->textFieldRow($model,'item_rop',array(
    'value'=>$item_rop));
echo $form->checkboxRow($model, 'in_use',array(
    'uncheckValue'=>0,'checked'=>$in_use));
$this->widget('ext.bootstrap.widgets.TbButton',array(
   'buttonType' => 'submit',
    'label' => 'บันทึกแก้ไข'
));
$this->endWidget();
?>

