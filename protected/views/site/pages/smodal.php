

<div  id="navparent">
    <ul  class="nav nav-list functions" data-spy="affix">
        <li><a href="#top">Introduction</a></li>
        <li><a href="#htmlMarkup">Basic modal thrue html</a></li>
        <li><a href="#jsMarkup">Thrue javascript</a></li> 
        <li><a href="#examples">Examples</li>
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


<div class="well span8" id="top" style="margin-left:170px;">
	<h3> sModal </h3>
	<p>
		Modal madness based on  <a href="http://dinbror.dk/blog/bPopup/">bPopup</a><br/>
		Please use the link above for details on the basic usage.<br/>
		Designed to make it easy to use modals  in any project and with many purposes without much work or repeated code writing<br/>
		<a href="https://github.com/Sampa/sModal">Github repositry</a> 
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
		<ul>
			<li>
				<em>String</em> <b>commonClass</b> - class(es) to give the action buttons<br/>
				Default: "btn btn-small"
			</li>
			<li>
				<em>Array</em> <b>buttons</b> - action buttons to show in the modal. <br/>
				Any 'icon' value will result in a &lt;i&gt; element with the value as class attribute<br/>
				You can also specify html attribute instead of icon if you wish<br/>
			</li>
			<li> 
				<em>Boolean</em> <b>taskbar</b> - should the taskbar with pinned modals be rendered? 
				Default:false
			</li>
			<li>
				<em>String</em> <b>headerText</b> - what to use as modal title when no title is passed to smodal()<br/>
				Defaults to &lt;i class="icon-fullscreen">&lt;/i> 
			</li>
			<li> <em>Boolean</em> <b>draggable</b> - should the modals be draggable by default? </li>
			<li> <em>Boolean</em> <b>resizeable</b> - should the modals be resizeable by default? </li>
			<li><em>Array</em> <b>options</b> - bPopup settings that you want to use as defaults
		</ul>
		<h6>Example:</h6>
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
	            'follow'=>array(false,true),   //Should the popup follow the screen vertical and/or horizontal on scroll/resize? [horizontal, vertical, fixed on screen see positionStyle instead)] Version 0.3.6. Changed in version 0.5.0 and again in version 0.6.0 and again in version 0.7.0.
			 	'content' =>'ajax',//image ,iframe
	            'positionStyle' => 'absolute', //'fixed' or 'absolute'
	            'easing' => 'easeInOutExpo', //uses jQuery easing plugin
	            'transition' => 'fadeIn', //The transition of the popup when it opens. Types' => ['fadeIn', 'slideDown', 'slideIn']. Version 0.9.0
	            'followEasing' =>'swing', //   The follow easing of the popup. uses Easing plugin. Version 0.9.0
	            'followSpeed' => 500, //  Animation speed for the popup on scroll/resize. Version 0.3.6
	            'loadData' => false, //    LoadData is representing the data attribute in the jQuery.load, // method. It gives you the opportunity to submit GET or POST values through the ajax request. Version 0.9.0
	            'loadUrl' => false, //     External page or selection to load in popup. See loadCallback for callback. Version 0.3.4
	            'modal' => false, //   Should there be a modal overlay behind the popup?
	            'modalClose' => true, //   Should the popup close on click on overlay? Version 0.4.0
	            'modalColor' => '#eee', //     What color should the overlay be? Version 0.3.5
	            'opacity' => 0.9, //   Transparency, from 0.1 to 1.0 filled, //. Version 0.3.3
	            'positionStyle' => 'absolute', //  The popup's position. 'absolute' or 'fixed'  Version 0.7.0
	            'scrollBar' => true, //    Should scrollbar be visible?
	            'speed' => 650, //     Animation speed on open/close. Version 0.9.0
	            'zIndex' =>9999,
	            'loadCallback'=>'$('.loadIcon').remove();', //callback example usage
	            'onOpen'=>'', //callback 
	            'onClose'=>'', //callback
	            'afterOpen'=>'',//callback
	            'closeClass'=>'bclose', 
	            'position'=>array('auto',10),       
			)
		));";

		$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'php','lines'=>array('start'=>1,'end'=>55)));
	?>
    
	<h3>Usage</h3>
	
<!-- HTML MARKUP-->
	<div id="htmlMarkup">
	<h4> Thrue html </h4>
		No javascript is needed for this
		<h5> With minimal html markup</h5>
		<button class="bOpen btn btn-success" data-target="foo">Example</button>
		<div id="foo">Content</div>
		<?php 
$code = '&lt;button class="bOpen btn" data-target="foo">FooModal&lt;/button>
&lt;div id="foo">Content&lt;/div>';
			$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'php','lines'=>array('start'=>1,'end'=>3)));
		?>
		<h5> With  custom title</h5>

		<?php
$code = '&lt;button class="bOpen btn" data-target="foo">FooModal&lt;/button>
&lt;span class="bTitle"> &lt;i class="icon-screenshot">&lt;/i> FooTitle&lt;/span>
&lt;div id="foo">Content&lt;/div> ';
			$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'php','lines'=>array('start'=>1,'end'=>3)));
		?>		
	

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
			<li>Settings - {option:value} pairs or it will use modalDefaults() ( maps against bPopup settings)</li>
			<li>Buttons - classnames from the widget array to be used for this modal,hides the rest </li>
			<li>Ignore - Hides any class in this array, ['classname','classname2'] format </li>
			<li>Draggable - boolean, should the modal be draggable?
			<li>DraggableOptions - {option:value} pairs (maps against jquery-ui draggable options)</li>
			<li>Resizeable - boolean, should the modal be resizeable?</li>
			<li>ResizeableOptions -{option:value} pairs (maps against jquery-ui resizeable options)</li>			
		</ul> 
	<h5> An example </h5>	
		<?php		
