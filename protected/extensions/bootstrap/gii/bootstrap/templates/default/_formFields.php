<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>

<?php
foreach($this->tableSchema->columns as $column)
{
	if($column->autoIncrement)
		continue;
?>
  	<div class="control-group">
		<?php echo "<?php echo ".$this->generateActiveRow($this->modelClass,$column)."; ?>\n"; ?>
	</div>
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
