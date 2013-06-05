

<div  id="navparent">
    <ul  class="nav nav-list functions" data-spy="affix">
        <li><a href="#top">Introduction</a></li>
        <li><a href="#htmlMarkup">Thrue html</a></li>
        <li><a href="#jsMarkup">More advanced hrue javascript</a></li> 
        <li><a href="#widgetMarkup">Thrue widget</a></li> 
        <li><a href="#examples">Examples</a></li>
        <li><a href="#images">Images</a></li>
        <li><a href="#confirm">Confirm dialog</a></li>
   		<li><a href="#customization">Customization</a></li>
   		<!-- functions -->
  		<li><a href="#closeModal">closeModal()</a></lil
       	<li><a href="#maxModal">maximizeModal()</a></li>
	   	<li><a href="#minModal">minimizeModal()</a></li>
		<li><a href="#foldModal">foldModal()</a></li>  
		<li><a href="#unfoldModal">unfoldModal()</a></li>  
		<li><a href="#getModalFromButton">getModalFromButton()</a></li>  
		<li><a href="#resizeTaskbar">resizeTaskbar()</a></li>
    </ul>
</div>


<div class="span8 extDescription" id="top" style="">
	<h3> sModal </h3>
	<p>
		Modal madness based on  <a href="http://dinbror.dk/blog/bPopup/">bPopup</a><br/>
		Please use the link above for details on the basic usage.<br/>
		Designed to make it easy to use modals  in any project and with many purposes without much work or repeated code writing<br/>
	</p>
	<p>		
		<h4> The way sModal works</h4>
		<div class="column2">
			You use one widget  to	initialize all the requiered assets, the design templates and set your default settings.<br/>
			Most power is gained if you then create your modals with javascript. 
			There is also possible to change settings for a single modal if there is a need to make it diffrent from your default.
			You can also create models using a tiny bit of html markup (less possibilities to customize settings for each modal).
			Or use the php widget.
			<h5>The html templates</h5>
			sModal uses a few html templates that you find in the smodal/views folder. <br/>
			This is to give you the flexibility to modify them easily to change the appearence of your modals.
		</div>
	</p>
		<h4>Features</h4>
		<ul>
			<li>All bPopup features </li>
			<li>Customizeable html templates</li> 
			<li>Easily customizeable css </li>
			<li>Extra easing effects thrue jquery.easing.js</li>
			<li>Customize animations if you wish</li>
			<li>Easy to extend</li>
			<li>Set default settings and reuse them all over your app </li>
			<li>Possibility to pop up modals without defining a special div</li>
			<li>Pop up modals without providing an element</li>
			<li>Resizes itself if the browser window becomes smaller</li>
			<li>Resizeable</li>
			<li>Draggable</li>		
			<li>Minimizeable</li>
			<li>Maximizeable</li>
			<li>Foldable</li>
			<li>Taskbar</li> 
			<li>Confirm</li>
		</ul>

	<h3>Installation</h3>
		<div class="column2">
			Put the zip in protected/extensions and call the widget once (probably in your main layout)
			The widget will initiliaze all you need to go modal mad, then you follow
			<a href="#htmlMarkup">thrue html</a> to create simple modals and/or
			<a href="#jsMarkup">thrue javascript</a> on how to pop up customized modals in whatever way you like<br/>
			To take full advantage of sModal take time to customize css, structure templates and take a look at the different special 
		<a href="#jsfunctions">javascript functions</a>
		</div>
		<h5> Widget options</h5>
		<?php 
			$gridDataProvider = new CArrayDataProvider(array(
			    array(
			    	'id'=>1,
			    	'datatype'=>'String',
			    	'name'=>'commonClass',
			    	'description'=>'class(es) to give the action buttons','default'=>"btn btn-small"
			    ),			    
				array(
					'id'=>2,
					'datatype'=>'Array',
					'name'=>'buttons',
					'description'=>'Array in format of className=>array(icon,class,html,inTaskbar,default) 
					A list of action buttons to be available in modals. 

					"inTaskbar" is a boolean if the button will be shown while 
						the modal is in the taskbar.

						"Default"  is a boolean ,if true the button will always be shown in all modals
						 unless specified as false in a specific modal. 
						Any "icon" value will result in a &lt;i&gt; element with the value as class attribute
						You can also specify the "html" attribute instead of icon if you wish
					',
					'default'=>'name=>(false,false,false,true,true)'
				),
				array(
					'id'=>3,
					'datatype'=>'Boolean',
					'name'=>'taskbar',
					'description'=>'should the taskbar with pinned modals be rendered?', 
					'default'=>'false'
				),
				array('id'=>4,'datatype'=>'String','name'=>'headerText','description'=>'what to use as modal title when no title is passed to smodal()
				','default'=>'<i class="icon-fullscreen"></i>' 
				),
				array('id'=>5,'datatype'=>'Boolean','name'=>'draggable','description'=>'should the modals be draggable by default? ','default'=>'true'),
				array('id'=>6,'datatype'=>'Boolean','name'=>'resizeable','description'=>'should the modals be resizeable by default? ','default'=>'true'),
				array('id'=>7,'datatype'=>'Array','name'=>'options','description'=>'bPopup settings that you want to use as defaults','default'=>'See bPopup docs'),

			));

			$this->widget('bootstrap.widgets.TbGridView', array(
			    'type'=>'striped bordered condensed',
			    'dataProvider'=>$gridDataProvider,
			    'template'=>"{items}",
			    'columns'=>array(
			        array('name'=>'datatype', 'header'=>'Datatype'),
			        array('name'=>'name', 'header'=>'Name'),
			        array('name'=>'description','header'=>'Description'),
			        array('name'=>'default', 'header'=>'Default'),
			    ),
			)); 
		?>


	<?php $this->renderPartial('/site/docs/smodal/examples',array());?>

	</div>
