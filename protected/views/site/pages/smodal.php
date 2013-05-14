

<div  id="navparent">
    <ul  class="nav nav-list functions" data-spy="affix">
        <li><a href="#top">Introduction</a></li>
        <li><a href="#htmlMarkup">Thrue html</a></li>
        <li><a href="#jsMarkup">More advanced hrue javascript</a></li> 
        <li><a href="#widgetMarkup">Thrue widget</a></li> 
        <li><a href="#examples">Examples</a></li>
        <li><a href="#images">Images</a></li>
       	<li><a href="#maxModal">maximizeModal()</a></li>
	   	<li><a href="#minModal">minimizeModal()</a></li>
		<li><a href="#foldModal">foldModal()</a></li>  
		<li><a href="#unfoldModal">unfoldModal()</a></li>  
		<li><a href="#getModalFromButton">getModalFromButton()</a></li>  
		<li><a href="#resizeTaskbar">resizeTaskbar()</a></li>
		<li><a href="#customization">Customization</a></lil
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
		You are usually using modals in javascript context, therefor there is no Yii widget to create each modal, instead you use one widget  to
		initialize all the requiered assets, the design templates and set your default settings.<br/>
		Then you simply use the javascript methods where and in the way you need it.<br/>
		There is also possible to change most settings for a single modal if there is a need to make it diffrent from your default.
		You can also create models using your default settings with a tiny bit of html markup.
	</p>
	<p>
		<ul>
			<li>All bPopup features </li>
			<li>Customizeable html templates</li> 
			<li>Easily customizeable css </li>
			<li>Extra easing effects thrue jquery.easing.js</li>
			<li>Customize animations if you wish</li>
			<li>Easy to extend</li>
		</ul>
	</p>

	<h4>SModal extra optional features</h4>
	<ul>
		<li>Set default settings and reuse them all over your app </li>
		<li>Possibility to pop up modals without defining a special div</li>
		<li>Resizes itself if the browser window becomes smaller</li>
		<li>Resizeable</li>
		<li>Draggable</li>
		<li>Minimizeable</li>
		<li>Maximizeable</li>
		<li>Foldable</li>
		<li>Taskbar</li> 
		<li>Bootstrap theme</li>
	</ul>

	<h3>Installation</h3>
		Put the zip in protected/extensions and call the widget once (probably in your main layout)
		The widget will initiliaze all you need to go modal mad, then you follow
		<a href="#htmlMarkup">thrue html</a> to create simple modals and/or
		<a href="#jsMarkup">thrue javascript</a> on how to pop up customized modals in whatever way you like<br/>
		To take full advantage of sModal take time to customize css, structure templates and take a look at the different special 
		<a href="#jsfunctions">javascript functions</a>
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
				array('id'=>7,'datatype'=>'Array','name'=>'options','description'=>'bPopup settings that you want to use as defaults','default'=>''),

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


		<?php 
		$code = "\$this->widget('ext.bpopup.bpopup', array(
			'commonClass'=>'btn btn-small',
			'headerText'=>'Some default title', 
			'taskbar'=>true, // show a taskbar?  default:false
			'draggable'=>true,//default value
			'resizeable'=>true, //default value
			'defaultElement'=>'#bpopup', //default value
			'buttons'=>array(
				'pin' => array(
					'icon'=>'icon-minus',					
					'inTaskbar'=>false, //default true
				),
				'fold' => array(
					'html'=>'<i class=\"icon-chevron-up\"></i>',
					'inTaskbar'=>false,
				),
				'unfold' => array(
					'icon'=>'icon-chevron-down',
					'inTaskbar'=>false,
				),
				'min' => array(
					'icon'=>'icon-resize-small',
				),
				'max' => array(
					'icon'=>'icon-resize-full',					
				),		
				'close' => array(
					'icon'=>'icon-remove',
				)
			),
			'options'=>array( //unless you set an option it get its default value as shown below
				//you can also set these directly in bpopup.php
	            'follow'=>array(false,true),   
			 	'content' =>'ajax',
	            'positionStyle' => 'absolute', //'fixed' or 'absolute'
	            'easing' => 'easeInOutExpo', //uses jQuery easing plugin
	            'transition' => 'fadeIn', // Types' => ['fadeIn', 'slideDown', 'slideIn']
	            'followEasing' =>'swing',
	            'followSpeed' => 500, 
	            'loadData' => false, //LoadData is representing the data attribute in the jQuery.load, 
	            'loadUrl' => false, 
	            'modal' => false, //Should there be a modal overlay behind the popup?
	            'modalClose' => true, //Should the popup close on click on overlay? Version 0.4.0
	            'modalColor' => '#eee', 
	            'opacity' => 0.9,
	            'scrollBar' => true, 
	            'speed' => 650, 	           
	            'zIndex' =>9999,
	            'loadCallback'=>'$('.loadIcon').remove();', //callback example usage
	            'onOpen'=>'', //callback 
	            'onClose'=>'', //callback
	            'afterOpen'=>'',//callback
	            'closeClass'=>'bclose', 
	            'position'=>array('auto',10),       
			)
		));";		
	?>
		<button class="bOpen btn btn-success" data-target="widgetExample">Example</button>
		<div id="widgetExample">
			<?php $this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'php','lines'=>array('start'=>1,'end'=>55)));?>
		</div>
	<h3>Usage</h3>
	
