<?php
$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);	
	//success flash
if(Yii::app()->user->hasFlash('contact')): 
		Yii::app()->user->setFlash('success', Yii::app()->user->getFlash('contact'));
else: 
	//form	
	echo CHtml::tag('div',array('class'=>'form','style'=>'margin-top:5px;'));

		$form = $this->beginWidget('TbActiveForm', array(
			   		'id'=>'contact-form',
			   		'enableAjaxValidation'=>true,
			    	'enableClientValidation'=>true,
			    	'clientOptions'=>array(
			    		'validateOnType'=>true,
			    	),
			    	'htmlOptions'=>array('class'=>'form-inline'),
			    )); 
		
		//error summary
		echo $form->errorSummary($model); 

		//name
		echo CHtml::tag('div',array('class'=>''));
			echo $form->labelEx($model,'name'); 
			echo $form->textField($model,'name'); 
		echo CHtml::closeTag('div');

		//email
		echo CHtml::tag('div',array('class'=>''));
			echo $form->labelEx($model,'email'); 
			echo $form->textField($model,'email');
		echo CHtml::closeTag('div');

		//subject
		echo CHtml::tag('div',array('class'=>''));
			echo $form->labelEx($model,'subject');
			echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>128));
		echo CHtml::closeTag('div');

		//body
		echo CHtml::tag('div',array('class'=>''));
			echo $form->labelEx($model,'body'); 
			echo $form->textArea($model,'body',array('rows'=>4, 'cols'=>100)); 
		echo CHtml::closeTag('div');

		//captcha
		if(extension_loaded('gd')): 
			echo CHtml::tag('div',array('class'=>''));
 					echo CHtml::tag('br');

				echo CHtml::tag('div');
					$this->widget('CCaptcha',array('captchaAction'=>'site/captcha'));
 					echo CHtml::tag('br');
					echo $form->textField($model,'verifyCode'); 
					echo $form->labelEx($model,'verifyCode'); 

				echo CHtml::closeTag('div');
				echo CHtml::tag('div',array('class'=>'hint'),Yii::t('t', "Please enter the letters as they are shown in the image above.") . 
				CHtml::tag('br') . Yii::t('t',"Letters are not case-sensitive."));
			echo CHtml::closeTag('div');
	 	endif; 

	 	//submit
	 	echo CHtml::tag('div',array('class'=>'row-fluid submit'));
			echo CHtml::submitButton('Submit',array('class'=>'btn btn-primary','id'=>"contactSubmit")); 
		echo CHtml::closeTag('div');
		
		//end form
		$this->endWidget(); 
	echo CHtml::closeTag('div');
endif; 
?>
