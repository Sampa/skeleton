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
	<?php	$this->renderPartial('_form', array('model'=>$model));	?> 
	</div>
<!-- view file is put here-->
	<div class="view-wrapper hide">
		<button class="btn closeViewContent"> <i class="icon-chevron-up"></i> Close</button>
		<div class="view-content"></div>
	</div>


<!-- multi delete -->	
<button class="deleteSelected btn btn-danger hide"><i class="icon-trashbin">Delete selected</button>
<div class="select-result" class="hide"></div>

<?php 
	$updateAttributeUrl = $this->createUrl('post/updateAttribute');
	$this->widget('TbGridView',array(
		'id'=>'post-grid',
		'filter'=>$model,
		'afterAjaxUpdate'=>"function(id,data){ makeSelectable(id);}", 
		'dataProvider'=>$model->search(),
	    'type'=>'striped bordered condensed',
	    'template'=>'{pager}{items}{pager}{summary}',
		'columns'=>array(
			array(
				'class' => 'editable.EditableColumn',
				'name'=>'title',
				'headerHtmlOptions' => array('style' => ''),
				'editable' => array(
					'url' => $updateAttributeUrl,
					'placement' => 'right',
				)
			),
			 array(
			 	'value'=>'Post::parseText($data->content)',
			 	'type'=>'raw',
				'class' => 'editable.EditableColumn',
				'name' => 'content',
				'filter'=>false,
				'editable' => array(
					'type' => 'textarea',
					'url' => $updateAttributeUrl,
					'placement' => 'right',
				)
			), 
			array(
				'class' => 'editable.EditableColumn',
				'name' => 'status',
				'filter'=>false,
				'headerHtmlOptions' => array('style' => 'width: 100px'),
				'editable' => array(
					'type' => 'select',
					'url' => $updateAttributeUrl,
					'source' => Lookup::items('PostStatus'),//$this->createUrl('site/getStatusList'),
					'options' => array( //custom display
						'display' => 'js: function(value, sourceData) {
							var selected = $.grep(sourceData, function(o){ return value == o.value; }),
							colors = {1: "blue", 2: "green", 3: "red"};
							$(this).text(selected[0].text).css("color", colors[value]);
						}'
					),
				//onsave event handler
					'onSave' => 'js: function(e, params) {
						console && console.log("saved value: "+params.newValue);
					}'
				)
			),
			array(
				'header'=>'Created',
				'name'=>'create_time',
				'type'=>'datetime',
				'filter'=>false,
			),
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
<script>	
	$(function() {
		var grid = $(".grid-view").attr('id');
		makeSelectable(grid);		
	});
</script>
