<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Canviant',
    'theme' => 'canviant',
    'sourceLanguage' => 'en_US',
    'language' =>'pt_BR',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.modules.pietra.models.*',
        'application.modules.pietra.components.*',
        'application.modules.blog.models.BlogConfig',
	),

    'modules'=>array(
        /*'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1', '10.0.*.*'),
        ),*/
        'pietra' => array(
            'mediaUrl' => 'media/',
            'mediaPath' => dirname(__FILE__).'/../../public/media',
            'mediaCacheUrl' => 'media/cache/',
            'mediaCachePath' => dirname(__FILE__).'/../../public/media/cache',
        ),
        'admin',
        'blog'
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>false,
            'loginUrl' => array('admin/admin/index')
		),
        'assetManager' => array(
            'basePath' => dirname(__FILE__). '/../../public/assets',
            'linkAssets' => true,
        ),

		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
            'showScriptName' => false,
			'urlFormat'=>'path',
			'rules'=>array(
                '/' => 'site/index',
                'admin/' => 'admin/admin/index',
                'contato/' => 'site/contact',

                array(
                    'class' => 'blog.components.BlogUrlRule',
                ),
                array(
                    'class' => 'pietra.components.DynamicUrlRule',
                ),
			),
		),
		'db'=>array(
			'connectionString' => 'mysql:host=HOST;dbname=SCHEMA',
			'emulatePrepare' => true,
			'username' => 'user',
			'password' => 'pass',
			'charset' => 'utf8',
        ),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
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
					'class'=>'CWebLogRoute',
                ),*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'xxxx@xxxx.com.br'
	),
);
