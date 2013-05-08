<?php

class Bpopup extends CWidget
{
	public $headerText = '<i class="icon-fullscreen"></i> Draghandle';
	public $commonClass = "btn btn-small";
	public $buttons = array();
	public $taskbar = false;
	public $minimizeWidth = 100;
	public $minimizeHeight = 250;
	public $draggable = true;
	public $resizeable = true;
	public $defaultElement = "#bpopup";
	public $options = array(
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
	);

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		$this->registerClientScript();
	
	}


	/**linear-gradient(to bottom, #EE5F5B, #BD362F)
	 * Run this widget.
	 */
	public function run()
	{
	?>
	<script type="text/javascript">
	 	
 		function modalDefaults(){
 			bpopupOptions = <?php echo json_encode($this->options);?>; 
			bpopupOptions.onOpen = function(){<?=$this->options['onOpen'];?>};
			bpopupOptions.onClose = function(){<?=$this->options['onClose'];?>};
			bpopupOptions.loadCallback = function(){<?=$this->options['loadCallback'];?>};
			bpopupOptions.afterOpen = function(){<?=$this->options['afterOpen'];?>};
    		return bpopupOptions;
		}
		

	</script>
	<!-- sModal() default element and one who could be used for displaying messages/ajax results/images etc etc etc -->
	<div  class="bpopup" id="bpopup"><i class="icon-spinner loadIcon icon-spin"></i></div>

		<!-- template -->
		<div class="sTemplate hide">  <!-- do not remove the sTemplate class-->
			<div class="bootstrap-widget-header draghandle"> <!-- do not remove the draghandle class-->
				<span><?=$this->headerText;?></span>
			</div>
			<div class="btn-group bButtons">  <!-- do not remove the bButttons class-->
				<?php
					foreach($this->buttons as $key=>$value){
					  	// class for trigger, common for all classes and if set, custom class for this button
	 					$class = $key ." ".$this->commonClass . " ";
	 					$class .= isset($this->buttons[$key]['class'])? $this->buttons[$key]['class']:null;
	 					$html = isset($this->buttons[$key]['html'])? $this->buttons[$key]['html']:null;

					  	$icon = isset($this->buttons[$key]['icon']) ? CHtml::tag('i',array('class'=>$this->buttons[$key]['icon']),'') : null;
					  	var_dump($key['default']);
					  	$style = ($key['default'] ==="s")? "display:none" :null;
					  echo	CHtml::tag('button',array('class'=>$class,'style'=>$style),$icon.$html);
					 }
				?>				
			</div>
					
			 <!-- do not remove the smodalContent class-->
			
		</div>

	<?php if($this->taskbar):?>
	<!-- Optional taskbar -->
	<div id="sTaskbarWrapper">
		<ul id="sTaskbar" class=" breadcrumb nav">
			<li id="sTaskbarStart" >
			 	<ul class="btn-group">
					<li><button id="sTaskbarCloseAll" class="<?= $this->commonClass;?>" href="#">Close all</button></li>	
					<li><button id="sTaskbarFold" class="<?= $this->commonClass;?>" href="#">Hide</button></li>		
					<li><button id="sTaskbarUnfold" class="<?= $this->commonClass;?>" href="#">Show</button></li>					 	 				 	 		 	 				 	 
				</ul>	 
				<a href="#" class="subToggle"><i class="icon-wrench"></i></a>
			</li> 
		</ul>		
		
	</div>
	</script>
	<!-- Taskbar li template (uses .sTaskBarItem for styles) --> 
	<ul style="display:none;">
	<li class="sTaskbarTemplate dropdown">
				<a href="#" style="float:left;"></a><i class="subToggle icon-chevron-up" style="cursor:pointer;"></i>
				<ul>
				    <?php
	            	foreach($this->buttons as $key=>$value){
					  	// class for trigger, common for all classes and if set, custom class for this button
	 					if(!isset($value['inTaskbar'])){	 					
		 					$class = $key ." ".$this->commonClass . "  ";
		 					$class .= isset($this->buttons[$key]['class'])? $this->buttons[$key]['class']:null;
						  	$icon = isset($this->buttons[$key]['icon']) ? CHtml::tag('i',array('class'=>$this->buttons[$key]['icon']),'') : null;						  	
						  	echo '<li>'.CHtml::tag("button",array('class'=>$class),$icon)."</li>";
						}
					 }
				?>
				</ul>
	 </li>
	</ul>
<!-- optional template>
	<ul style="display:none;" class="sTaskbarTemplate">
		<li class="sTaskbarTeomplate" id="">
            <a><b class="caret"></b></a>
            <ul class="">
                <li><a href="#" class="sTaskbarClose"><i class="icon-remove"></i></a></li>
            </ul> 
        </li>
	</ul>
<!-- optional vanilla template 
	<ul style="display:none;" class="sTaskbarTemplate">
		<li class="sTaskbarTemplate" id="">
            <a class=""  href=""><b class="caret"></b></a>
            <ul class="dropdown-menu submenu">
                <li><a href="#" class="sTaskbarClose"><i class="icon-remove"></i></a></li>
            </ul> 
        </li>
	</ul>
-->	
	<?php endif; ?>	<!-- end taskbar -->	
					
<?php
	}
	public function registerClientScript()
	{			
		try{
			// get client js options in JSON format
						
			// publish and register assets : js, css
			$assets = dirname(__FILE__).'/assets';
			$baseUrl = Yii::app()->assetManager->publish($assets);

			$options=$this->options===array()?'{}' : CJavaScript::encode($this->options);

			$id=$this->getId();
			$cs=Yii::app()->getClientScript();	
			$drag = $this->draggable ? "draggable:true," :  null;
			$resizeable = $this->resizeable ? "resizeable:true," :  null;	
			$cs->registerScript('sSettings',
				"function sModalSettings(){
		        var a={
		            minimizeWidth:".$this->minimizeWidth.",
		            minimizeHeight:".$this->minimizeHeight.",
		            ".$drag."
		            ".$resizeable."
		            defaultElement:'".$this->defaultElement."',
		        }
		        return a;
		    }
		   
 

		    ",CClientScript::POS_HEAD
			);		
		//	$cs->registerScriptFile($baseUrl.'/bpopup.js', CClientScript::POS_HEAD);
		//	$cs->registerScriptFile($baseUrl.'/extended.js', CClientScript::POS_HEAD);
		//	$cs->registerCssFile($baseUrl.'/bpopup.css');

			$cs->registerCssFile($baseUrl.'/style.css');
			//$cs->registerScriptFile($baseUrl.'/jquery.isloading.min.js', CClientScript::POS_END);
			$cs->registerScriptFile($baseUrl.'/loadimage.min.js', CClientScript::POS_END);
			$cs->registerScriptFile($baseUrl.'/jquery.easing.min.js', CClientScript::POS_HEAD);

			
									
		}catch(CException $e){
			throw new CException('failed to publish/register assets : '.$e->getMessage());
		}
	}	
	
}
