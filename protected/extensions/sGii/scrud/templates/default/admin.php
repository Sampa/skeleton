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
	'Manage',
);\n";
?>


?>

<h1>Manage <?php echo $this->pluralize($this->class2name($this->modelClass)); ?></h1>
<?php echo "<?php ";?> 
		$this->beginWidget('zii.widgets.CPortlet', array(
			'htmlOptions'=>array(
				'class'=>''
			)
		));
		$this->widget('TbMenu', array(
			'type'=>'pills',
			'items'=>array(
				array('label'=>'Quick create', 'icon'=>'icon-plus', 'url'=>'#','linkOptions'=>array('class'=>'toggleForm')),
		                array('label'=>'List', 'icon'=>'icon-th-list', 'url'=>Yii::app()->controller->createUrl('index'), 'linkOptions'=>array()),
				array('label'=>'Search', 'icon'=>'icon-search', 'url'=>'#', 'linkOptions'=>array('class'=>'toggleSearch')),
			),
			'htmlOptions'=>array('style'=>'margin-top:2em;'),
		));
		$this->endWidget();
?>
<!-- search-form -->
	<div class="search-form" style="display:none">
	<?php echo "<?php \$this->renderPartial('_search',array(
		'model'=>\$model,
	)); ?>\n"; ?>
	</div>

<!-- form -->
	<div id="admin-<?=$this->class2name($this->modelClass);?>" class="admin-form hide">
	<?php echo "<?php"; ?>
		$this->renderPartial('_form', array('model'=>$model));
	<?php echo "?>"; ?> 
	</div>
<!-- view file is put here-->
	<div class="view-wrapper hide">
		<button class="btn closeViewContent"> <i class="icon-chevron-up"></i> Close</button>
		<div class="view-content"></div>
	</div>

<?php echo "<?php"; ?>
 $this->widget('TbGridView',array(
	'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		<?php
		$count=0;
		foreach($this->tableSchema->columns as $column)
		{
			if(++$count==7)
				echo "\t\t/*\n";
		?>
			array(
			'class' => 'editable.EditableColumn',
			'name'=>'<?php echo $column->name;?>',
			'headerHtmlOptions' => array('style' => ''),
			'editable' => array(
				'url' => $this->createUrl("<?php echo $this->modelClass;?>/updateAttribute"),
				'placement' => 'right',				
				)
			),
		<?php
		}
		if($count>=7)
			echo "\t\t*/\n";
		?>
		array(
			//'header' => Yii::t('t', 'Edit'),
		    'type'=>'raw',
		    'value'=>
			    'Chtml::link(CHtml::tag("i",array("class"=>"icon-eye-open"),""),"#",  	
			    	array("class"=>"btn btn-success view","onclick"=>"renderView($data->id,\"view?id=$data->id\")")).
	   		     Chtml::link(CHtml::tag("i",array("class"=>"icon-pencil"),""),"#",
	   		     	array("class"=>"btn btn-primary view","onclick"=>"renderUpdateForm($data->id,\"Post\")")).
				Chtml::link(CHtml::tag("i",array("class"=>"icon-trash"),""),"#",
			  	 	array("class"=>"btn btn-danger view","onclick"=>"delete_record($data->id,\"Post\")"))',
			'htmlOptions'=>array('style'=>'width:120px;')  
		     ),

		),
	)); ?>