$code = "smodal{
	element:$('#bpopup'),
	data:$('#bpopup').html(),
	title:'Draghandle', 
	htmlTemplate:'.sTemplate', 
	ignore:['bspin'],
	settings:{transition: 'slideDown'},
	draggable:true,
	draggableOptions:{snapMode:'inner'},
	resizeable:true,
	resizeableOptions:{
	    start:function(){
            element.children('.smodalContent').show();
        },
    },
}";
			
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
		sModal({
			element:$("#ignoreButtons"),
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
			sModal({
				element:$("#aboutUsDiv"),
				data:data,
				settings:{transition:"slideIn"}
			});		 
		$.isLoading("hide");
		});		
	});
';
$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'javascript','lines'=>array('start'=>1,'end'=>14)));
?>
	<h6>Modal with advanced ajax request</h6>
	<button class="btn btn-success ajaxExample">Demo</button>
	My actual code for the contact button on the left of my page.<br/> 
	<script>
		$("body").on('click','.ajaxExample',function(){
			var settings = modalDefaults();
			settings.transition= "slideIn";
			handleContactForm();
		});
	</script>
<?php
$code = '//contactus the left menu button
$("body").on("click",".ajaxExample",function(e){
	e.preventDefault();
	var settings = modalDefaults();
	settings.transition= "slideIn";
	handleContactForm();//request render reset
});

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
                    sModal({
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
$code ='&lt;img  src="/uploads/256076e2c265c8190bb498e3ed500ae6/who-said-it-was-hard-to-explain.jpg" rel="image" class="bOpen" alt="who-said-it-was-hard-to-explain.jpg"/>';
$code .= '&lt;a href="/uploads/256076e2c265c8190bb498e3ed500ae6/who-said-it-was-hard-to-explain.jpg" rel="image" class="bOpen">who-said-it-was-hard-to-explain.jpg&lt;/a>';
$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'markup','lines'=>array('start'=>1,'end'=>3)));
?>

		<h6>With img tag, use "rel and src" attributes</h6>
		<img  width="150px" height="50px" src="/uploads/256076e2c265c8190bb498e3ed500ae6/who-said-it-was-hard-to-explain.jpg" rel="image" class="bOpen" alt="who-said-it-was-hard-to-explain.jpg"/>
		
		<h6>With other element use "rel and href" attributes</h6>:
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
				$code = "function maximizeModal($(\"#bpopup\"),50,100)";
				$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'javascript','lines'=>'1'));
			?>		
	</div>
<!-- MINMODAL-->
	<div id="minModal">
		<h5> minimizeModal(obj element)</h5>
			Minimizes the modal to minimizeWidth and minimizeHeight from sSettings();
		 	Uses animations that you can change if you wish.
			<?php
				$code = "function minmizeModal($(\"#bpopup\"))";
				$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'javascript','lines'=>'1'));
			?>
	</div>
<!-- FOLDMODAL-->
	<div id="foldModal">
		<h5> foldModal(obj element)</h5>
			 Uses one animation that you can change if you wish.
			<?php
				$code = "function foldModal($(\"#bpopup\"))";
				$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'javascript','lines'=>'1'));
			?>
	</div>
<!-- UNFOLDMODAL-->
	<div id="unfoldModal">
		<h5> unfoldModal(obj element)</h5>
			 Uses one animation that you can change if you wish.
			<?php
				$code = "function unfoldModal($(\"#bpopup\"))";
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
			<button class="bOpen btn btn-success" data-target="customAction">Demo</button>
		<div id="customAction">notice  the "B" button</div>

<?php
$code = "$(\"body\").on('click','.sblink',function(){
	var modal = getModalFromButton($(\"this\"));
	foldModal(modal);
	unfoldModal(modal);
	minimizeModal(modal);
	maximizeModal(modal);
});";
$this->widget('ext.sprism.sprism',array('content'=>$code,'lines'=>'1'));

?>
	</div>
</div>

<!--
  
    
    /*
        Accepts: a modal element and the height to restore to
        Puts the modal in unfolded mode
    */ 
    function unfoldModal(element,height){
        //make sure modal is seen
        element.show();
        //make sure content is shown
        element.children(".smodalContent").slideDown();
        //The animation    
        element.animate({
                height:height,        
            }, 600, function() {
            // Animation complete.
        });
    }

function sModal(options){
        //if no custom settings sent along, use defaults
        if(options.settings==null){
            options.settings = modalDefaults();
        }
        if(!options.element){
            element = getModalElement();
        }else{element = options.element;}
        //if there is no data sent,back up and use the divs current content 
        if(!options.data){
            data = element.html(); 
        }

        // insert design template
        var templateHtml = $(".sTemplate").html();        
        element.html(templateHtml);
        if(options.title){
            element.children('.draghandle').html(options.title);
        }

        $(element).children(".smodalContent").html(data);              
       
        if(!element.hasClass('bpopup')){
            element.addClass('bpopup');
        }                
        //show modal                
        element.bPopup(options.settings);
        element.draggable();
        if(!options.resizeSettings){
            options.resizeSettings = {}
        }
        resizeModals(element,options.resizeSettings);
       
        //return element with data
        return element.children(".smodalContent");
}-->
	