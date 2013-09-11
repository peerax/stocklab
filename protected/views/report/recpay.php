<h1>รายงานรับวัสดุ</h1>

<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'det',
    'dataProvider' => $dataProvider,
    'columns' => array(
        array('name' => 'rec_date', 'header' => 'วันที่ในบิล',
            'value' => 'CHtml::encode(Yii::app()->controller->conDate($data->rec_date))',),
        array('name' => 'rec_bill_no', 'header' => 'เลขที่บิล'),
        array('name' => 'com_id', 'header' => 'บริษัท',
            'value' => 'CHtml::encode(Yii::app()->controller->conCom($data->com_id))',),
        array('name' => 'u_id', 'header' => 'ผู้บันทึก',
            'value' => 'CHtml::encode(Yii::app()->controller->conUser($data->u_id))',),
        array('class' => 'CButtonColumn',
            'template' => '{view}',
//--------------------- begin added --------------------------
            'buttons' => array('view' =>
                array(
                    'url' => 'Yii::app()->createUrl("Report/view", array("id"=>$data->rec_id,"asDialog"=>1))',
                    'options' => array(
                        'ajax' => array(
                            'type' => 'POST',
                            // ajax post will use 'url' specified above 
                            'url' => "js:$(this).attr('href')",
                            'update' => '#id_view',
                        ),
                    ),
                ),
            ),
        )
    ),)
);


?>
<div class="modal-body" id='id_view'>
</div>