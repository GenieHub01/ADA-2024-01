<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
    $model->getName()
);
?>

<div class="col-md-12 ">

    <h3>User <?= $model->getName(); ?></h3>

    <?php $this->widget('booster.widgets.TbDetailView', array(
        'data'=>$model,
        'attributes'=>array(
            'f_name',
            'l_name',
            'email:email',
            'expiry:date',
            [
                'name' => 'phone',
                'type' => 'raw',
                'value' => CHtml::link(CHtml::encode($model->phone), 'tel:'.$model->phone, ['rel' => 'nofollow'])
            ],
            [
                'name' => 'notes',
                'type' => 'raw',
                'value' => nl2br(CHtml::encode($model->notes))
            ],
        ),
    )); ?>

</div>
