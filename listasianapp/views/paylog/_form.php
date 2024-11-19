<?php
/* @var $this PaylogController */
/* @var $model Paylog */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'paylog-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'advert_id'); ?>
		<?php echo $form->textField($model,'advert_id'); ?>
		<?php echo $form->error($model,'advert_id'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'create_time'); ?>
		<?php echo $form->textField($model,'create_time'); ?>
		<?php echo $form->error($model,'create_time'); ?>
	</div>

	<label for="save" class="create-advert-save">
		<?= CHtml::submitButton(); ?>
	</label>

<?php $this->endWidget(); ?>
