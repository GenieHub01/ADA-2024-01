<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
    'Update ' . $model->getName(),
);

?>
<div class="col-md-12 form-theme">
    <h3>User <?= $model->getName() ?></h3>

    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
