<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">


	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body data-target="#navparent" data-spy="scroll" style="background:#fff; "> 

<div style="width: 100%;">
	<?php 

		//Breadcrumbs
		$links = array();
		if(!Yii::app()->user->isGuest){
						//logged in and needs usermenu
			$userLabel = '<i class="icon-user"></i>'. Yii::app()->user->name;
			$links[$userLabel] = array(
		        	'user/profile','id'=>Yii::app()->user->id,
		        	'htmlOptions'=>array(), // set html options for the submenu ul if you wish
		            'menu'=>array(
		            	Yii::t('skeleton','Logout')=>array('site/logout'),
                		'sub1'=>array( 
                			//clicking the label triggers:
		                	'url'=>array('user/profile','userid' => Yii::app()->user->id),
		                	'submenu'=>array(
		                		'Sub2menu1'=>array(
			                		'url'=>array('controller/routeMenu1','paramM1' => 'valueM1'),
		                		),
		                		'Sub2menu2'=>array(
			                		'url'=>array('controller/routeMenu1','paramM1' => 'valueM1'),
		                		),
		                	),		                			
                		),
		            )
		        );    

			//should be if post rights

			$links['Posts'] = array(
		        	'post/',
		        	'htmlOptions'=>array(), // set html options for the submenu ul if you wish
		            'menu'=>array(
		            	'Create New Post'=>array('post/create'),
						'Manage Posts'=>array('/post/admin'),
						'Approve Comments'. ' (' . Comment::model()->pendingCommentCount . ')'=>array('/comment/index'),                		
		            )
		        );    			          			
		}
		if(is_array($this->breadcrumbs)){
				array_merge($links,$this->breadcrumbs);
		}
		$links['SPrism']=array('/sprism');
		$links['SModal']=array('/smodal');
		$links['SCrud']=array('/scrud');
		$links['Snippets'] = array(
		       		'/snippets',
		       		'htmlOptions'=>array(), // set html options for the submenu ul if you wish
		       		'menu'=>array(
               			'yii'=>array( '/snippets'),
               			'jQuery'=>array('/snippets'),	                			
               		),
		        );
		if(!Yii::app()->user->isGuest){
			$links[Yii::t('skeleton','Logout')]=array('site/logout');
		}
		echo CHtml::tag('div',array('id'=>'breadcrumbs','style'=>'position:fixed; width:100%;'));

		$this->widget('ext.exbreadcrumbs.EXBreadcrumbs', array(
	    	'htmlOptions'=>array(),
			'collapsible'=> false,
    		//'collapsedWidth' => 15, //if collapsible is true this is the width in px of the collapsed item
        	'bcIcon'=>"icon-share-alt", //icon class for link-items 
        	'bcDropdownIcon'=>'icon-chevron-down', //icon class for drop-down items
			'currentClass'=>'active',
    		'homeLink'=>array(
    			'label'=>'<i class="icon-home"></i>'.Yii::app()->name,
    			'url'=>Yii::app()->homeUrl,
    			'htmlOptions'=>array('class'=>'home')
    		),
		    'links'=>$links,
		    
		)); 
		echo CHtml::closeTag('div');
    	
?>
	

	

	
	<!--content-->
	<?=CHtml::tag('div',array('style'=>'padding: 20px 0px 0px 70px;','id'=>'container'),$content);	?>
	
	<!-- leftmenu button- -->
	<div id="leftMenu" class="">
	<!-- sModal markup -->
	<button class="bOpen btn" data-target="fooo">FooModal</button>
	<span class="bTitle">FooTitle</span>
	<div id="fooo">Content</div>
	<!-- login/reg -->
	<?php if(Yii::app()->user->isGuest):?>
		<button id="loginButton" rel="tooltip" title="Login" class="btn  btn-primary">
			<i class="icon-user"></i> 		
		</button>		
		<div id="login" class="hide">

				<?php $this->renderPartial('/site/login',array('model'=>new LoginForm));?>
 		</div>
 		<div id="register" class="hide">
 			<?php
				if(Yii::app()->user->isGuest){
					$this->renderPartial('/site/login',array('model'=>new LoginForm));
				}
			?>
 		</div>
 	<?php endif;?>
		<button href="#" id="contactUs" rel="tooltip" title="Contact" class="btn btn-primary">
			<i class="icon-envelope"></i> 		
		</button>
		<button href="#" id="aboutUs" rel="tooltip" title="About" class="btn btn-primary">
			<i class="icon-question-sign"></i> 		
		</button>
		<div id="aboutUsDiv" style=""></div>
	</div>

	<!-- footer -->
	<?php
		echo CHtml::tag('div',array('id'=>'footer','style'=>'clear:both;'));
			echo "Copyright " . date('Y') .  " by Skeleton <br/>";
		echo CHtml::closeTag('div');
	?>



	<?php
		$baseUrl = Yii::app()->request->baseUrl;
		$cs = Yii::app()->getClientScript();
		//Yii core
	    $cs->registerCoreScript('jquery.ui');
		//template
		$cs-> registerCssFile($baseUrl . '/css/skeleton.css');
		$cs-> registerCssFile($baseUrl . '/css/app.css');
		$cs-> registerCssFile($baseUrl . '/css/bpopup.css');
		$cs-> registerScriptFile($baseUrl . "/js/skeleton.js", CClientScript::POS_END);
		$cs-> registerScriptFile($baseUrl . "/js/app.js", CClientScript::POS_END);
		$cs-> registerScriptFile($baseUrl . "/js/bpopup-dev.js", CClientScript::POS_HEAD);
		$cs-> registerScriptFile($baseUrl . "/js/extended.js", CClientScript::POS_HEAD);
		$cs-> registerScriptFile($baseUrl . "/js/dev.js", CClientScript::POS_HEAD);
		$cs-> registerScriptFile($baseUrl . "/js/sGiiTemplate.js", CClientScript::POS_END);
		

		//plugins 
			//notify
		$cs-> registerCssFile($baseUrl . '/css/jquery.pnotify.default.css');
			//markitup
		$cs-> registerCssFile($baseUrl . '/markitup/skins/markitup/style.css');
		$cs-> registerCssFile($baseUrl . '/markitup/sets/bbcode/style.css');
		$cs-> registerScriptFile($baseUrl . "/markitup/sets/bbcode/set.js", CClientScript::POS_END);
		$cs-> registerScriptFile($baseUrl . "/markitup/jquery.markitup.js", CClientScript::POS_END);
		$cs-> registerScriptFile($baseUrl . "/js/jquery.isloading.min.js", CClientScript::POS_END);
		$cs-> registerScriptFile($baseUrl . "/js/jquery.pnotify.min.js", CClientScript::POS_END);
	?>


