<h1>รายงานวัสดุคงเหลือในคลัง <br> ณ วันที่ <?php echo Yii::app()->controller->conDate(date('Y-m-d H:i:s')); ?></h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'det',
    'dataProvider' => $dataProvider,
    'columns' => array(
        array('name' => 'item_barcode', 'header' => 'รหัสบาร์โค้ด',),
        array('name' => 'item_name', 'header' => 'รายการวัสดุ'),
        array('name' => 'item_amnt', 'header' => 'จำนวน',),
        array('name' => 'unit_name', 'header' => 'หน่วยนับ',),
        array('name' => 'item_price', 'header' => 'ราคา',),
        array('name' => 'item_lot', 'header' => 'Lot No.',),
        array('name' => 'item_exp', 'header' => 'วันหมดอายุ',),
    ),)
);

?>
