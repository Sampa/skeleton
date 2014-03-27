<?php
$this->breadcrumbs=array(
	'Posts'=>array('index'),
	'Create',
);
?>

<div class="row" style="min-width:100%;">
	<div class="col-lg-6"> 
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

	<div class="col-lg-3 uploadDiv">
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
			    'htmlOptions'=>'margin-left:30px; padding: 0px;',
			))); 
	?>
		<div id="dropZone"> <!--Drag & drop file upload area -->
			<span><?= Yii::t('skeleton','DRAG & DROP HERE');?></span>
		</div>							
		<div id="attachments">  <!-- container for where the file upload info is appended can have any ul within it-->
				<ul>
					<!--
					only foodata to test layout
					<li>	
						<i name="D:\Programmering\xampp\htdocs\linn\uploads/78785f4debd23c24e93850db2f58b88e/hface.png" class="icon-remove cursor delAttachment"></i>
						 <a href="/uploads/78785f4debd23c24e93850db2f58b88e/hface.png" title="hface.png">
						 <img src="/uploads/78785f4debd23c24e93850db2f58b88e/hface.png" title="hface.png" height="75" width="75"></a>					</li>
					</li>	
					<li>
						<i name="D:\Programmering\xampp\htdocs\linn\uploads/78785f4debd23c24e93850db2f58b88e/hface.png" class="icon-remove cursor delAttachment"></i> <a href="/uploads/78785f4debd23c24e93850db2f58b88e/hface.png"><img src="/uploads/78785f4debd23c24e93850db2f58b88e/hface.png" title="hface.png" height="75" width="75"></a>					</li>
					</li>
					--!
				</ul>
		</div>
	</div>
</div>
    
