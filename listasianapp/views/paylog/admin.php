<?php
/* @var $this PaylogController */
/* @var $model Paylog */

$this->breadcrumbs=array(
    'Paylogs'
);

$this->menu=array(
    array('label'=>'List Paylog', 'url'=>array('index')),
    array('label'=>'Create Paylog', 'url'=>array('create')),
);
?>

<div class="col-md-12 company-list">
    <h3>Payments</h3>

    <?php $this->widget('booster.widgets.TbGridView', array(
        'id'=>'paylog-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'afterAjaxUpdate'=>'function(){
            $("#Paylog_user_id").select2({allowClear: true, width:"resolve"});
        }',
        'columns'=>array(
            [
                'name'=>'user_id',
                'value'=>'$data->user->email',
                'filter'=>$this->widget('booster.widgets.TbSelect2',
                    [
                        'model' => $model,
                        'attribute' => 'user_id',
                        'data' => CHtml::listData(User::model()->findAll(), 'id', 'email'),
                        'options' => [
                            'allowClear' => true,
                        ],
                        'htmlOptions' => [
                            'empty' => 'Select User',
                        ]
                    ],
                    true)
            ],
            [
                'name'=>'advert_id',
                'htmlOptions'=>[
                    'width'=>'5%'
                ]
            ],
            [
                'name'=>'amount',
                'htmlOptions'=>[
                    'width'=>'8%',
                    'style' => 'text-align:right;',
                ],
                'value' => 'Yii::app()->numberFormatter->formatCurrency($data->amount, "GBP")'
            ],
            'description',
            [
                'name' => 'create_time',
                'value' => 'Yii::app()->format->formatDateTime($data->create_time)',
                'htmlOptions'=>[
                    'width'=>'15%'
                ]
            ],
            array(
                'class'=>'CButtonColumn',
            ),
        ),
    )); ?>
</div>
