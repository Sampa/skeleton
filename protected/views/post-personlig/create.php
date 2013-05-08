<?php
$this->breadcrumbs=array(
	'Posts'=>array('index'),
	'Create',
);
?>
<div class="container" style="width:100%;">
	<a name="/uploads/256076e2c265c8190bb498e3ed500ae6/who-said-it-was-hard-to-explain.jpg" href="#" class="att">who-said-it-was-hard-to-explain.jpg</a>
	<div style="float:left;"> 
		<?php
			isset($iframe) ? $iframe=$iframe : $iframe = false;
		if(!isset($modalUpdate))
			$modalUpdate = false;
		if(isset($model->id)){
			echo CHtml::tag('span',array('id'=>'modelId','style'=>'display:none;'),$model->id);
		}
	
		$form=$this->beginWidget('TbActiveForm',$formSettings); 
			echo $this->renderPartial('_formFields', array('model'=>$model,'form'=>$form));
		$this->endWidget();
		?>

	</div>

	<div class="uploadButtons">
	<?php
		$this->widget('bootstrap.widgets.TbFileUpload', array(
		    'url' => $this->createUrl("post/upload"),
		    'model' => $model,
		    'downloadTemplate'=>"false",
		    'attribute' => 'picture', 
		    'multiple' => true,
		    'options' => array(
			    'autoUpload'=>true,
			    'maxFileSize' => 2000000,
		   	    'completed' => 'js:function (e,data) {uploadCallback(e,data);}',
			    'dropZone'=>'#dropZone',
			    'acceptFileTypes' => 'js:/(\.|\/)(gif|jpe?g|png)$/i',
			    'htmlOptions'=>'margin-left:0px; padding: 0px;',
			))); 
	?>
		<div id="dropContainer">
				<div id="dropZone"> <!--Drag & drop file upload area -->
					<span><?= Yii::t('skeleton','DRAG & DROP HERE');?></span>
				</div>							
		</div>
		<div id="attachments">  <!-- container for where the file upload info is appended can have any ul within it-->
				<ul>
					<li>	
					</li>
				</ul>
		</div>
	</div>
</div>
