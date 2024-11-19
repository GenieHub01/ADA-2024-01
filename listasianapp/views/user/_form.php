<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<?php

$form=$this->beginWidget('booster.widgets.TbActiveForm', array(
    'id'=>'user-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
    'htmlOptions' => [
        //'class' => 'well'
    ]
));

echo $form->textFieldGroup($model, 'f_name');
echo $form->textFieldGroup($model, 'l_name');
echo $form->textFieldGroup($model, 'email');
echo $form->telFieldGroup($model, 'phone', [
    'widgetOptions' => [
        'htmlOptions' => [
            'autocomplete' => 'tel'
        ]
    ]
]);
echo $form->passwordFieldGroup($model, 'password');
echo $form->passwordFieldGroup($model, 'password2');
echo $form->textFieldGroup($model, 'discount');
echo $form->datePickerGroup($model, 'expiry', [
    'widgetOptions' => array(
        'options' => array(
            'format' => 'yyyy-mm-dd',
            'weekStart' => 1,
            'autoclose' => true
        ),
    ),
    'prepend' => '<i class="glyphicon glyphicon-calendar"></i>'
]);
echo $form->textAreaGroup($model, 'notes', [
    'widgetOptions' => [
        'htmlOptions' => [
            'rows' => 10
        ],
    ]
]);

?>
<label for="save" class="create-advert-save">
    <?= CHtml::submitButton(); ?>
</label>

<?php $this->endWidget(); ?>
