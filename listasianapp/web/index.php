<?php

date_default_timezone_set('Europe/London');

// change the following paths if necessary
$yii=dirname(__FILE__).'/../vendor/autoload.php';
$config=dirname(__FILE__).'/../config/main.php';

if ($_SERVER['SERVER_NAME'] == 'www.adverts') {
// remove the following lines when in production mode
    defined('YII_DEBUG') or define('YII_DEBUG', true);
// specify how many levels of call stack should be shown in each log message
    defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);
}

require_once($yii);
Yii::createWebApplication($config)->run();
