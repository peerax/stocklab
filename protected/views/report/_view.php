
<?php
  $baseUrl = Yii::app()->baseUrl; 
  $cs = Yii::app()->getClientScript();
  $cs->registerCssFile($baseUrl.'/css/view_table.css');
//------------ add the CJuiDialog widget -----------------
if (!empty($asDialog)):
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(// the dialog
        'id' => 'dlg-recbill-det',
        'options' => array(
            'title' => 'รายการบิลเลขที่' . $billno,
            'autoOpen' => true,
            'modal' => true,
            'width' => 800,
            'height' => 470,
        ),
    ));

else:
    ?>

    <h1>รายการบิลเลขที่ #<?php echo $billno; ?></h1>

<?php
endif;
echo '<div class="CSSTableGenerator"><table>
    <thead>
    <tr>
      <th></th>
      <th></th>
    </tr>
  </thead><tr><td>';
echo 'บิลเลขที่ ' . $billno;
echo '</td><td>ผู้บันทึก ' . $billuname;
echo '</td></tr><tr><td>บริษัท ' . $billcom;

echo '</td><td>วันที่บันทึก ' . Yii::app()->controller->conDate($billadd);
echo '</td></tr><tr><td>วันที่ในบิล ' . Yii::app()->controller->conDate($billdate);

echo '</td></tr></table></div>';
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'id' => 'det1',
    'columns' => array(
        array('name'=> 'item_barcode', 
              'header' => 'รหัสบาร์โค้ด',),
        array('name'=> 'item_name', 
              'header' => 'รายการวัสดุ',),
        array('name'=> 'item_amnt', 
              'header' => 'จำนวน',
              'htmlOptions' => array('style'=>'text-align: right',),
             ),
        array('name'=> 'unit_name', 
              'header' => 'หน่วยบรรจุ',
            'htmlOptions' => array('style'=>'text-align: left',),
             ),
        array('name'=> 'item_price', 
              'header' => 'ราคาต่อหน่อย',
              'htmlOptions' => array('style'=>'text-align: right',),),
        array('name'=> 'item_lot', 
              'header' => 'Lot No.',
              'htmlOptions' => array('style'=>'text-align: right',),),
        array('name'=> 'item_exp', 
              'header' => 'วันหมดอายุ',),
    )
));
//-------- end of default code  ------------------
?>

<?php
//----------------------- close the CJuiDialog widget ------------
if (!empty($asDialog))
    $this->endWidget();
?>