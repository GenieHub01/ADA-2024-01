<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
    'Categories'=>array('index'),
    $model->name=>array('view','id'=>$model->id),
    'Update',
);

$this->menu=array(
    //array('label'=>'List Category', 'url'=>array('index')),
    array('label'=>'Create Category', 'url'=>array('create')),
    array('label'=>'View Category', 'url'=>array('view', 'id'=>$model->id)),
    array('label'=>'Manage Category', 'url'=>array('admin')),
);
?>
<div class="col-md-12 form-theme">
    <h3>Update Category <?php echo $model->id; ?></h3>

    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