<!-- HTML MARKUP-->
	<div id="htmlMarkup">
	<h4> Thrue html </h4>
		No javascript is needed for this
		<!-- minimal markup-->
		<h5> With minimal html markup</h5>
		<button class="bOpen btn btn-success" data-target="foo">Example</button>
		<div id="foo">Content</div>
		<?php 
$code = '&lt;button class="bOpen btn" data-target="foo">FooModal&lt;/button>
&lt;div id="foo">Content&lt;/div>';
			$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'php','lines'=>array('start'=>1,'end'=>3)));
		?>
		<!-- Custom title-->
		<h5> With  custom title</h5>
		<?php
$code = '&lt;button class="bOpen btn" data-target="foo">FooModal&lt;/button>
&lt;span class="bTitle"> &lt;i class="icon-screenshot">&lt;/i> FooTitle&lt;/span>
&lt;div id="foo">Content&lt;/div> ';
			$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'php','lines'=>array('start'=>1,'end'=>3)));
		?>
		<!-- ignoring buttons-->
		<h5> Ignoring buttons for this modal (but use the rest)</h5>
		<?php
$code = '&lt;button class="bOpen btn" data-target="foo" data-ignore="bmax,bmin">FooModal&lt;/button>
&lt;span class="bTitle"> &lt;i class="icon-screenshot">&lt;/i> FooTitle&lt;/span>
&lt;div id="foo">Content&lt;/div> ';
			$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'php','lines'=>array('start'=>1,'end'=>3)));
		?>
		<!-- use buttons -->
		<h5>Use only the specified buttons</h5>

		<?php
$code = '&lt;button class="bOpen btn" data-target="foo" data-buttons="bclose,bfold">FooModal&lt;/button>
&lt;span class="bTitle"> &lt;i class="icon-screenshot">&lt;/i> FooTitle&lt;/span>
&lt;div id="foo">Content&lt;/div> ';
			$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'php','lines'=>array('start'=>1,'end'=>3)));
		?>

	</div>
<!-- WIDGET MARKUP -->
	<div id="widgetMarkup">
		<h4> Widget </h4>
		<?php
		$this->widget('ext.smodal.widgets.modal', array(
				'title'=> "My modal",
				'content'=>"Modal content",
				//'draggable'=>true, 
				//'draggableSettings'=>array(),
				//'resizeable'=>true,
				//'resizeableSettings'=>array(),
				'modalID'=> "myModal",
				'triggerSelector'=>"#myModalTrigger",
				//'triggerEvent '=> "click", 
				//'buttons '=>"bmax,bfold,bpin",  
				//'ignore '=>"bspin,bmin", 
				//'templateHtml '=>"",
				//'boptions '=> array(  ),
			 ));
		?>
		<button id="myModalTrigger" class="btn">Open</button>
		<?php
$code = '';
			$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'php','lines'=>array('start'=>1,'end'=>3)));
		?>	
	</div>

<!-- JAVASCRIPT >-->
	<div id="jsMarkup">
	<h4> Thrue javascript </h4>
		<h5>Minimal js</h5>
		Pops up the default modal div with it's current content
		<?php
			$code = 'smodal();';
			$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'javascript','lines'=>array('start'=>1,'end'=>3)));
		?>
		<h5>Options</h5>
		Customize the modal.<br/>
		Pass settings to sModal() in  {setting:value} pairs.<br/>
		sModal accepts:
		<ul>
			<li>Element - the jQuery object to make modal</li>
			<li>Data - the content to put inside the modal.</li>
			<li>Html template - how to render the modal </li> 
			<li>Title - will be displayed in the draghandle </li>
			<li>Settings - {option:value} pairs or it will use bpopupDefaults() ( maps against bPopup settings)</li>
			<li>Buttons - classnames from the widget array to be used for this modal,hides the rest </li>
			<li>Ignore - Hides any class in this array, ['classname','classname2'] format </li>
			<li>Draggable - boolean, should the modal be draggable?
			<li>DraggableSettings - {option:value} pairs (maps against jquery-ui draggable options)</li>
			<li>Resizeable - boolean, should the modal be resizeable?</li>
			<li>ResizeableSettings -{option:value} pairs (maps against jquery-ui resizeable options)</li>			
		</ul> 
	<h5> An example </h5>	
		<?php		
