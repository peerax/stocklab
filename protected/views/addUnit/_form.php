<h3>แก้ไขหน่วยนับ</h3>
<?php
$form = $this->beginWidget('ext.bootstrap.widgets.TbActiveForm',array(
    'type'=> 'inline',
    'htmlOptions' => array('class'=>'well'),
    'action' => array('AddUnit/update')
));
echo $form->hiddenField($model,'unit_id',array(
    'value'=>$unit_id));
echo $form->textFieldRow($model,'unit_name',array(
    'class'=>'span3 input-small',
    'value'=>$unit_name));
echo $form->error($model, "unit_name");
$this->widget('ext.bootstrap.widgets.TbButton',array(
   'buttonType' => 'submit',
    'label' => 'บันทึกแก้ไข'
    
));
$this->endWidget();
?>

