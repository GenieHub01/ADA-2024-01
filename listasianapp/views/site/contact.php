<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
    'Contact',
);
?>

<h1>Contact Us</h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="alert alert-success">
    <?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<p>
If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
</p>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'contact-form',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
    'htmlOptions'=>array('class'=>'form-horizontal'),
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model, null, null, array('class'=>'alert alert-danger')); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model,'name', array('class'=>'control-label col-sm-2')); ?>
        <div class="col-sm-10">
            <?php echo $form->textField($model,'name', array('class'=>'form-control', 'placeholder'=>'Your Name')); ?>
            <?php echo $form->error($model,'name', array('class'=>'text-danger')); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'email', array('class'=>'control-label col-sm-2')); ?>
        <div class="col-sm-10">
            <?php echo $form->textField($model,'email', array('class'=>'form-control', 'placeholder'=>'Your Email Address')); ?>
            <?php echo $form->error($model,'email', array('class'=>'text-danger')); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'subject', array('class'=>'control-label col-sm-2')); ?>
        <div class="col-sm-10">
            <?php echo $form->textField($model,'subject', array('class'=>'form-control', 'placeholder'=>'Subject', 'maxlength'=>128)); ?>
            <?php echo $form->error($model,'subject', array('class'=>'text-danger')); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'body', array('class'=>'control-label col-sm-2')); ?>
        <div class="col-sm-10">
            <?php echo $form->textArea($model,'body', array('class'=>'form-control', 'rows'=>6, 'placeholder'=>'Your Message')); ?>
            <?php echo $form->error($model,'body', array('class'=>'text-danger')); ?>
        </div>
    </div>

    <?php if(CCaptcha::checkRequirements()): ?>
    <div class="form-group">
        <?php echo $form->labelEx($model,'verifyCode', array('class'=>'control-label col-sm-2')); ?>
        <div class="col-sm-10">
            <div>
                <?php $this->widget('CCaptcha'); ?>
                <?php echo $form->textField($model,'verifyCode', array('class'=>'form-control', 'placeholder'=>'Enter Captcha')); ?>
            </div>
            <p class="help-block">Please enter the letters as they are shown in the image above. Letters are not case-sensitive.</p>
            <?php echo $form->error($model,'verifyCode', array('class'=>'text-danger')); ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <?php echo CHtml::submitButton('Submit', array('class'=>'btn btn-primary')); ?>
        </div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>
