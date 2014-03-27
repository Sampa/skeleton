<?php
	    $form = $this->beginWidget('TbActiveForm', array(
		   		'id'=>'login-form',
		   		'action'=>'/site/login',
		   		'enableAjaxValidation'=>true,
		    	'enableClientValidation'=>true,
		    	'clientOptions'=>array(
		    		'validateOnType'=>true,
 					'validateOnSubmit'=>true,
				  	'validateOnChange'=>true,
				 ),
		    	'htmlOptions'=>array('class'=>'form'),
		    )); 
	    		echo "<div class=\"control-group\">";
	    		echo $form->label($model,'username');
	    		echo "<br/>";
			    echo $form->textField($model, 'username', array('class'=>'search-query input-medium')); 
				$this->widget('TbPopVal', array(
					'attribute' => "username", //requiered, the attribute of the form field 
					'top' => "-40px", //optional, relative positioning from below the form element
					'left' => "5px", //optional,  relative positioning from below the form element
					'model'=>$model, //needed
					'form'=>$form, //only used if type != tooltip
					'headerText' =>Yii::t('skeleton',"Required field"), //the username displayed for the user
					'headerClass' =>"btn-danger",  // optional class to style the header of the popover
				));
				echo "</div>";
	    		echo $form->label($model,'password');
	    		echo "<br/>";
			    echo $form->passwordField($model, 'password', array('class'=>'search-query input-medium'));

			    $this->widget('TbPopVal', array(
					'attribute' => "password", //requiered, the attribute of the form field 
					'top' => "-40px", //optional, relative positioning from below the form element
					'left' => "5px", //optional,  relative positioning from below the form element
					'model'=>$model, //needed
					'form'=>$form, //only used if type != tooltip
					'headerText' =>Yii::t('skeleton',"Required field"), //the username displayed for the user
					'headerClass' =>"btn-danger",  // optional class to style the header of the popover
				));
			    echo "<br/>";
			   	echo CHtml::tag('h6',array('style'=>'float:left;'),'Remember me');
			  	echo $form->checkbox($model, 'rememberMe',array("rel"=>"tooltip","title"=>Yii::t('skeleton','Remember me')));
			   	echo "<br/><br/>";
				echo CHtml::submitButton(Yii::t('skeleton','Login'),array('class'=>'btn btn-primary')); 
			//	echo CHtml::link('Not yet a user?','',array('id'=>'registerButton','class'=>'btn btn-small'));

				$this->widget('TbPopVal', array(
					'attribute' => "summary", //requiered, the attribute of the form field 
					'top' => "2em", //optional, relative positioning from below the form element
					'left' => "-18em", //optional,  relative positioning from below the form element
					'model'=>$model, //needed
					'form'=>$form, //only used if type != tooltip
					'headerText' =>Yii::t('skeleton',"Required field"), //the username displayed for the user
					'headerClass' =>"btn-danger",  // optional class to style the header of the popover
					'position'=>'bottom',
				));		
			?>				 
		
		<?php $this->endWidget();?>
