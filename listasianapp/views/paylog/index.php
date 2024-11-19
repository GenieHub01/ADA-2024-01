<?php
/* @var $this PaylogController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Paylogs',
);
?>

<div class="col-md-12 company-list">
    <h3>Payments</h3>

    <?php $this->widget('booster.widgets.TbGridView', array(
        'id'=>'paylog-grid',
        'dataProvider'=>$dataProvider,
        'columns'=>array(
            [
                'name'=>'advert_id',
                'type'=>'raw',
                'value'=>'CHtml::link($data->advert_id, ["advert/view", "id"=>$data->advert_id])',
                'htmlOptions'=>[
                    'width'=>'10%',
                ],
            ],
            [
                'name'=>'amount',
                'value'=>'Yii::app()->numberFormatter->formatCurrency($data->amount, "GBP")',
                'htmlOptions'=>[
                    'style' => 'text-align:right;',
                    'width'=>'15%',
                ],
            ],
            'description',
            [
                'name' => 'create_time',
                'value' => 'Yii::app()->format->formatDateTime($data->create_time)',
                'htmlOptions'=>[
                    'width'=>'20%',
                ]
            ],
        ),
    )); ?>
</div>
