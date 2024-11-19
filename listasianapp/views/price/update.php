<?php
$this->breadcrumbs=array(
    'No Renewal prices'
);
?>

<div class="col-md-12 form-theme">

    <?php if (Yii::app()->user->hasFlash('message')): ?>

    <div class="alert alert-success">
        <?= Yii::app()->user->getFlash('message') ?>
    </div>

    <?php endif; ?>

    <h3>Default prices (<?= Opay::CURRENCY ?>)</h3>


    <?php

        $form=$this->beginWidget('booster.widgets.TbActiveForm', [
            'htmlOptions' => []
        ]);

        foreach($items as $i=>$item) {
            echo '<div class="form-group">';
            echo CHtml::label($item->name, '', ['class' => 'control-label']);
            echo CHtml::activeTextField($item, "[$i]description", ['class' => 'form-control']);
            echo CHtml::activeTextField($item, "[$i]value", ['class' => 'form-control']);
            echo CHtml::error($item, "[$i]value");
            echo '</div>';
        }

    ?>

    <label for="save" class="create-advert-save">
        <?= CHtml::submitButton(); ?>
    </label>

    <?php $this->endWidget(); ?>

</div><!-- form -->
