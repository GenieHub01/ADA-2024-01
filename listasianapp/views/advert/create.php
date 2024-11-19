<?php
/* @var $this AdvertController */
/* @var $model Advert */

/*
$this->breadcrumbs=array(
    'Adverts'=>array('index'),
    'Create',
);
*/

$this->menu=array(
    array('label'=>'List Advert', 'url'=>array('index')),
    array('label'=>'Manage Advert', 'url'=>array('admin')),
);
?>
<div class="col-md-12 form-theme">

    <h3>Create Advert</h3>

    <?php $this->renderPartial('_form', array('model'=>$model)); ?>

</div>
