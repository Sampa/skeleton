	<div class="form">
	<?php $form=$this->beginWidget('TbActiveForm',array(
		'id'=>'post-form',
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
						'class'=>'form-inline',
					)
	)); ?>
	<?php echo $form->errorSummary($model); ?>
			<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>128)); ?>
			<?php echo $form->textAreaRow($model,'content',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
			<?php echo $form->textAreaRow($model,'tags',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
			<?php echo $form->textFieldRow($model,'status',array('class'=>'span5')); ?>
			<?php echo $form->textFieldRow($model,'create_time',array('class'=>'span5')); ?>
			<?php echo $form->textFieldRow($model,'update_time',array('class'=>'span5')); ?>
			<?php echo $form->textFieldRow($model,'author_id',array('class'=>'span5')); ?>
			<?php echo $form->textFieldRow($model,'fileFolder',array('class'=>'span5','maxlength'=>255)); ?>
		<div class="form-actions">
		<!-- content of this element is displayed in the submitbutton while form is beeing submitted-->
		<span class="hide whileLoad"><i class="icon-repeat"></i></span>
			<?php $this->widget('TbButton', array(
				'buttonType'=>'submit',
				'type'=>'primary',
				'label'=>$model->isNewRecord ? 'Create' : 'Save',
			)); ?>
		</div>

	<?php $this->endWidget(); ?>
	</div>