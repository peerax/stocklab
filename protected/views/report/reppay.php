<h1>รายงานเบิกวัสดุ</h1>

<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'det',
    'dataProvider' => $dataProvider,
    'columns' => array(
        array('name' => 'pay_add_date', 'header' => 'วันที่ในเบิก',
            'value' => 'CHtml::encode(Yii::app()->controller->conDate($data->pay_add_date))',),
        array('name' => 'pay_id', 'header' => 'เลขที่บิล'),
        array('name' => 'u_id', 'header' => 'ผู้บันทึกเบิก',
            'value' => 'CHtml::encode(Yii::app()->controller->conUser($data->u_id))',),
        array('class' => 'CButtonColumn',
            'template' => '{view}',
//--------------------- begin added --------------------------
            'buttons' => array('view' =>
                array(
                    'url' => 'Yii::app()->createUrl("Report/viewpay", array("id"=>$data->pay_id,"asDialog"=>1))',
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
