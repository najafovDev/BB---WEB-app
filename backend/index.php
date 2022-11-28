<?php
date_default_timezone_set('Asia/Baku');// change the following paths if necessary
$yii=dirname(__FILE__).'/../yoo/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
//create your app and store the app. Ignore the $env->configWeb it is just the way we configure our app.
$app = Yii::createWebApplication($config); 
 
//Change the UrlFormat for urlManager to get if a get request is given instead of a path format one.

//run the app
$app->run(); 
