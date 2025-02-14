<?php

//require_once __DIR__ . '/../vendor/google-api-client/src/Google/Client.php';

class SiteController extends Controller
{
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page'=>array(
                'class'=>'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact()
    {
        $model=new ContactForm;
        if(isset($_POST['ContactForm']))
        {
            $model->attributes=$_POST['ContactForm'];
            if($model->validate())
            {
                $name='=?UTF-8?B?'.base64_encode($model->name).'?=';
                $subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
                $headers="From: $name <{$model->email}>\r\n".
                    "Reply-To: {$model->email}\r\n".
                    "MIME-Version: 1.0\r\n".
                    "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
                Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact',array('model'=>$model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {

        Yii::log("Login action initiated", CLogger::LEVEL_INFO);
      
      	if (!Yii::app()->user->isGuest) {
          	Yii::log("User already logged in. Redirecting to home.", CLogger::LEVEL_INFO);
            $this->redirect('/');
        }

        if (isset($_GET['provider'])) {
            User::model()->socialLogin($_GET['provider']);
          	Yii::log("Social login successful for provider: " . $_GET['provider'], CLogger::LEVEL_INFO);
            $this->redirect(['advert/index']);
        } elseif (isset($_GET['hauth_start']) || isset($_GET['hauth_done'])) {
            Yii::log("Hybrid_Endpoint successfully processed.", CLogger::LEVEL_INFO);
          	Hybrid_Endpoint::process();
        }

        $model=new LoginForm;

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
          	// Yii::log("Login form submitted with data: " . print_r($_POST['LoginForm'], true), CLogger::LEVEL_INFO);
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {

                if (Yii::app()->user->checkAccess(User::ROLE_ADMIN)) {
                  	Yii::log("Admin user detected. Redirecting to admin page.", CLogger::LEVEL_INFO);
                    $this->redirect(['advert/admin', 'Advert[active]' => 0]);
                }

                $this->redirect(['advert/index']);
            } else {
                Yii::log("Login failed. Errors: " . print_r($model->errors, true), CLogger::LEVEL_ERROR);
            }
        }
        // display the login form
      Yii::log("Rendering login form", CLogger::LEVEL_INFO);  
      $this->render('login',array('model'=>$model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();

        if (YII_DEBUG) {
            $this->redirect('/');
        } else {
            $this->redirect('https://www.mailzion.com');
        }
    }

    public function actionRegister()
    {
        if (!Yii::app()->user->isGuest) {
            $this->redirect('/');
        }

        $model = new User();

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];

            if ($model->save()) {
                Yii::app()->user->setFlash('message', 'Registration success');
                $this->refresh();
            }
        }

        $this->render('register', [
            'model' => $model
        ]);
    }

    public function actionRestore()
    {
        $model = new RestorePassword();

        if (isset($_POST['RestorePassword'])) {
            $model->attributes = $_POST['RestorePassword'];

            if ($model->validate()) {
                User::model()->newPassword($model->email);
                Yii::app()->user->setFlash('message', 'Email sent');
                $this->refresh();
            }
        }

        $this->render('restore', [
            'model' => $model
        ]);
    }

    public function actionDone()
    {
        $opay = new Opay();
        $opay->init();

        try {
            $opay->completePurchase();

            Yii::app()->user->setFlash('success', 'Payment completed successfully.');
            
            $this->render('done');
        } catch (CHttpException $e) {
            Yii::app()->user->setFlash('error', $e->getMessage());
            $this->redirect(['site/error']);
        }
    }

    public function actionCancel()
    {
        $this->render('cancel');
    }

  	public function actionPrivacyPolicy()
    {
        $this->render('privacy-policy');
    }
  	
  	public function actionAbout()
    {
        $this->render('about');
    }

}
