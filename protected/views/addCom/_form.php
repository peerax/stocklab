<h3>แก้ไขหน่วยนับ</h3>
<?php
$form = $this->beginWidget('ext.bootstrap.widgets.TbActiveForm',array(
    'type'=> 'verticalForm',
    'htmlOptions' => array('class'=>'well'),
    'action' => array('AddCom/update')
));
echo $form->hiddenField($model,'com_id',array(
    'value'=>$com_id));
echo $form->textFieldRow($model,'com_name',array(
    'value'=>$com_name));
echo $form->textFieldRow($model,'com_addr',array(
    'value'=>$com_addr));
echo $form->textFieldRow($model,'com_tel',array(
    'value'=>$com_tel));
$this->widget('ext.bootstrap.widgets.TbButton',array(
   'buttonType' => 'submit',
    'label' => 'บันทึกแก้ไข'
    
));
$this->endWidget();
?>

