
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
	echo CHtml::tag('div',array('class'=>'form well row','style'=>'margin-top:5px;'));
	?>
	<div class="pull-right col-7 col-lg-7">
		<h4>+46713511351</h4>";
	<?= CHtml::link('<i class="icon-facebook-sign" style="font-size:250%;"></i>','https://www.facebook.com/linn.oscarsson.7',array('title="Visit me on facebook"'));?>
  		<a href="mailto:linn.oscarsson@gmail.com" title="linn.oscarsson@gmail.com"><i class="icon-envelope" style="font-size:250%;"></i></a>
		<div>
			<p>Lorum ipsum Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
			Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in 
			voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim 
			id est laborum.
			</p>
			<p>
				Lorum ipsum Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
			Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in 
			voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim 
			id est laborum.
			</p>

			<p>
				Lorum ipsum Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
			Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in 
			voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim 
			id est laborum.
			</p>
		</div>

	</div>
	<div class="col-5 col-lg5">
	<?php
		$form = $this->beginWidget('TbActiveForm', array(
			   		'id'=>'contact-form',
			   		'enableAjaxValidation'=>true,
			    	'enableClientValidation'=>true,
			    	'clientOptions'=>array(
			    		'validateOnType'=>true,
			    		'validateOnChange'=>true,
						'validateOnSubmit'=>true,
			    	),
			    	'htmlOptions'=>array('class'=>'form'),
			    )); 
		
		//error summary
		echo $form->errorSummary($model); 

		//name
		echo CHtml::tag('div',array('class'=>''));
			echo $form->labelEx($model,'name'); 
			echo "<br/>";
			echo $form->textField($model,'name'); 
			echo $form->error($model,'name');
		echo CHtml::closeTag('div');
	
		//email
		echo CHtml::tag('div',array('class'=>''));
			echo $form->labelEx($model,'email'); 
			echo "<br/>";
			echo $form->textField($model,'email');
			echo $form->error($model,'email');
		echo CHtml::closeTag('div');

		//subject
		echo CHtml::tag('div',array('class'=>''));
			echo $form->labelEx($model,'subject');
			echo "<br/>";
			echo $form->textField($model,'subject',array());
			echo $form->error($model,'subject');
		echo CHtml::closeTag('div');

		//body
		echo CHtml::tag('div',array('class'=>''));
			echo $form->labelEx($model,'body');
			echo "<br/>"; 
			echo $form->textArea($model,'body',array('class'=>'', 'rows'=>10,'style'=>'width:100%;'));
			echo $form->error($model,'body'); 
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
		echo "</div>"; // column
	echo CHtml::closeTag('div');
endif; 
?>
<script>
$(document).ready(function(){
	$("#ContactForm_body").autoResize();
});
</script>