<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
    'Categories'=>array('index'),
    'Create',
);

$this->menu=array(
    array('label'=>'List Category', 'url'=>array('index')),
    array('label'=>'Manage Category', 'url'=>array('admin')),
);
?>

<div class="col-md-12 form-theme">
    <h3>Create Category</h3>

    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
