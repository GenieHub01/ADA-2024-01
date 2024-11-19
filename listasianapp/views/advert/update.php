<?php
/* @var $this AdvertController */
/* @var $model Advert */

/*
$this->breadcrumbs=array(
    'Adverts'=>array('index'),
    $model->name=>array('view','id'=>$model->id),
    'Update',
);
*/

$this->menu=array(
    array('label'=>'Create Advert', 'url'=>array('create')),
    array('label'=>'View Advert', 'url'=>array('view', 'id'=>$model->id)),
    array('label'=>'Manage Advert', 'url'=>array('admin')),
);
?>
<div class="col-md-12 form-theme">

    <h3>Update Advert <?php echo $model->id; ?></h3>

    <?php $this->renderPartial('_form', array('model'=>$model)); ?>

</div>
