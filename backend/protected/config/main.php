<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'aurapark',
	'homeUrl'=>array('site/index'),
	// preloading 'log' component
	'preload'=>array('log','assetManager','booster'),
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.CAdvancedArBehavior',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
    'language',
	/*	'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','85.132.77.11','192.168.20.1','*','::1'),
                        'generatorPaths'=>array('application.extensions.gii.generators'),
		), */
	),
	'aliases' => array(
		'xupload' => 'ext.xupload'
	),

	// application components
	'components'=>array(
            'session',
            'assetManager' => array(
                'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'tmp/mfe/assets',
                'baseUrl'=>'/tmp/mfe/assets/',
            ),
            'yexcel' => array(
                'class' => 'application.extensions.yexcel.Yexcel'
            ),
            'booster' => array(
                'class' => 'application.components.yiibooster.components.Booster',
            ),

            'messages'=>array(
                'class'=>'CDbMessageSource',
                // additional parameters for CDbMessageSource here
            ),
            'log'=>array(
                'class'=>'CLogRouter',
                'routes'=>array(
                    array(
                        'class'=>'CFileLogRoute',
                        'levels'=>'trace, info, error, warning',
                        'categories'=>'system.*',
                    ),
                ),
            ),

            'user'=>array(
                    // enable cookie-based authentication
                    'allowAutoLogin'=>true,
            ),
            // uncomment the following to enable URLs in path-format
            'email'=>array(
                    'class'=>'application.extensions.email.Email',
                    'delivery'=>'php', //Will use the php mailing function.
                    //May also be set to 'debug' to instead dump the contents of the email into the view
            ),
		'image'=>array(
			'class'=>'application.extensions.image.CImageComponent',
			// GD or ImageMagick
			'driver'=>'GD',
			// ImageMagick setup path
			//'params'=>array('directory'=>'/opt/local/bin'),
		),

		'urlManager'=>array(
			//'urlFormat'=>'path',
			'rules'=>array(

                                '<language:[a-z]{2}>'=>'site/index',

                                '<language:[a-z]{2}>/books/<id:\d+>'=>'site/books',
                                'books/<id:\d+>'=>'site/books',

                                '<language:[a-z]{2}>/goto/<id:\d+>'=>'site/goto',
                                'goto/<id:\d+>'=>'site/goto',

                                '<language:[a-z]{2}>/events/<id:\d+>'=>'site/goto',
                                'items/<id:\d+>/<sub:\d+>'=>'site/items',

                                '<language:[a-z]{2}>/news/<id:\d+>'=>'site/goto',

                                '<language:[a-z]{2}>/goto/<id:\d+>'=>'site/goto',
                                'goto/<id:\d+>'=>'site/goto',

								'<action:\w+>'=>'site/<action>',
								'<action:\w+>/<id:\d+>'=>'site/<action>',

                                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',

                                '<language:[a-z]{2}>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                                '<language:[a-z]{2}>/<controller:\w+>/<action:\w+>'=>'<controller>/<action>',


								'<language:[a-z]{2}>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
								'<language:[a-z]{2}>/<controller:\w+>/<action:\w+>'=>'<controller>/<action>',

								'<controller:\w+>/<id:\d+>'=>'<controller>/view',
								'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',


			),
			'showScriptName' => false,
		),

		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		'db'=>array(
			'tablePrefix'=>'',
			'class'=>'CDbConnection',
			'connectionString' => 'mysql:host=localhost;dbname=davam016_test',
			'emulatePrepare' => true,
			'username' => 'davam016_test',
			'password' => 'jeR}&b#ii%A2',
			'charset' => 'utf8',
                        'enableParamLogging'=>true,
                        'schemaCachingDuration'=>3600,
                        'enableProfiling'=>true,
		),
	/*	'errorHandler'=>array(
			// use 'site/error' action to display errors
            //'errorAction'=>'site/login',
        ),*/
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
                                array(
                                    'class'=>'application.extensions.yiidebug2.YiiDebugToolbarRoute',
                                    'ipFilters'=>array('127.0.0.1','192.168.1.*'),
                                    'debug'=>(YII_DEBUG?(isset($_GET['debug'])?true:false):false)

                                ),
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
         'clientScript' => array(
              'scriptMap' => array(
                    'jquery.js' => '/js/jquery-1.10.1.min.js',
              )
          ),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'product_files' =>'/files/products/',
                'gridViewPageSize'=>20,
                'gridViewPageSizeArray'=>array(20=>20,50=>50,100=>100),
                'languages'=>array('az'=>'Azerbaijani','en'=>'English','ru'=>'Russian')
	),
);
