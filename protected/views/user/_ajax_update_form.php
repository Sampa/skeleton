    <div id='user-update-modal' class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
   
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3>Update #<?php echo $model->id; ?></h3>
    </div>
    
    <div class="modal-body">
 
    
    
    <div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'user-update-form',
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
        'method'=>'post',
        'action'=>array("user/update"),
	'type'=>'horizontal',
	'htmlOptions'=>array(
                               'onsubmit'=>"return false;",/* Disable normal form submit */
                               'onkeypress'=>" if(event.keyCode == 13){ update(); } " /* Do ajax call when user presses enter key */
                            ),               
	
)); ?>
     	<fieldset>
		<legend>
			<p class="note">Fields with <span class="required">*</span> are required.</p>
		</legend>

	<?php echo $form->errorSummary($model,'Opps!!!', null,array('class'=>'alert alert-error span12')); ?>
        		
   <div class="control-group">		
			<div class="span4">
			
			<?php echo $form->hiddenField($model,'id',array()); ?>
			
	               				  <div class="row">
					  <?php echo $form->labelEx($model,'username'); ?>
					  <?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>128)); ?>
					  <?php echo $form->error($model,'username'); ?>
				  </div>

			  				  <div class="row">
					  <?php echo $form->labelEx($model,'password'); ?>
					  <?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128)); ?>
					  <?php echo $form->error($model,'password'); ?>
				  </div>

			  				  <div class="row">
					  <?php echo $form->labelEx($model,'email'); ?>
					  <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
					  <?php echo $form->error($model,'email'); ?>
				  </div>

			  				  <div class="row">
					  <?php echo $form->labelEx($model,'profile'); ?>
					  <?php echo $form->textArea($model,'profile',array('rows'=>6, 'cols'=>50)); ?>
					  <?php echo $form->error($model,'profile'); ?>
				  </div>

			  				  <div class="row">
					  <?php echo $form->labelEx($model,'role'); ?>
					  <?php echo $form->textField($model,'role',array('size'=>50,'maxlength'=>50)); ?>
					  <?php echo $form->error($model,'role'); ?>
				  </div>

			  
                        </div>   
  </div>

  </div><!--end modal body-->
  
  <div class="modal-footer">
	<div class="form-actions">

	                
		<?php		
		 $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			//'id'=>'sub2',
			'type'=>'primary',
                        'icon'=>'ok white', 
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
			'htmlOptions'=>array('onclick'=>'update();'),
		));
		
		?>
             
	</div> 
   </div><!--end modal footer-->	
</fieldset>

<?php $this->endWidget(); ?>

</div>


</div><!--end modal-->



