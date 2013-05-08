
<div id="leaveCommentDiv"> 
	<h3 id="commentHeader"><?=Yii::t('skeleton','Leave a Comment');?></h3>

	<div class="form">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'comment-form',
			'enableAjaxValidation'=>true,
			'enableClientValidation'=>true,
			'clientOptions' => 
				 array(
					  'validateOnSubmit'=>true,
					  'validateOnChange'=>true,
					  'validateOnType'=>true,
					 ),

		)); ?>

			<?php echo $form->hiddenField($model,'author',array('size'=>60,'maxlength'=>128,'value'=>Yii::app()->user->id)); ?>
		

			<div class="row-fluid">
				<?php echo $form->labelEx($model,'content'); ?>
				<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50,'style'=>'width:320pt;')); ?>
				<?php 
					$content_settings = array(
						'attribute' => "content", //requiered, the attribute of the form field 
						'top' => "-35pt", //optional, relative positioning from below the form element
						'left' => "0px", //optional,  relative positioning from below the form element
						'model'=>$model, //needed
						'form'=>$form, //only used if type != tooltip
						'headerText' =>Yii::t('skeleton',"Required field"), //the title of the popover displayed for the user
						'headerClass' =>"btn-danger",  // optional class to style the header of the popover
					); 
					//validation widget
					$this->widget('TbPopVal',$content_settings);
					//tooltip/hint/instructional widget, change some of the settings
					$content_settings['type'] = "tooltip"; // change type to tooltip so the user gets instructions rather then warning
					$content_settings['content'] = Yii::t('skeleton','Cannot be empty and can have a maximum of 128 characters'); //describe the validation rule
					$content_settings['width']= "23.5em"; //width of the content box,  optional
					$content_settings['headerClass'] = "btn-primary"; // style the header where the "content" option is displayed
					$this->widget('TbPopVal',$content_settings); //hint widget
			?>
			</div>

			
			<?= CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save', array('data-dismiss'=>'modal', 'class'=>'btn btn-success')); ?>
					
			<?php $this->endWidget(); ?>

	</div><!-- form -->

<script>
</script>
</div> <!-- comment -->