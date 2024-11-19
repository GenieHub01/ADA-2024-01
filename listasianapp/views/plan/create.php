<?php
/* @var $this PlanController */
/* @var $model Plan */

$this->breadcrumbs=array(
	'Plans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Plan', 'url'=>array('index')),
	array('label'=>'Manage Plan', 'url'=>array('admin')),
);
?>
<div class="col-md-12 form-theme">
<h3>Create</h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
