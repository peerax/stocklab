<h1>ฟอร์มเบิกวัสดุจากคลัง</h1>
<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'type' => 'verticalForm',
    'action' => array('PayItem/Savebill'),
    'htmlOptions' => array('class' => 'well',                                            
        ),
        )
);
echo '<table><tr><td align="center" width ="30">ชื่อวัสดุ</td><td align="center">จำนวนที่เบิก</td><td align="center">คงเหลือในคลัง</td><td align="center">หน่วยนับ</td></tr><tr><td>';
$this->widget('CAutoComplete', array(
    'name' => 'item_name',
    'url' => array('PayItem/AutoCompleteLookup'),
    'max' => 10,
    'minChars' => 1,
    'delay' => 500,
    'matchCase' => false,
    'htmlOptions' => array('size' => '40'),
    'methodChain' => ".result(function(event,item){\$(\"#item_id\").val(item[1]);
                                                          \$(\"#item_pack\").val(item[2]);
                                                          \$(\"#price\").val(item[3]);
                                                          \$(\"#stock_id\").val(item[5]);
                                                          \$(\"#stock_amnt\").val(item[4]);
             						  \$(\"#item_pack1\").val(item[2]);})"

)
        );
echo CHtml::hiddenField('item_id');
echo '</td><td>' . CHtml::textField('amnt');
echo '</td><td>' . CHtml::textField('stock_amnt', '', array('disabled' => TRUE));
echo '</td><td>' . CHtml::textField('item_pack1', '', array('disabled' => TRUE));
echo CHtml::hiddenField('item_pack');
echo '</td></tr><tr><td align="center"></td><td align="center"></td><td align="center"></td></tr><tr><td>' . CHtml::hiddenField('price')  ;
echo '</td><td>' . CHtml::hiddenField('stock_id') . '</td><td>';
$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType' => 'submit',
    'type'=>'success',
    'label' => 'บันทึกบิลนี้',
        )
);
echo '</td></tr></table>';

echo CHtml::ajaxLink(
        "+เพิ่มรายการ", 
        array('PayItem/addTemp'), 
        array('update' => '#req_result',
              'url' => 'PayItem/addTemp',
              'type' => 'POST',
              'complete' => 'function(){
						document.getElementById("item_name").value = "";
						document.getElementById("item_pack").value = "";
						document.getElementById("amnt").value = "";
						document.getElementById("price").value = "";
						document.getElementById("item_id").value = "";
						document.getElementById("stock_id").value = "";
						document.getElementById("item_name").focus();
                    }'
        )
);
echo '<br>';

$this->endWidget();

//ตารางแสดงสินค้าที่เอาลงแล้ว
echo '<div id="req_result">';
?>