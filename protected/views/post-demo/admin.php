<?php
$this->breadcrumbs=array(
	'Posts'=>array('index'),
	'Manage',
);


?>

<h1>Manage Posts</h1>
<?php  
		$this->beginWidget('zii.widgets.CPortlet', array(
			'htmlOptions'=>array(
				'class'=>''
			)
		));
		$this->widget('TbMenu', array(
			'type'=>'pills',
			'items'=>array(
				array('label'=>'Create / Update', 'icon'=>'icon-plus', 'url'=>'#','linkOptions'=>array('class'=>'toggleForm')),
		                array('label'=>'List', 'icon'=>'icon-th-list', 'url'=>Yii::app()->controller->createUrl('index'), 'linkOptions'=>array()),
				array('label'=>'Search', 'icon'=>'icon-search', 'url'=>'#', 'linkOptions'=>array('class'=>'toggleSearch')),
			),
			'htmlOptions'=>array('style'=>'margin-top:2em;'),
		));
		$this->endWidget();
?>
<!-- search-form -->
	<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
		'model'=>$model,
	)); ?>
	</div>

<!-- form -->
	<div id="admin-Post" class="admin-form hide">
	<?php		$this->renderPartial('_form', array('model'=>$model));
	?> 
	</div>
<!-- view file is put here-->
	<div class="view-wrapper hide">
		<button class="btn closeViewContent"> <i class="icon-chevron-up"></i> Close</button>
		<div class="view-content"></div>
	</div>

<?php $this->widget('TbGridView',array(
	'id'=>'post-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
					array(
			'class' => 'editable.EditableColumn',
			'name'=>'id',
			'headerHtmlOptions' => array('style' => ''),
			'editable' => array(
				'url' => $this->createUrl("Post/updateAttribute"),
				'placement' => 'right',				
				)
			),
					array(
			'class' => 'editable.EditableColumn',
			'name'=>'title',
			'headerHtmlOptions' => array('style' => ''),
			'editable' => array(
				'url' => $this->createUrl("Post/updateAttribute"),
				'placement' => 'right',				
				)
			),
					array(
			'class' => 'editable.EditableColumn',
			'name'=>'content',
			'headerHtmlOptions' => array('style' => ''),
			'editable' => array(
				'url' => $this->createUrl("Post/updateAttribute"),
				'placement' => 'right',				
				)
			),
					array(
			'class' => 'editable.EditableColumn',
			'name'=>'tags',
			'headerHtmlOptions' => array('style' => ''),
			'editable' => array(
				'url' => $this->createUrl("Post/updateAttribute"),
				'placement' => 'right',				
				)
			),
					array(
			'class' => 'editable.EditableColumn',
			'name'=>'status',
			'headerHtmlOptions' => array('style' => ''),
			'editable' => array(
				'url' => $this->createUrl("Post/updateAttribute"),
				'placement' => 'right',				
				)
			),
					array(
			'class' => 'editable.EditableColumn',
			'name'=>'create_time',
			'headerHtmlOptions' => array('style' => ''),
			'editable' => array(
				'url' => $this->createUrl("Post/updateAttribute"),
				'placement' => 'right',				
				)
			),
				/*
			array(
			'class' => 'editable.EditableColumn',
			'name'=>'update_time',
			'headerHtmlOptions' => array('style' => ''),
			'editable' => array(
				'url' => $this->createUrl("Post/updateAttribute"),
				'placement' => 'right',				
				)
			),
					array(
			'class' => 'editable.EditableColumn',
			'name'=>'author_id',
			'headerHtmlOptions' => array('style' => ''),
			'editable' => array(
				'url' => $this->createUrl("Post/updateAttribute"),
				'placement' => 'right',				
				)
			),
					array(
			'class' => 'editable.EditableColumn',
			'name'=>'fileFolder',
			'headerHtmlOptions' => array('style' => ''),
			'editable' => array(
				'url' => $this->createUrl("Post/updateAttribute"),
				'placement' => 'right',				
				)
			),
				*/
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
