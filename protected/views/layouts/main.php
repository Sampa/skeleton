<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">


	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body data-target="#navparent" data-spy="scroll" style="background-color:#fff; width: 100%; ">
	<?php
		$baseUrl = Yii::app()->request->baseUrl;
		$cs = Yii::app()->getClientScript();
		//Yii core
	    $cs->registerCoreScript('jquery.ui');
		//template
		//bootstrap
		$cs-> registerCssFile($baseUrl . '/css/bootstrap.min.css');
		$cs-> registerScriptFile($baseUrl . "/js/bootstrap.min.js", CClientScript::POS_HEAD);
		$cs-> registerScriptFile($baseUrl . "/js/sGiiTemplate.js", CClientScript::POS_END);
		$cs-> registerScriptFile($baseUrl . "/js/app.js", CClientScript::POS_END);

		//macnificent
		$cs-> registerCssFile($baseUrl . '/css/magnific-popup.css');
		$cs-> registerScriptFile($baseUrl . "/js/jquery.magnific-popup.min.js", CClientScript::POS_HEAD);

		//markitup
		$cs-> registerCssFile($baseUrl . '/markitup/skins/markitup/style.css');
		$cs-> registerCssFile($baseUrl . '/markitup/sets/bbcode/style.css');
		$cs-> registerScriptFile($baseUrl . "/markitup/sets/bbcode/set.js", CClientScript::POS_END);
		$cs-> registerScriptFile($baseUrl . "/markitup/jquery.markitup.js", CClientScript::POS_END);
        //notify
        $cs-> registerCssFile($baseUrl . '/css/jquery.pnotify.default.css');
        $cs-> registerScriptFile($baseUrl . "/js/jquery.pnotify.min.js", CClientScript::POS_END);
	?>

	<div id="header">
	     Här kan vi ha något...
	    <div id="contactme">
	    <?php
	    	//CHtml::tag('h3',Yii::t('main','Contact me'));
	    ?>
	        <a href="mailto:idrini@gmail.com" title="idrini@gmail.com"><i class="icon-envelope" style="font-size:200%;"></i></a>
	       <!-- <a href="?lang=sv"><img src="/images/sv.jpg"/></a>
   	        <a href="?lang=sv"><img src="/images/en.jpg"/></a>
   	        -->

	    </div>
	</div>
<div style="width:80%; margin-left:10%; margin-right:10%;height:100%;">

		<?php
			$this->widget('SMenu',array(
				'id'=>'smenu',
				'theme'=>'sphere-small',
				'htmlOptions'=>array(),
				'itemTemplate'=>'{menu}',
				'itemCssClass'=>'topmenu',
				'submenuClass'=>'',
				'items'=>array(
					array('label'=>Yii::t('main', 'Cv'), 'url'=>array("/blog"),'items'=>array(
							array('label'=>Yii::t('main', ' New'),'url'=>'/post/create','icon'=>'pencil','visible'=>!Yii::app()->user->isGuest ),
							array('label'=>Yii::t('main', ' Manage'),'url'=>'/post/admin','icon'=>'tasks','visible'=>!Yii::app()->user->isGuest),
						)
					),
					array('label'=>Yii::t('main', 'Statisk sida'), 'url'=>array("/about")),
					array('label'=>Yii::t('main', 'Portfolio'), 'url'=>array('/portfolio'), 'subWidth'=>'140%',
					 /*'items'=>array(
							array('label'=>Yii::t('main', ' Images'),'url'=>'/view/','icon'=>'camera'),
							array('label'=>Yii::t('main', ' Videos'),'url'=>'/view/','icon'=>'facetime-video'),
						)*/
					 ),
					array('label'=>Yii::t('main', 'Contact'), 'url'=>array('/contact')),
					//array('label'=>Yii::t('main', 'Login'), 'url'=>array('/login'), 'visible'=>Yii::app()->user->isGuest),
					array('label'=>Yii::t('main', 'Logout'), 'url'=>array('/logout'), 'visible'=>!Yii::app()->user->isGuest)
				),
			)); ?>
<div id="index-container" class="row">
    <div  class="col-12 col-sm-8 col-lg-12 index-left">
    	<!--content-->
		<?=$content	?>
    </div>
    <!--<div id="index-right" class="col-6 col-sm-4 col-lg-4">

      <?php
      //if(!Yii::app()->user->isGuest) $this->widget('UserMenu');
      ?>

      <?php
      /* $this->widget('TagCloud', array(
        'maxTags'=>Yii::app()->params['tagCloudCount'],
      ));*/
      ?>

      <?php
      /*$this->widget('RecentComments', array(
        'maxComments'=>Yii::app()->params['recentCommentCount'],
      ));
      */
       ?>

    </div>-->
</div><!--index container-->


</div>

<!-- footer -->
	<?php
		/*echo CHtml::tag('div',array('id'=>'footer','style'=>'width:100%;clear:both; margin-left:-10%;'));
			echo "Copyright " . date('Y') .  " by GP & Sampa <br/>";
		echo CHtml::closeTag('div');
		*/
	?>

<style type="text/css">
#index-container{
	position: relative;
	top:80px;
}
#header a img{
	width:25px;
	height:21px;
	position:relative;
	top:-5px;
}


    /*
http://css3menu.com/sphere-orange.html#
 */

