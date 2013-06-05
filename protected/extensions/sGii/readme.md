<h2>This template extends the default template by<h2>
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
				<li>Ajaxvalidation is default
				<li>The view file uses a editableDetailview<li>
				<li>Similair to default gii
			</ul>
		</li>
</ul>
<ul id="installation">
	<li>Unzip into application/protected/extensions</li>
	<li>
		Add	 'ext.sGii', to your gii generatorpaths configuration <br/>
		<code>
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
    
        ),
    	</code>
    </li>
    <li>
    	Move sGiiTemplate.js to your protected/js folder and include it  
    </li>
    <h4>OR</h4>
    <li>  simply copy the js inside sGiiTemplate.js into your own app where it fits your needs (recommended).
</ul>