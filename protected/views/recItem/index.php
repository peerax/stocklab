<?php

echo '<h1>บันทึกรับวัสดุ</h1>';
//form หลัก
$this->renderPartial('_form1', array(
    'model' => $model,
    'qCom' => $qCom,
        )
);

//form ย่อย
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'type' => 'verticalForm',
    'htmlOptions' => array('class' => 'well'),
        )
);
echo '<table><tr><td align="center" width ="30">ชื่อวัสดุ</td><td align="center">จำนวน</td><td align="center">หน่วยนับ</td></tr><tr><td>';
$this->widget('CAutoComplete', array(
    'name' => 'item_name',
    'url' => array('RecItem/AutoCompleteLookup'),
    'max' => 10,
    'minChars' => 1,
    'delay' => 500,
    'matchCase' => false,
    'htmlOptions' => array('size' => '40'),
    'methodChain' => ".result(function(event,item){\$(\"#item_id\").val(item[1]);
                                                          \$(\"#item_pack\").val(item[2]);
             						  \$(\"#item_pack1\").val(item[2]);})"
));
echo CHtml::hiddenField('item_id');
echo '</td><td>' . CHtml::textField('amnt');
echo '</td><td>' . CHtml::textField('item_pack1', '', array('disabled' => TRUE));
echo CHtml::hiddenField('item_pack');
echo '</td></tr><tr><td align="center">ราคา/หน่วย</td><td align="center">Lot</td><td align="center">Exp date</td></tr><tr><td>' . CHtml::textField('price') ;
echo '</td><td>' . CHtml::textField('lot') . '</td><td>';
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
   'language' => 'th',
    'name' => 'exp_date',
    'id' => 'exp_date',
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
echo '</td></tr></table>';
echo CHtml::ajaxLink(
        "+เพิ่มรายการ", 
        array('RecItem/addTemp'), 
        array('update' => '#req_result',
              'url' => 'RecItem/addTemp',
              'type' => 'POST',
              'complete' => 'function(){
						document.getElementById("item_name").value = "";
						document.getElementById("item_pack").value = "";
						document.getElementById("amnt").value = "";
						document.getElementById("price").value = "";
						document.getElementById("item_id").value = "";
						document.getElementById("lot").value = "";
						document.getElementById("exp_date").value = "";
						document.getElementById("item_name").focus();
                    }'
        )
);
$this->endWidget();

//ตารางแสดงสินค้าที่เอาลงแล้ว
echo '<div id="req_result">';
?>
