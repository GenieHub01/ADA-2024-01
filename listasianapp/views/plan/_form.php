<?php
/* @var $this PlanController */
/* @var $model Plan */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'plan-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <?= CHtml::errorSummary($model); ?>

    <?= $form->textFieldGroup($model,'name'); ?>

    <?php if ($model->getIsNewRecord()): ?>

        <?= $form->select2Group($model,'package', [
            'widgetOptions' => [
                'data' => Price::model()->getList(),
            ],
        ]); ?>

        <?= $form->select2Group($model,'interval', [
            'widgetOptions' => [
                'data' => $model->intervalList,
            ],
        ]); ?>

        <?= $form->textFieldGroup($model,'amount'); ?>

        <?= $form->textFieldGroup($model,'currency'); ?>

    <?php endif; ?>

    <label for="save" class="create-advert-save">
        <?= CHtml::submitButton(); ?>
    </label>

<?php $this->endWidget(); ?>

</div><!-- form -->