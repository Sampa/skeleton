<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">


	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body data-target="#navparent" data-spy="scroll" style="background-color:#fff"> 
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
		$cs-> registerScriptFile($baseUrl . "/js/bpopup-dev.js", CClientScript::POS_END);
		$cs-> registerScriptFile($baseUrl . "/js/extended.js", CClientScript::POS_END);
		$cs-> registerScriptFile($baseUrl . "/js/dev.js", CClientScript::POS_END);
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

<div style="width: 100%;">
	<?php	
		$this->widget('SMenu',array(
			'id'=>'sphere-orange',
			'theme'=>'sphere-orange',
			'htmlOptions'=>array(),
			'itemTemplate'=>'{menu}',
			'itemCssClass'=>'topmenu',
			'submenuClass'=>'',
			'items'=>array(
				array('label'=>'Home', 'url'=>array('site/index')),
				array('label'=>'SModal','url'=>array('/smodal'),'subWidth'=>'360%', 'items'=>array(
						array('label'=>'Github','url'=>'https://github.com/Sampa/sModal','icon'=>'github'),
						array('column'),
						array('label'=>'Based on bPopup','url'=>'http://dinbror.dk/blog/bPopup/','icon'=>'external-link'),
					)),
				array('label'=>'SGii','url'=>array('/sgii'),'items'=>array(
						array('label'=>'Github','url'=>'http://github','icon'=>'github'),
					)),
				array('label'=>'SMenu','url'=>array('/smenu'),'items'=>array(
						array('label'=>'Github','url'=>'http://github','icon'=>'github'),
				)),
				array('label'=>'SPrism','url'=>array('/sprism'),'subWidth'=>'280%', 'items'=>array(
						array('label'=>'Github','url'=>"https://github.com/Sampa/sprism",'icon'=>'github'),
						array('column','width'=>'50%'),
						array('label'=>'Prism docs','url'=>'http://prismjs.com/','icon'=>'external-link'),				
					)),
				array('label'=>'Snippets','url'=>'/snippets','subWidth'=>'250%', 'items'=>array(
               			array('label'=>'Yii','url'=>'/snippets#yii','icon'=>'heart'),
               			array('label'=>'jQuery', 'url'=>'/snippets#jQuery'),	
               			array('label'=>'bootstrap','url'=>'/snippets#bootstrap','icon'=>'twitter')                			
               		)),
				array('label'=>'Posts','url'=>array('/posts/index'),'visible'=>!Yii::app()->user->isGuest, 'items'=>array(
			            	array('label'=>'Create New Post','url'=>array('post/create') ,'icon'=>'file-alt'),
							array('label'=>'Manage Posts','url'=>array('/post/admin') ,'icon'=>'edit'),
							array('label'=>'Approve Comments'. ' (' . Comment::model()->pendingCommentCount . ')','url'=>array('/comment/index'),'icon'=>'comment'),                		
			        )),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	
	
	<!--content-->
	<?=CHtml::tag('div',array('style'=>'padding: 20px 0px 0px 70px;','id'=>'container'),$content);	?>
	
	<!-- leftmenu button- -->
	<div id="leftMenu" class="">
		<!-- about us-->
		<button href="#" id="aboutUs" rel="tooltip" title="About" class="btn btn-primary">
			<i class="icon-question-sign"></i> 		
		</button>
		<div id="aboutUsDiv"></div>
		<!-- login/reg -->
		<?php if(Yii::app()->user->isGuest):?>
			<button id="loginButton" data-target="login" rel="tooltip" title="Login" class="btn btn-primary">
				<i class="icon-user"></i> 		
			</button>		
			<div id="login" class="hide" >
					<span class="bTitle">Login</span>
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
	 	<!-- contact 
		<button href="#" id="contactUs" rel="tooltip" title="Contact" class="btn btn-primary">
			<i class="icon-envelope"></i> 		
		</button>
		-->
	
	</div>


</div><!-- page -->
<!-- footer -->
	<?php
		echo CHtml::tag('div',array('id'=>'footer','style'=>'clear:both;'));
			echo "Copyright " . date('Y') .  " by Skeleton <br/>";
		echo CHtml::closeTag('div');
	?>
	<?php 
		$this->widget('ext.smodal.smodal', array(
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
					'inTaskbar'=>true,
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
	            "modal" => true, //   Should there be a modal overlay behind the popup?
	            "modalClose" => true, //   Should the popup close on click on overlay? Version 0.4.0
	            "modalColor" => '#EFD5BE', //     What color should the overlay be? Version 0.3.5
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
<script>
$(document).ready(function() {
	/*$.sModal({
		confirm:{
				'yes':{
					'label':'Yes',
					'class':'btn btn-success',
					'click':function(){
						alert("You choose yes");
						closeModal($(this));
				}
				},
				'no':{
					'label':'No',
					'class':'btn btn-danger',			
					'click':function(){
						alert("You choose no");
					}
				},
			},
		
		title:"Are you sure?",
		buttons:['bclose'],	
	});
*/
});
</script>
</body>
</html>
<!--
<div>
		
</div>
-->
