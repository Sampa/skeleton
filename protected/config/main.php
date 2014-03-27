<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('editable', dirname(__FILE__).'/../extensions/x-editable');
Yii::setPathOfAlias('root', dirname(__FILE__).'/../../');
Yii::setPathOfAlias('com', dirname(__FILE__).'/../components/');
Yii::setPathOfAlias('uploads', dirname(__FILE__).'/../../uploads');
Yii::setPathOfAlias('portfolio', dirname(__FILE__).'/../../images/portfolio');
Yii::setPathOfAlias('boot', dirname(__FILE__).'/../extensions/bootstrap');


// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$config=  array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Cv databas',

	// preloading 'log' component
	'preload'=>array(
		'log',
		'bootstrap',
		'efontawesome',
		'file',
	),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'com.*',
		'ext.bootstrap.widgets.*',
		'ext.bootstrap.components.*',
		'editable.*',
		'ext.CAdvancedArFindBehavior',
		'ext.smenu.SMenu',
		'ext.YiiMailer.YiiMailer',
		'ext.easyimage.EasyImage',
	),

	'defaultController'=>'post',

	// application components
	'components'=>array(

		'editable' => array(
            'class'     => 'editable.EditableConfig',
            'form'      => 'plain',        //form style: 'bootstrap', 'jqueryui', 'plain'
            'mode'      => 'inline',            //mode: 'popup' or 'inline'
            'defaults'  => array(              //default settings for all editable elements
               'emptytext' => 'Click to edit'
            )
        ),
        'easyImage' => array(
        'class' => 'application.extensions.easyimage.EasyImage',
        //'driver' => 'GD',
        //'quality' => 100,
        //'cachePath' => '/assets/easyimage/',
        //'cacheTime' => 2592000,
        'retinaSupport' => false,
		),
        'file'=>array(
    	    'class'=>'ext.file.CFile',
	    ),
		'bootstrap' => array(
	    'class' => 'boot.components.Bootstrap',
	    	'responsiveCss' => true,
		),
		'efontawesome' => array(
                'class' => 'ext.EFontAwesome.components.EFontAwesome',
        ),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'class' => 'auth.components.AuthWebUser',
		),
		'authManager' => array(
	      'behaviors' => array(
	        'auth' => array(
	        	'class' => 'auth.components.AuthBehavior',
	        //  	'class'=>'auth.components.CachedDbAuthManager',
  			 //	'cachingDuration'=>3600,
	 	        'admins' => array('demo'), // users with full access
	        ),
	      ),
		),
		'session'=>array(
			'class' => 'system.web.CDbHttpSession',
    		'connectionID' => 'db',
		    'sessionTableName' => 'actual_table_name',
			'cookieMode'=>'only',
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
        'urlManager'=>array(
        	'urlFormat'=>'path',
        	'showScriptName'=>false,
        	'caseSensitive'=>false,
        	'rules'=>array(
				'blog'=>'/post/index',
				'about'=>'/site/page/view/about',
				'contact'=>'/site/contact',
				'logout'=>'/site/logout',
				'portfolio'=>'/site/page/view/portfolio',
				'login'=>'/site/login',
				'view/<action>'=>'/site/page/view/<action>',
        		'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
        	),
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				/*array(
				'class'=>'CFileLogRoute',
		        'levels'=>'trace,log',
		        'categories' => 'system.db.CDbCommand',
		        //'logFile' => 'db.log',
		        ),
				// uncomment the following to show log messages on web pages

				array(
					'class'=>'CWebLogRoute',
					'levels'=>'trace,log',
		    	    'categories' => 'system.db.CDbCommand',
				),*/

			),
		),
	),
	'modules' => array(
	     'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'123',
            'generatorPaths' => array(
				'ext.sGii',
				'boot.gii.bootstrap'
			),
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters'=>array('127.0.0.1','::1'),
        ),
    	  'auth' => array(
	        'strictMode' => true, // when enabled authorization items cannot be assigned children of the same type.
	        'userClass' => 'User', // the name of the user model class.
	        'userIdColumn' => 'id', // the name of the user id column.
	        'userNameColumn' => 'username', // the name of the user name column.
	        'appLayout' => 'application.views.layouts.main', // the layout used by the module.
        	'viewDir' => null, // the path to view files to use with this module.
  		),

    ),
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
	'sourceLanguage' => 'en_us',
	'language'=>'en_us'
);

switch ($_SERVER['SERVER_NAME']) {
    case 'danielvdb.se':
        $config = CMap::mergeArray(
            $config,
            require(dirname(__FILE__) . '/prod.php')
        );
        break;
    default:
        $config = CMap::mergeArray(
            $config,
            require(dirname(__FILE__) . '/dev.php')
        );
        break;
}

return $config;