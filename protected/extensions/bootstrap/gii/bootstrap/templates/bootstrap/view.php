<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php
echo "<?php\n";
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	\$model->{$nameColumn},
);\n";
echo "?>";
?>

<h1>View <?php echo $this->modelClass." <?php echo \$model->{$this->tableSchema->primaryKey}; ?>"; ?></h1>

<?php echo "<?php"; ?> $this->widget('TbDetailView',array(
	'data'=>$model,
	'url' => $this->createUrl('/<?php echo $this->modelClass?>/updateAttribute'), //common submit url for all fields
    'params' => array('YII_CSRF_TOKEN' => Yii::app()->request->csrfToken), //params for all fields
	'attributes'=>array(
<?php
foreach($this->tableSchema->columns as $column){
	echo "array(
	   	 'name' => '".$column->name."',
		    'editable' => array(
			    'type' => 'text',
			    'inputclass' => 'input-large',			    			    
		    )
	    ),\n";
}
?>
	),
)); ?>
