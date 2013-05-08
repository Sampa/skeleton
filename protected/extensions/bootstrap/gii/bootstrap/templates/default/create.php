<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	'Create',
);\n";
?>
?>

<h1>Create <?php echo $this->modelClass; ?></h1>
<?php echo "<?php"; ?>
		$form=$this->beginWidget('TbActiveForm',$formSettings); 						
		echo $this->renderPartial('_formFields', array('model'=>$model,'form'=>$form),true);
		$this->endWidget();
<?php echo "?>"; ?> 
<?php echo "<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>
