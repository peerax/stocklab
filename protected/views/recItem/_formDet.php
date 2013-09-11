<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'det',
    'dataProvider' => $dataProvider,
    'columns' => array(
        array('name' => 'count', 'visible' => false),
        array('name' => 'item_id', 'visible' => false),
        array('name' => 'item_name', 'header' => 'รายการวัสดุ'),
        array('name' => 'amnt', 'header' => 'จำนวน'),
        array('name' => 'item_pack', 'header' => 'หน่วยบรรจุ'),
        array('name' => 'price', 'header' => 'ราคาต่อหน่วย'),
        array('name' => 'lot', 'header' => 'Lot No.'),
        array('name' => 'exp_date', 'header' => 'วันหมดอายุ'),
            array('class' => 'CButtonColumn',
            'template' => '{delete}',
            'buttons' => array(
                'delete' => array(
                    'url' => 'Yii::app()->controller->createUrl("RecItem/Delete",array("id"=>$data["count"]))',
                    'options' => array(// this is the 'html' array but we specify the 'ajax' element
                        'ajax' => array(
                            'url' => 'js:$(this).attr("href")', // ajax post will use 'url' specified above
                            'complete' => 'function(text,status) {
                                           $.fn.yiiGridView.update("det");
                                         }'
                        ),
                    ),
                ),
            ),
        ),
    )
        )
);
?>
