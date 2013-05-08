<?php
$this->breadcrumbs=array(
	'Posts'=>array('index'),
	'Create',
);
?>

<h1>Create Post</h1>
<?php
			echo $this->renderPartial('_form', array('model'=>$model));
?> 
