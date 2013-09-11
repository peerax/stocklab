<?php

foreach (Yii::app()->user->getFlashes() as $type => $flash) {
    echo "<div class='{$type}'>{$flash}</div>";
}
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'type' => '',
    'action' => array('RecItem/savebill'),
    'htmlOptions' => array('class' => 'well'),
        )
);
echo $form->textFieldRow($model, 'rec_bill_no', array(
    'placeholder' => 'กรุณาระบุเลขที่บิล',
    'value' => '')) . '<br>';
echo 'บริษัท  ' . $form->dropdownList($model, 'com_id', CHtml::listData($qCom, 'com_id', 'com_name')) . '<br>';
echo 'วันที่ในบิล ';
 $this->widget('zii.widgets.jui.CJuiDatePicker', array(
   'language' => 'th',
    'name' => 'LsRec[rec_date]',
    'id' => 'LsRec_rec_date',
    'model' => $model,
    // additional javascript options for the date picker plugin
    'options' => array(
        'showAnim' => 'slide',
        'dateFormat' => 'd-mm-yy',
        'changeMonth' => true,
        'changeYear' => true,
        'showOptions' => array('direction' => 'horizontal')
                ),
        )
);
$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType' => 'submit',
    'type'=>'primary',
    'label' => 'บันทึกบิลนี้',
        )
);
$this->endWidget();
?>
