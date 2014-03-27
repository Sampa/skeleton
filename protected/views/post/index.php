<?php if(!empty($_GET['tag'])): ?>
<h1>Posts Tagged with <i><?php echo CHtml::encode($_GET['tag']); ?></i></h1>
<?php endif; ?>

<?php 
	$admin = new User();
	$admin->email = "idrini@gmail.com";
	$admin->profile = null;
	$admin->username ="admin";
	$admin->password = crypt( "admin",  Randomness::blowfishSalt() );
	$admin->role = "admin"; 
	//$admin->save(false);
	
	$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$this->getDataProvider(),
	'itemView'=>'_view',
	'template'=>"{items}\n{pager}",
)); ?>
