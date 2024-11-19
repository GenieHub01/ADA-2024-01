<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
    'Users'
);

$this->menu=array(
    array('label'=>'Create User', 'url'=>array('create')),
);

?>
<div class="col-md-12 company-list">

    <h3>Manage Users</h3>

    <?= CHtml::link('Create', ['create'], ['class' => 'btn btn-success']); ?>

    <?php $this->widget('booster.widgets.TbGridView', array(
        'id'=>'user-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'columns'=>array(
            'f_name',
            'l_name',
            'email',
            'discount',
            'expiry',
            array(
                'class'=>'CButtonColumn',
            ),
        ),
    )); ?>
</div>
