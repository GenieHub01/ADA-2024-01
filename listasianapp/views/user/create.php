<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
    'Users'=>array('index'),
    'Create',
);

$this->menu=array(
    //array('label'=>'List User', 'url'=>array('index')),
    array('label'=>'Manage User', 'url'=>array('admin')),
);
?>
<div class="col-md-12 form-theme">
    <h3>Create User</h3>

    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
