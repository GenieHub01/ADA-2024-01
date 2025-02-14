<?php
/* @var $this PaylogController */
/* @var $model Paylog */

$this->breadcrumbs=array(
    'Paylogs'=>array('index'),
    $model->id=>array('view','id'=>$model->id),
    'Update',
);

$this->menu=array(
    array('label'=>'List Paylog', 'url'=>array('index')),
    array('label'=>'Create Paylog', 'url'=>array('create')),
    array('label'=>'View Paylog', 'url'=>array('view', 'id'=>$model->id)),
    array('label'=>'Manage Paylog', 'url'=>array('admin')),
);
?>

<div class="col-md-12 form-theme">
    <h3>Update Paylog <?php echo $model->id; ?></h3>

    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
