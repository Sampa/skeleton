<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<div class="form">
<?php echo "<?php \$form=\$this->beginWidget('TbActiveForm',array(
	'id'=>'".$this->class2id($this->modelClass)."-form',
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
)); ?>\n"; 

echo "<?php echo \$form->errorSummary(\$model); ?>\n"; 

foreach($this->tableSchema->columns as $column)
{
	if($column->autoIncrement)
		continue;
?>
		<?php echo "<?php echo ".$this->generateActiveRow($this->modelClass,$column)."; ?>\n"; ?>
<?php
}
?>
	<div class="form-actions">
	<!-- content of this element is displayed in the submitbutton while form is beeing submitted-->
	<span class="hide whileLoad"><i class="icon-repeat"></i></span>
		<?php echo "<?php \$this->widget('TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>\$model->isNewRecord ? 'Create' : 'Save',
		)); ?>\n"; ?>
	</div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>
</div>