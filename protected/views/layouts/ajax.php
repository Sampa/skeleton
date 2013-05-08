<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<?php
		$baseUrl = Yii::app()->request->baseUrl;
		$cs = Yii::app()->getClientScript();
		//css files for plugins
		$cs-> registerCssFile($baseUrl . '/css/jquery.pnotify.default.css');
		$cs-> registerCssFile($baseUrl . '/css/skeleton.css');

		$cs-> registerCssFile($baseUrl . '/markitup/skins/markitup/style.css');
		$cs-> registerCssFile($baseUrl . '/markitup/sets/bbcode/style.css');
		//js files
		$cs-> registerScriptFile($baseUrl . "/js/jquery.pnotify.min.js", CClientScript::POS_BEGIN);
		$cs-> registerScriptFile($baseUrl . "/js/skeleton.js", CClientScript::POS_BEGIN);
		$cs-> registerScriptFile($baseUrl . "/js/bpopup.js", CClientScript::POS_BEGIN);
		$cs-> registerScriptFile($baseUrl . "/markitup/sets/bbcode/set.js", CClientScript::POS_BEGIN);
		$cs-> registerScriptFile($baseUrl . "/markitup/jquery.markitup.js", CClientScript::POS_BEGIN);
		$cs-> registerScriptFile($baseUrl . "/js/jquery.easing.min.js", CClientScript::POS_BEGIN);
		$cs-> registerScriptFile($baseUrl . "/js/loadimage.min.js", CClientScript::POS_BEGIN);
	    $cs->registerCoreScript('jquery.ui');

	?>
</head>

<body>
		
<div style="width: 100%;">
	<?=CHtml::tag('div',array('style'=>'padding-left:10px;'),$content); ?>
</div>

</body>
</html>
