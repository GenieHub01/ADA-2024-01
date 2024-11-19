<?php
/* @var $this PlanController */
/* @var $model Plan */

$this->breadcrumbs=array(
	'Subscriptions'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create', 'url'=>array('create')),
);

?>
<div class="col-md-12 company-list">

    <h3>Subscriptions</h3>

    <?= CHtml::link('Create', ['create'], ['class' => 'btn btn-success']); ?>

    <?php $this->widget('booster.widgets.TbGridView', array(
        'id'=>'plan-grid',
        'dataProvider'=>$model->search(),
        'columns'=>array(
            'name',
            [
                'name' => 'package',
                'value' => function ($model) {
                    return Price::model()->findByPk($model->package)->name;
                },
            ],
            [
                'name' => 'interval',
                'value' => '$data->intervalList[$data->interval]',
            ],
            'amount',
            'currency',
            [
                'class'=>'CButtonColumn',
                'template' => '{update}{delete}',
            ],
        ),
    )); ?>

</div>
