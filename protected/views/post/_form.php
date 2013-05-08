<?php $form=$this->beginWidget('TbActiveForm',array(
	'id'=>'post-form',
	'action'=>'/post/create',
	'enableAjaxValidation'=>true,
			'enableClientValidation'=>true,
			'clientOptions' => array(
					  'validateOnSubmit'=>true,
					  'validateOnChange'=>true,
					  'validateOnType'=>true,
					 ),
		        'method'=>'post',
				'type'=>'horizontal',
				'htmlOptions'=>array(
					'enctype'=>'multipart/form-data',
				)
)); ?>
	<fieldset>
	
	<div class="row-fluid">
	<?=$form->errorSummary($model,Yii::t('skeleton','Error'), null,array('class'=>'alert alert-error')); ?>
	</div>


	<!-- TITLE -->
  
  	<div class="control-group">
		<?php 
			echo $form->labelEx($model,'title'); 
			echo $form->textField($model,'title',array('size'=>80,'maxlength'=>128)); 

			$title_settings = array(
				'attribute' => "title", //requiered, the attribute of the form field 
				'top' => "-35pt", //optional, relative positioning from below the form element
				'left' => "0px", //optional,  relative positioning from below the form element
				'model'=>$model, //needed
				'form'=>$form, //only used if type != tooltip
				'headerText' =>Yii::t('skeleton',"Required field"), //the title displayed for the user
				'headerClass' =>"btn-danger",  // optional class to style the header of the popover
			); 
			//validation widget
			$this->widget('TbPopVal',$title_settings);
			//tooltip widget, change some of the settings
			$title_settings['type'] = "tooltip"; // change type to tooltip so the user gets instructions rather then warning
			$title_settings['content'] = Yii::t('skeleton','Title must have atleast 1 character'); //describe the validation rule
			$title_settings['width']= "20.5em"; //width of the content box,  optional
			$title_settings['headerClass'] = "btn-primary"; // style the header where the "title" option is displayed
			$this->widget('TbPopVal',$title_settings);
		?>
	</div>

	<!-- CONTENT -->
	<div class="row-fluid control-group">
		<?php
			//to prevent double menu hooking
			isset($modalUpdate)? $textAreaClass="modalUpdate": $textAreaClass = null;
			echo CHtml::activeTextArea($model,'content',array('class'=>$textAreaClass,'rows'=>10,'style'=>'')); 
			$content_settings = array(
					'attribute' => "content", //requiered, the attribute of the form field 
					'top' => "-15em", //optional, relative positioning from below the form element
					'left' => "33em", //optional,  relative positioning from below the form element
					'model'=>$model, //needed
					'form'=>$form, //only used if type != tooltip
					'headerText' =>Yii::t('skeleton',"Required field"), //the content displayed for the user
					'headerClass' =>"btn-danger",  // optional class to style the header of the popover
				); 
			//validation widget
			$this->widget('TbPopVal',$content_settings);
			//tooltip widget, change some of the settings
			$content_settings['type'] = "tooltip"; // change type to tooltip so the user gets instructions rather then warning
			$content_settings['content'] = Yii::t('skeleton','Content must have atleast 1 character'); //describe the validation rule
			$content_settings['width']= "20.5em"; //width of the content box,  optional
			$content_settings['headerClass'] = "btn-primary"; // style the header where the "content" option is displayed
			$this->widget('TbPopVal',$content_settings);
		?>
	</div>

	<!-- TAGS -->
	<div class="row-fluid control-group">
		<?php
 	 		echo $form->labelEx($model,'tags',array()); 
			echo $form->textField($model,'tags',array('size'=>80,'maxlength'=>255,'style'=>'min-width:221px;')); 

			$tags = Tag::model()->suggestTags("",100);
				$this->widget('ext.select2.ESelect2',array(
				  'selector'=>'#Post_tags',
				  'options'=>array(
				    'tags'=>$tags,
				  ),
				  'htmlOptions'=>array(
				  	'name'=>'Post[tags]',
				  	'id'=>'Post_tags',
				  	'style'=>';'
				  )
				));
		?>
	</div>

	<!-- STATUS -->
	<div class="row-fluid control-group">
		<?php
			echo $form->dropDownList($model,'status',Lookup::items('PostStatus')); 
		
			$status_settings = array(
				'type'=> 'tooltip',
				'attribute' => "status", //requiered, the attribute of the form field 
				'top' => "-12em", //optional, relative positioning from below the form element
				'left' => "-17em", //optional,  relative positioning from below the form element
				'model'=>$model, //needed
				'form'=>$form, //only used if type != tooltip
				'width'=>'20em',
				'position'=>'top',
				'headerText' =>Yii::t('skeleton',"Required field"), //the title displayed for the user
				'content' =>  Yii::t('skeleton',"Published, will be visible for all <br/>  Draft, will be saved for later publishing  <br/> Archived, are no longer relevant"), 
			); 
			//validation widget
			$this->widget('TbPopVal',$status_settings);

		?>
	</div>
	<!-- hiddenfields for special data -->
	<?= $form->hiddenField($model,'id',array("value"=>isset($model->id)?$model->id:null)); ?>
	<?= $form->hiddenField($model,'fileFolder');?>
	<?= $form->hiddenField($model,'author_id');?>

	<!-- BUTTONS -->
	<div style=" margin-top:1em;">
	<!-- content of this element is displayed in the submitbutton while form is beeing submitted-->
	<span class="hide whileLoad"><i class="icon-spinner icon-spin"></i> </span>
	<?php 
		$this->widget('TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
            'icon'=>'ok white',  
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
			'htmlOptions'=>array('id'=>'submitPost', 'class'=>''),
		)); 
    	$this->widget('TbButton', array(
			'buttonType'=>'reset',
            'icon'=>'remove',  
			'label'=>'Reset',
		)); 
	?>
	</div>
</fieldset>



<?php $this->endWidget(); ?>
	<span class="hide whileLoad"><i class="icon-repeat"></i></span>
