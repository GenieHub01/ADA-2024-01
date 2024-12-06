<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$config = array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Asian Directory App',
    'language'=>'en',

    // preloading 'log' component
    'preload' => [
        'log',
        'booster'
    ],

    'aliases' => array(
        'vendor'=>'application.vendor',
        'RestfullYii' =>'vendor.starship.restfullyii.starship.RestfullYii',
        'Payum.YiiExtension' => 'vendor.payum.payum-yii-extension.src.Payum.YiiExtension'
    ),

    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.components.*',
        'application.widgets.*',
        'application.helpers.*',
        'ext.yiiReCaptcha.*'
    ),

    'modules'=>array(
    ),

    'controllerMap'=>array(
        'payment'=>array(
            'class'=>'\Payum\YiiExtension\PaymentController',
        ),
    ),

    // application components
    'components'=>array(

        'reCaptcha' => [
            'name' => 'reCaptcha',
            'class' => 'ReCaptcha',
            //production
            //  'key' => '6LcKLIcqAAAAAMXJTxp5J8fpcN3k5ZVRnsMeICYi',
            //  'secret' => '6LcKLIcqAAAAACyPgpBgKkkIB7MHZxC1XYkcqJGh',

            //local
             'key' => '6LeucloqAAAAAJcjaJZNPBWpE2sAtbIkHtw8KKBy',
             'secret' => '6LeucloqAAAAAO2YaqrAalSHhAnIr_VCHKJEPDXV',

            //ads
//            'key' => '6Lf-nAcUAAAAAD93JxV66VURXPq0qFD4N3K6ceMm',
//            'secret' => '6Lf-nAcUAAAAAJrrMScb08UqCqQvmKKfO1obmiAS',
        ],

        'geo' => [
            'class' => 'EGeoNameService',
            'username' => 'asiandirectoryapp'
        ],

        'booster' => array(
            'class' => 'application.vendor.clevertech.yii-booster.src.components.Booster',
        ),
        
        'widgetFactory'=>array(
            'widgets'=>array(
                'CLinkPager'=>array(
                    //'cssFile' => '/css/pager.css',
                ),
                'CGridView'=>array(
                    //'cssFile' => '/css/gridview.css',
                ),
                'CDetailView'=>array(
                    //'cssFile' => '/css/detailview.css',
                ),
            ),
        ),
        
        'format'=>[
            'class'=>'CLocalizedFormatter'
        ],
        'clientScript' => [
            'packages' => require_once 'packages.php',
            'scriptMap' => [
                'jquery.treeview.js'=>'/js/jquery.treeview.js',
            ]
        ],
        'image'=>array(
            'class'=>'ext.image.CImageComponent',
            // GD or ImageMagick
            'driver'=>'GD',
            // ImageMagick setup path
            'params'=>array('directory'=>'/opt/local/bin'),
        ),
        'authManager' => array(
            'class' => 'PhpAuthManager',
            'defaultRoles' => array('guest'),
        ),
        'user'=>array(
            // enable cookie-based authentication
            'allowAutoLogin'=>true,
            'class' => 'WebUser'
        ),
        'urlManager' => array(
		    'urlFormat' => 'path',
		    'showScriptName' => false,
		    'rules' => CMap::mergeArray(
		        require(__DIR__ . '/routes.php'),
		        require(__DIR__ . '/../vendor/starship/restfullyii/starship/RestfullYii/config/routes.php')
		    ),
		),
        'errorHandler'=>array(
            'errorAction'=>'site/error',
        ),
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning, info',
                    'except' => 'exception.CHttpException.404',
                ),
            ),
        ),
    ),

    'params'=>[
        'upload' => '/images/upload/',
        'pageSize' => 25,
        'hostName' => 'asiandirectoryapp.com',
        'limit' => 1000000,

        'mailer' => [
            'server' => 'smtp.eu.mailgun.org',
            'port' => 587,
            'user' => 'postmaster@list.asiandirectoryapp.com',
            'password' => 'e724b27edcaba57c0293c6b1647d6633-2af183ba-9dc31894',
            'transport' => 'smtp',
            'from' => [
                'NoReply@m1.asiandirectoryapp.com'
            ],
            'to' => 'QC@AsianDirectoryApp.co.uk',
        ],

        'RestfullYii' => [
            'req.auth.username' => function() {
                return 'json';
            },
            'req.auth.password' => function() {
                return 'json-password';
            },
            'req.auth.ajax.user' => function() {
                return false;
            },
        ],

    ]

);

return CMap::mergeArray($config, require __DIR__ . '/local.php');
