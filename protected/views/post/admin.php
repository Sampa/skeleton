<?php $this->layout = 'main'; ?>
	
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
					'name'=>'title',
					'type'=>'raw',
					'value'=>'CHtml::link(CHtml::encode($data->title), $data->url)'
				),
				array(
					'name'=>'status',
					'value'=>'Lookup::item("PostStatus",$data->status)',
					'filter'=>Lookup::items('PostStatus'),
				),
				array(
					'name'=>'create_time',
					'type'=>'datetime',
					'filter'=>false,
				),
			
				 array(
				 	'value'=>'Post::parseText($data->content)',
					'name' => 'content',
					'filter'=>false,
				), 		
		       array(
            		'class'=>'bootstrap.widgets.TbButtonColumn',
            		'htmlOptions'=>array('style'=>'width: 70px'),
        		),
		        
			),
			)); 
		 ?>
</div>
</div>
<script>
$(document).ready(function(){
$(".yiiPager").addClass("pagination");
});
</script>