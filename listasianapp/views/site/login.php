<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
//$this->breadcrumbs=array(
//    'Login',
//);
?>

<div class="col-md-12 form-theme">

    <h3>Login</h3>

    <?php
        $form = $this->beginWidget('booster.widgets.TbActiveForm', [
            'id' => 'login-form',
            'enableClientValidation' => true,
            'clientOptions' => [
                'validateOnSubmit' => true,
            ],
            'htmlOptions' => [
                //'class' => 'well'
            ]
        ]);

        echo $form->textFieldGroup($model, 'username');
        echo $form->passwordFieldGroup($model, 'password');
        echo $form->checkboxGroup($model, 'rememberMe');

        echo CHtml::submitButton('Login', ['class' => 'login-submit']);

        echo '<br>';
        echo CHtml::link('Forgot your password?', ['restore'], ['class' => 'login-forgot']);

        $this->widget('LoginSocial');

        $this->endWidget();
    ?>

</div>
