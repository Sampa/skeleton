	<?php 
		$code = "\$this->widget('ext.smodal.smodal', array(
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
			$code = '$.sModal();';
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
		$("#ignoreButtons").sModal({
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
		If you want more control over your ajax requests then jQuery.load() can offer you open the modal in the successfunction
<?php
$code = '$("body").on("click","#aboutUs",function(){
		jQuery.get("/site/ajaxAbout", {}, function(data) {
			$.sModal({
				data:data,
				settings:{transition:"slideIn"}
			});		 
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
<!-- CONFIRM -->

	<div id="confirm">
		<h4> Confirm dialog </h4>
		Set the "confirm option", use the rest of the options as normal with exception for "data" attribut which will be ignored.
<?php
$code ="$.sModal({
		confirm:{
				'yes':{
					'label':'Yes',
					'class':'btn btn-success',
					'click':function(){
						alert('You choose yes');
						//close the popup by passing any child element if you wish
						closeModal($(this));
				}
				},
				'no':{
					'label':'No',
					'class':'btn btn-danger',			
					'click':function(){
						alert('You choose no');
						closeModal($(this));
					}
				},
			},
		
		title:'Are you sure?',
		buttons:['bclose'],	
	});";
	 $this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'javascript','lines'=>array('start'=>1,'end'=>20)));
?>