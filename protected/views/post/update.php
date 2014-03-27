<?php
$this->breadcrumbs=array(
	'Posts'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

?>

<h1>Update Post <?php echo $model->id; ?></h1>
<hr/>
<?php
	$form=$this->beginWidget('TbActiveForm',$formSettings); 
		echo $this->renderPartial('_formFields', array('model'=>$model,'form'=>$form));
	$this->endWidget();
?>