$code = "$('#bpopup').sModal({
	title:'Draghandle', 
	htmlTemplate:'.sTemplate', 
	ignore:['bspin'],
	settings:{transition: 'slideDown'},
	draggable:true,
	draggableSettings:{snapMode:'inner'},
	resizeable:true,
	resizeableSettings:{
	    start:function(){
            element.children('.smodalContent').show();
        },
    },
})";
			
			$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'javascript','lines'=>array('start'=>1,'end'=>13)));
		?>
	</div>
<!-- examples-->
<div id="examples">
	<h3>Examples of sModal</h3>
<!-- Ignore buttons -->
	<h6> Ignore some actions button for one modal</h6>
	<button class="btn btn-success ignoreButtons">Demo</button>
	<div id="ignoreButtons" class="hide">
		Ignoring some action buttons
	</div>
	<script>
	$("body").on('click','.ignoreButtons',function(){
		sModal({
			element:$("#ignoreButtons"),
			ignore:["bpin","bmax"],
		});	
		});
	</script>
<?php
$code = '&lt;button class="btn btn-success ignoreButtons">Demo ignore&lt;/button>
&lt;div id="ignoreButtons">
	Ignoring some action buttons
&lt;/div>
&lt;script>
	$("body").on("click",".ignoreButtons",function(){
		$("#ignorebuttons").sModal({
			ignore:["bpin","bmax"],
		});
	});
&lt;/script>';
	$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'javascript','lines'=>array('start'=>1,'end'=>14)));
		?>
<!-- ajaxAbout -->		
	<h6>Modal with other then your default bPopup settings and some ajax data</h6>
		How  to make an easy get ajax request and with the isLoading() plugin<br/>
		The actual code for my "about" link to the left
<?php
$code = '$("body").on("click","#aboutUs",function(){
		$("#aboutUsDiv").css("display","block");
		$.isLoading( {"position": "overlay"});
		jQuery.get("/site/ajaxAbout", {}, function(data) {
			$("#aboutUsDiv").sModal({
				data:data,
				settings:{transition:"slideIn"}
			});		 
		$.isLoading("hide");
		});		
	});
';
$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'javascript','lines'=>array('start'=>1,'end'=>14)));
?>
	<h6>Forms</h6>
	<?php
$code = '
function handleContactForm(){
    var formFields=$("#contact-form").serialize();
    $.ajax({
            url: "/site/contact",
            type: "post",
            data: formFields,
            success: function (data) {
                var data = jQuery.parseJSON(data);              
                if(data.status=="success"){
                        //success
                      getModalElement().bPopup().close();
                      $("#contact-form").empty();
                }else{
                    $.sModal({
                        data:data.content,
                    });
                }
            }
        });
}  
//double trigger on two diffrent events
$("body").on("click","#contactSubmit",function(event){
	event.preventDefault();
	handleContactForm();
});
$("#contactForm").submit(function(event){
	event.preventDefault();
	handleContactForm();
});';
$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'javascript','lines'=>array('start'=>1,'end'=>32)));
?>
</div>

<!-- images -->
	<div id="images">
		<h4 id="images">Images</h4>
		Even though  sModal is no gallery viewer and more meant to be used to display pages or ajax content there is some image support.<br/>
		The html markup for displaying images is simply:
<?php
$code ='&lt;img  src="/path/to/image" rel="image" class="bOpen" alt="Here is an image"/>
&lt;a href="/path/to/image" rel="image" class="bOpen">who-said-it-was-hard-to-explain.jpg&lt;/a>';
$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'markup','lines'=>array('start'=>1,'end'=>3)));
?>

		<h6>With img tag, use "rel and src" attributes</h6>
		<img  width="150px" height="50px" src="/uploads/256076e2c265c8190bb498e3ed500ae6/who-said-it-was-hard-to-explain.jpg" rel="image" class="bOpen" alt="who-said-it-was-hard-to-explain.jpg"/>
		
		<h6>With other element use "rel and href" attributes</h6>
		<a href="/uploads/256076e2c265c8190bb498e3ed500ae6/who-said-it-was-hard-to-explain.jpg" rel="image" class="bOpen">who-said-it-was-hard-to-explain.jpg</a>

	</div>

<!-- JS FUNCTIONS -->

<h4 id="jsfunctions">Extra javascript functions</h4>
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
</div>

<!--
  
    
  
	