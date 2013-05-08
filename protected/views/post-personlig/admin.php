<?php $this->layout = 'main'; ?>
	<?php 
		$this->beginWidget('zii.widgets.CPortlet', array(
			'htmlOptions'=>array(
				'class'=>''
			)
		));
		$this->widget('bootstrap.widgets.TbMenu', array(
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
<div style="padding-left:0em; width:90%;">

	<!-- search-form -->
	<div class="search-form hide">
		<?php $this->renderPartial('_search',array('model'=>$model)); ?>
	</div>

	<!-- create/update-form -->
	<div  id="admin-post-form" class="admin-form hide">
			<a name="/uploads/256076e2c265c8190bb498e3ed500ae6/who-said-it-was-hard-to-explain.jpg" href="#" class="att">who-said-it-was-hard-to-explain.jpg</a>
			<?php
			if(!isset($modalUpdate))
				$modalUpdate = false;
			if(isset($model->id)){
				echo CHtml::tag('span',array('id'=>'modelId','style'=>'display:none;'),$model->id);
			}
			$form=$this->beginWidget('TbActiveForm',$formSettings); 
			?>
		<div id="post-form-fieldset">
			<?= $this->renderPartial('_formFields', array('model'=>$model,'form'=>$form),true);?>
		</div>
		<?php $this->endWidget(); ?>
	</div>
<div>
		<?php
			$upDateattributeUrl = $this->createUrl('post/updateAttribute');
			$this->widget('bootstrap.widgets.TbExtendedGridView',array(
			'id'=>'post-grid',
			//'fixedHeader' => true,
			'filter'=>$model,
			'dataProvider'=>$model->search(),
		    'type'=>'striped bordered condensed',
		    'template'=>'{pager}{items}{pager}{summary}',
			'columns'=>array(
				array(
					'class' => 'editable.EditableColumn',
					'name'=>'title',
					'headerHtmlOptions' => array('style' => ''),
					'editable' => array(
						'url' => $upDateattributeUrl,
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
						'url' => $upDateattributeUrl,
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
						'url' => $upDateattributeUrl,
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
					    'Chtml::link(CHtml::tag("i",array("class"=>"icon-eye-open"),""),"#",array("class"=>"btn btn-success view","onclick"=>"renderView($data->id)")).
			   		     Chtml::link(CHtml::tag("i",array("class"=>"icon-pencil"),""),"#",array("class"=>"btn btn-primary view","onclick"=>"renderUpdateForm($data->id,\"Post\")")).
					  	 Chtml::link(CHtml::tag("i",array("class"=>"icon-trash"),""),"#",array("class"=>"btn btn-danger view","onclick"=>"delete_record($data->id,\"Post\")"))',
					     'htmlOptions'=>array('style'=>'width:120px;')  
				     ),
		        
			),
			)); 
		 ?>
</div>
</div>
<script>
 	$('.modalUpdate').markItUpRemove(myBBcodeSettings);
 	$('.modalUpdate').markItUp(myBBcodeSettings);
 
</script>