<!-- customization -->
	<h4 id="customization"> Customization </h4>

<!-- Add your own action -->
	<div id="addAction">
		<h5>Custom action buttons</h5>
		Just add a classname in the widgets buttons array like so with optional settings
<?php
$code = "'buttons'=>array(
	...
	'sblink' => array(
	'icon'=>'icon-minus',                    /*optional, default: none*/
	'inTaskbar'=>false,                    /*display the button in the taskbar to? default: true*/
	'html'=>'B',                    /*default:none;*/
	),
	...	
)";
$this->widget('ext.sprism.sprism',array('content'=>$code,'lines'=>'1'));
?>
		and then create a trigger to handle live elements and call the function <br/>
		<button id="blinkDemo" class="btn btn-success">Demo</button>
		<div id="customAction">notice  the "B" button</div>
		<script>
			$("#blinkDemo").on('click',function(){
				sModal({
					element:$("#customAction"),
					buttons:["sblink","bclose"],
				});
			});
		</script>
<?php
$code = "$(\"body\").on('click','.sblink',function(){
	var modal = getModalFromButton($(\"this\"));
	foldModal(modal);
	unfoldModal(modal);
	minimizeModal(modal);
	maximizeModal(modal);
});";
$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'javascript', 'lines'=>'1'));

?>
	</div>

<!-- JS FUNCTIONS -->

<h4 id="jsfunctions">Extra javascript functions</h4>
<!-- MAXMODAL -->
	<div id="closeModal">		
		<h5> closeModal(obj childElement)</h5>
			Accepts any jQuery object and closes it's closest parent modal.
			Usefull with confirms or actionbuttons forexample.			
			To close using the modal element itself use <code><pre>$("selector").bPopup().close();</pre></code> 
			<?php
				$code = "closeModal($(this)";
				$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'javascript','lines'=>'1'));
			?>		
	</div>

<!-- MAXMODAL -->
	<div id="maxModal">		
		<h5> maximizeModal(obj element,int minusWidth, minusHeight)</h5>
			Resizes the modal to the size of the viewport minus the ints passed as parameters.
			Also centers the modal<br/>
			Uses animations that you can change if you wish.

			<?php
				$code = "maximizeModal($(\"#bpopup\"),50,100)";
				$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'javascript','lines'=>'1'));
			?>		
	</div>
<!-- MINMODAL-->
	<div id="minModal">
		<h5> minimizeModal(obj element)</h5>
			Minimizes the modal to minimizeWidth and minimizeHeight from sSettings();
		 	Uses animations that you can change if you wish.
			<?php
				$code = "minmizeModal($(\"#bpopup\"))";
				$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'javascript','lines'=>'1'));
			?>
	</div>
<!-- FOLDMODAL-->
	<div id="foldModal">
		<h5> foldModal(obj element)</h5>
			 Uses one animation that you can change if you wish.
			<?php
				$code = "foldModal($(\"#bpopup\"))";
				$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'javascript','lines'=>'1'));
			?>
	</div>
<!-- UNFOLDMODAL-->
	<div id="unfoldModal">
		<h5> unfoldModal(obj element)</h5>
			 Uses one animation that you can change if you wish.
			<?php
				$code = "unfoldModal($(\"#bpopup\"))";
				$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'javascript','lines'=>'1'));
			?>
	</div>
<!-- getModalFromButton-->
	<div id="getModalFromButton">
		<h5> getModalFromButton(obj element)</h5>
			Used to find the modal element to manipulate when pressing a action button<br/>
			The element object should be the button pressed and a child to a element with .bButtons class OR
			one in the taskbar<br/>
			
<?php 
$code = "var modal = getModalFromButton($(\"this\"));";
$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'javascript','lines'=>'1'));
?>
	</div>
<!-- resizeTaskbar-->
	<div id="resizeTaskbar">
		<h5> resizeTaskbar(width,height)</h5>
			Used to set animate the taskbar to a diffrent width as is done with the "hide" and "show" actions in the demo<br/>
			Width attribute is requiered but height is optional
<?php 
$code = "resizeTaskbar(30)));";
$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'javascript','lines'=>'1'));
?>
	</div>
	

</div>

<!--
  
    
  
	