<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('editable', dirname(__FILE__).'/../extensions/x-editable');
Yii::setPathOfAlias('root', dirname(__FILE__).'/../../');
Yii::setPathOfAlias('com', dirname(__FILE__).'/../components/');
Yii::setPathOfAlias('uploads', dirname(__FILE__).'/../../uploads');
Yii::setPathOfAlias('boot', dirname(__FILE__).'/../extensions/bootstrap');
Yii::setPathOfAlias('smodal', dirname(__FILE__).'/../extensions/smodal');


// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Sampa',

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
		'application.modules.sdashboard.components.*',
		'application.modules.sdashboard.models.*',
		'ext.smenu.SMenu',
	),

	'defaultController'=>'site',

	// application components
	'components'=>array(
		'clientScript' => array(
		    'class' => 'com.NLSClientScript',
		    //'excludePattern' => '/\.tpl/i', //js regexp, files with matching paths won't be filtered is set to other than 'null'
		    //'includePattern' => '/\.php/', //js regexp, only files with matching paths will be filtered if set to other than 'null'
		 
		    'mergeJs' => false, //def:true
		    'compressMergedJs' => false, //def:false
		 
		    'mergeCss' => false, //def:true
		    'compressMergedCss' => false, //def:false    
		 
		    //'serverBaseUrl' => 'http://localhost', //can be optionally set here
		    'mergeAbove' => 1, //def:1, only "more than this value" files will be merged,
		    'curlTimeOut' => 5, //def:5, see curl_setopt() doc
		    'curlConnectionTimeOut' => 10, //def:10, see curl_setopt() doc
		 
		    'appVersion'=>1.0 //if set, it will be appended to the urls of the merged scripts/css
	  ),
		'editable' => array(
            'class'     => 'editable.EditableConfig',
            'form'      => 'bootstrap',        //form style: 'bootstrap', 'jqueryui', 'plain' 
            'mode'      => 'popup',            //mode: 'popup' or 'inline'  
            'defaults'  => array(              //default settings for all editable elements
               'emptytext' => 'Click to edit'
            )
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
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=skeleton',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',
			 'enableParamLogging' => true,
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
				'about'=>'/site/page/view/about',
				'contact'=>'/site/contact',
				'login'=>'/site/login',
				'sprism'=>'/site/page/view/sprism',
				'smodal'=>'/site/page/view/smodal',
				'smenu'=>'/site/page/view/smenu',
				'sgii'=>'/site/page/view/sgii',
				'snippets'=>'/site/page/view/snippets',
        		'post/<id:\d+>/<title:.*?>'=>'/post/view',
        		'posts/<tag:.*?>'=>'/post/index',
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
 	  	'sdashboard'=>array(),

    ),
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);