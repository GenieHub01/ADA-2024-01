<?php

/* @var $model User */
/* @var $this Controller */

$this->pageTitle = 'Register';

?>

<?php if (Yii::app()->user->hasFlash('message')): ?>

    <h3><?= Yii::app()->user->getFlash('message') ?></h3>

<?php else: ?>



<div class="col-md-12 form-theme">

    <h3>Registration</h3>

    <?php

    $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
        'id'=>'reg-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
        'htmlOptions' => [
            //'class' => 'well'
        ]
    ));

    echo $form->textFieldGroup($model, 'f_name');
    echo $form->textFieldGroup($model, 'l_name');
    echo $form->telFieldGroup($model, 'phone', [
        'widgetOptions' => [
            'htmlOptions' => [
                'autocomplete' => 'tel'
            ]
        ]
    ]);
    echo $form->emailFieldGroup($model, 'email');
    echo $form->passwordFieldGroup($model, 'password');
    echo $form->passwordFieldGroup($model, 'password2');

    $this->widget('ReCaptcha', array(
        'model' => $model,
        'attribute' => 'recaptcha',
    ));
    echo CHtml::error($model, 'recaptcha');

    echo CHtml::submitButton('Register', ['class' => 'register-submit']);

    $googleAuthUrl = Yii::app()->createAbsoluteUrl('site/login', ['provider' => 'Google']);
    ?>

    <br>
    <div>
    <a href="<?php echo htmlspecialchars($googleAuthUrl, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-danger">
        <i class="fa fa-google"></i> Login with Google
    </a>
</div>

<?php $this->endWidget(); ?>

</div>

<?php endif; ?>