@import "http://fonts.googleapis.com/css?family=Droid+Sans";
ul#smenu {
    position: absolute;
    top:70px;
    height:15px;
}
ul#smenu, ul#smenu ul {
    list-style: none outside none;
    margin: 0;
    padding: 0;
    background-color:#fff;
    box-shadow: 0 0px 0 #BFC1C2;
    font-size: 0;
    z-index: 999;

}
ul#smenu, ul#smenu .submenu {
    background-color:#fff;
}
ul#smenu .submenu {
    background-image: linear-gradient(180deg, rgba(44, 160, 202, 0), rgba(0, 0, 0, 0.1));
    border-color: #FFFFFF #BFC1C2 #BFC1C2;
    box-shadow: 0 5px 5px rgba(20, 20, 25, 0.2), 0 0 0 1px #FFFFFF inset;
    left: -1px;
    opacity: 0;
    padding: 0px;
    top: 100%;
    transition: opacity 0.5s ease 0s;
    position: absolute;
    visibility: hidden;
    z-index: 2;
    max-height:10px;
}
ul#smenu .submenu {
padding: 4px;
}
.submenu ul li{ }
ul#smenu li:hover > .submenu {
    opacity: 1;
    visibility: visible;
     max-height:10px;

}
ul#smenu li {
    display: inline;
    float: left;
    font-size: 0;
    position: relative;
    white-space: nowrap;
}
ul#smenu li:hover {
    z-index: 1;
}


ul#smenu .column {
    float:left;
}
* html ul#smenu li a {
    display: inline-block;

}
ul#smenu > li {
    margin: 0;

}
ul#smenu a:active, ul#smenu a:focus {
    outline-style: none;
}
ul#smenu a {
    background-image: linear-gradient(180deg, rgba(255, 255, 255, 0), rgba(85, 85, 85, 0.13));
    background-position: 0 0;
    background-repeat: repeat;
    border-style: none;
    border-width: 0;
    color: #92979E;
    cursor: pointer;
    display: block;
    font: 14px 'Droid Sans',"Lucida Sans Unicode","Lucida Grande",sans-serif;
    padding: 10px 15px;
    text-align: left;
    text-decoration: none;
    vertical-align: middle;
    height:30px;
    line-height:13px
}
ul#smenu ul li {
   float: none;
    margin: 0;
}
ul#smenu ul a {
    background-image: none;
    border-radius: 6px 6px 6px 6px;
    border-style: none;
    border-width: 0;
    box-shadow: none;
    color: #92979E;
    padding: 5px;
    text-align: left;
    text-decoration: none;
    height:25px;

}
ul#smenu li:hover > a, ul#smenu li a.pressed {
    background-image: linear-gradient(180deg, rgba(85, 85, 85, 0.13), rgba(255, 255, 255, 0));
    background-position: 0 100%;
    border-style: none;
    color: #92979E;
    text-decoration: none;
}
ul#smenu img {
    border: medium none;
    margin-right: 13px;
    vertical-align: middle;
}
ul#smenu ul span {
    background-image: none;
    padding-right: 5px;
}
ul#smenu ul li:hover > a, ul#smenu ul li a.pressed {
    background-color: #EF9D58;
    background-image: linear-gradient(180deg, rgba(255, 255, 255, 0), rgba(85, 85, 85, 0.13));
    border-style: none;
    box-shadow: 0 1px 0 #CF7E4C;
    color: #FFFFFF;
    text-decoration: none;
}
ul#smenu li.topfirst > a {
    background-color: #FFFFFF;
    border-color: #BFC1C2;
    border-radius: 5px 0 0 0;
    border-style: solid;
    border-width: 0 1px 0 0;
    box-shadow: 0 0 0 1px #FFFFFF inset;
    text-shadow: 0 1px 0 #FFFFFF;
}
ul#smenu li.topfirst:hover > a, ul#smenu li.topfirst a.pressed {
    background-color: #FFFFFF;
    border-color: #BFC1C2;
    border-style: solid;
    box-shadow: 0 4px 6px -2px rgba(0, 20, 50, 0.26) inset;
    text-shadow: 0 1px 0 #FFFFFF;
}
ul#smenu li.topmenu > a {
    background-color: #FFFFFF;
    border-color: #BFC1C2;
    border-style: solid;
    border-width: 0 1px 0 0;
    box-shadow: 0 0 0 1px #FFFFFF inset;
    text-shadow: 0 1px 0 #FFFFFF;
}
ul#smenu li.topmenu:hover > a, ul#smenu li.topmenu a.pressed {
    background-color: #FFFFFF;
    border-color: #BFC1C2;
    border-style: solid;
    box-shadow: 0 4px 6px -2px rgba(0, 20, 50, 0.26) inset;
    text-shadow: 0 1px 0 #FFFFFF;
}
ul#smenu li.toplast > a {
    background-color: #FFFFFF;
    border-color: #BFC1C2;
    border-radius: 0 5px 0 0;
    border-style: solid;
    border-width: 0;
    box-shadow: 0 0 0 1px #FFFFFF inset;
    text-shadow: 0 1px 0 #FFFFFF;
}
ul#smenu li.toplast:hover > a, ul#smenu li.toplast a.pressed {
    background-color: #FFFFFF;
    border-color: #BFC1C2;
    border-style: solid;
    box-shadow: 0 4px 6px -2px rgba(0, 20, 50, 0.26) inset;
    text-shadow: 0 1px 0 #FFFFFF;
}
</style>
    <script>
    (function () {
        var s = document.createElement('script'); s.async = true;
        s.type = 'text/javascript';
        s.src = '//' + disqus_shortname + '.disqus.com/count.js';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());
    </script>
</body>
</html>
<!--
<div>

</div>