</div><!-- page -->
	<?php 
		$this->widget('ext.bpopup.bpopup', array(
			'headerText'=>'sModal',
			'commonClass'=>'btn btn-small',
			'taskbar'=>true,
			'minimizeWidth'=>100,
			'minimizeHeight'=>200,
			'draggable'=>true,
			'resizeable'=>false,
			'defaultElement'=>"#bpopup",
			'buttons'=>array(
				'sblink'=>array(
					'html'=>'B',
					'inTaskbar'=>false,
					'default'=>false,
				),
				'bpin' => array(
					'icon'=>'icon-minus',
					'inTaskbar'=>false,
				),
				'bfold' => array(
					'icon'=>'icon-chevron-up',
					'inTaskbar'=>false,
				),
				'bunfold' => array(
					'icon'=>'icon-chevron-down',
					'inTaskbar'=>false,
				),
				'bmin' => array(
					'icon'=>'icon-resize-small',
				),
				'bmax' => array(
					'icon'=>'icon-resize-full',					
				),		
				'bclose' => array(
					'icon'=>'icon-remove',
				)
			),
			"options"=>array(
	            "follow"=>array(false,true),   //Should the popup follow the screen vertical and/or horizontal on scroll/resize? [horizontal, vertical, fixed on screen see positionStyle instead)] Version 0.3.6. Changed in version 0.5.0 and again in version 0.6.0 and again in version 0.7.0.
			 	"content" =>"ajax",
	            "positionStyle" => 'absolute', //'fixed' or 'absolute'
	            "easing" => 'easeInOutExpo', //uses jQuery easing plugin
	            "transition" => 'fadeIn', //The transition of the popup when it opens. Types" => ['fadeIn', 'slideDown', 'slideIn']. Version 0.9.0
	            "followEasing" =>'swing', //   The follow easing of the popup. 'swing' and 'linear' are built-in in jQuery. If you want more you can use the jQuery Easing plugin. Version 0.9.0
	            "followSpeed" => 500, //  Animation speed for the popup on scroll/resize. Version 0.3.6
	            "loadData" => false, //    LoadData is representing the data attribute in the jQuery.load, // method. It gives you the opportunity to submit GET or POST values through the ajax request. Version 0.9.0
	            "loadUrl" => false, //     External page or selection to load in popup. See loadCallback for callback. Version 0.3.4
	            "modal" => false, //   Should there be a modal overlay behind the popup?
	            "modalClose" => true, //   Should the popup close on click on overlay? Version 0.4.0
	            "modalColor" => '#eee', //     What color should the overlay be? Version 0.3.5
	            "opacity" => 0.9, //   Transparency, from 0.1 to 1.0 filled, //. Version 0.3.3
	            "positionStyle" => 'absolute', //  The popup's position. 'absolute' or 'fixed'  Version 0.7.0
	            "scrollBar" => true, //    Should scrollbar be visible?
	            "speed" => 650, //     Animation speed on open/close. Version 0.9.0
	            "zIndex" =>9999,
	            "onOpen"=>"",
	            "onClose"=>"",
	            "afterOpen"=>"",
	            "loadCallback"=>"$('.loadIcon').remove();",
	            'closeClass'=>"bclose",
	            "position"=>array("auto",10),       
			)
		));
	?>

</body>
</html>
<!--
<div>
		<ul class="" style="list-style:none;">
			
			<li class="dropdown" id="menu1">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#menu1"> Dropdown<b class="caret"></b></a> 
				<ul class="dropdown-menu">
					<li><a href="#">Action</a></li>
					<li class="subdropSet">
						<a href="#">Separated link</a>
						<ul class="dropdown-menu">
							<li><a href="#">Sub Menu</a></li>
							<li><a href="#">Sub Menu</a></li> 
						</ul>		 
					</li>	 
					<li><a href="#">Another action</a></li>
					<li><a href="#">Something else here</a></li>		 
					<li class="divider"></li>		 
				</ul>	 
			</li> 
		</ul>
</div>
-->
