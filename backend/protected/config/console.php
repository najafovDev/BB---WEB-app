<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',
	// application components
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.CAdvancedArBehavior', 
	),
	'components'=>array(

		'db'=>array(
			'tablePrefix'=>'',
			'class'=>'CDbConnection',
			'connectionString' => 'mysql:host=localhost;dbname=sun',
			'emulatePrepare' => true,
			'username' => 'sun',
			'password' => 'asdasd',
			'charset' => 'utf8',
		),
		
	),
);