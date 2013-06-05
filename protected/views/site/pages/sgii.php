<div  id="navparent">
    <ul  class="nav nav-list functions" data-spy="affix">
        <li><a href="#top">Introduction</a></li>
        <li><a href="#installation">Thrue html</a></li>       
        <li><a href="#examples">Examples</a></li>
		<li><a href="#customize">Customization</a></lil
    </ul>
</div>
<div class="span8 extDescription" id="top">
<h3> sGii </h3>
<a href="/post/admin" class="btn btn-primary">Demo</a>
<h4> Beta, please report any bugs to me</h4>
	<ul>
		<li>Single page ajax crud including multi delete</li>
		<li>Normal crud pages to</li>
		<li>No js in views</li>
		<li>One small js file works for every set of views making it easy to change the behaviour</li>
		<li>Easy to make the view or forms display in a modal instead</li>
		<li>Full version is bootstrapped and uses x-editable grid</li>
		<li>Basic bootstrap version without x-editable</li>
		<li>Ajax validation is on with full features by default</li>
		
	</ul>

<h3>This template extends the default template by</h3>
	<ul>
		<li>
			Admin page, handle all crud possibilites:			
			<ul>
				<li>Added functionality to quickly create new models without page reload
				<li>Updating a whole model does not requiere you to reload page
				<li>The fields in the grid are editable thrue X-Editable extension
				<li>Bootstrap design
			</ul>
		</li>
		<li>
			Controller:
			<ul>
				<li>Extra actions to handle updates thrue ajax
				<li>Update,view and create actions can handle ajax requests
				<li>delete and performAjaxValidation methods are universal, one can simply remove these from the template and put only one
				<li>set of them in their base controller. (Usually components/Controller.php)
			</ul>
		</li>
		<li>	
			Javascript:
			<ul>
				<li>A few functions handlies the create,update and other requests for any model</li>
				<li>Can be customized easily to display the content in modals and use prefferred notifications</li>
			</ul>
		</li>
		<li>
			Views
			<ul>
				<li>Admin Crud view</li>
				<li>Normal create/update/index/_form views</li>
				<li>Ajaxvalidation is default</li>
				<li>The view file uses a editableDetailview<li>
				<li>Similair to default gii</li>
			</ul>
		</li>
</ul>
<h3 id="installation"> Installation </h3>
Yii-Bootstrap or Yii-Booster  and <a href="http://x-editable.demopage.ru/">X-editable</a> is requiered for the full version.<br/>
<ul>
	<li>Extract sGii to /protected/extensions/sGii</li>
	<li>Copy sGiitemplate.js somewhere and include it, if you customize it now or later doesn't matter</li>	 
		<li>Unzip into application/protected/extensions</li>
	<li>
		Add	 'ext.sGii', to your gii generatorpaths configuration <br/>

<?php
$code ="
	'modules' => array(
 		...<br/>
 		'gii'=>array(<br/>
   			'class'=>'system.gii.GiiModule',<br/>
    		'password'=>'123',<br/>
    		'generatorPaths' => array(<br/>
				'ext.sGii',<br/>
				),<br/>
		),<br/>
		...<br/>

),";
 $this->widget('ext.sprism.sprism',array('content'=>$code,'lines'=>array('start'=>1,'end'=>12,'each'=>true)));
 ?>
    </li>
    <li>
    	Move sGiiTemplate.js to your protected/js folder and include it  
    </li>
    <h4>OR</h4>
    <li>  simply copy the js inside sGiiTemplate.js into your own app where it fits your needs (recommended).
</ul>


	<div id="customize">
		<h3> Customization</h3>

		<button class="btn btn-primary bOpen" data-target="customCrudDiv" data-buttons="bpin,bclose" id="customCrud">Using with modals</button>
		<div id="customCrudDiv" style="display:none;">
			<?php $this->renderPartial("/site/sGiiModalreadme");?>
		</div>
		<button class="btn btn-primary bOpen" data-target="customDeleteDiv" data-buttons="bpin,bclose" id="customDelete">Changing confirm for delete</button>
		<div id="customDeleteDiv" style="display:none;">
			<?php $this->renderPartial("/site/sGiiConfirmreadme");?>
		</div>

	</div>
</div>