<?php  $form=$this->beginWidget('TbActiveForm',array(
        'id'=>'search-post-form',
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
		'type'=>'inline',
		'htmlOptions'=>array('data-target'=>'post-grid'),
	));  ?>

<span class="updategrid" name="post"></span>
<div class="">
	<div class="input-prepend" style="margin-left:-4px;">
			<span class="add-on">
				<i class="icon-font"></i>
			</span>
			<?=$form->textField($model,'title',array('class'=>'','maxlength'=>128,'prepend'=>'<i class="icon-font"></i>','placeholder'=>"Title"));?>
	</div>
	<div class="daterange" style="margin-left:-3px;">
	<?php
		echo $form->dateRangeRow($model, 'create_time',
		array(
		'placeholder'=>'Created',
		'prepend'=>'<i class="icon-calendar"></i>',
		'options' => array(
			'format'=>'yyyy/MM/dd',
			'callback'=>'js:function(start, end){$("#Post_create_time").val(start.toString("yyyy/MM/d")  + " - " + end.toString("yyyy/MM/d") );}',
			),
		));
	?>
	</div>

	<!-- AUTHOR -->
	<div class="row-fluid">
		<?php
			$users = User::model()->findAll();
			$names = array();
			foreach ($users as $key => $value) {
				$names[] = 
				$value->username;
			}	
		?>
		<div class="input-prepend" style="margin-left:-4px;">
			<span class="add-on">
				<i class="icon-user"></i>
			</span>

			<?php	
			    $this->widget('TbTypeahead', array(
				    'model'=>$model,
				    'attribute'=>'author_id',
				    'options'=>array(
					    'source'=>$names,
					    'items'=>4,
					    'matcher'=>"js:function(item) {
					   		return ~item.toLowerCase().indexOf(this.query.toLowerCase());
					    }",
			    	),
				    'htmlOptions'=>array('placeholder'=>'Author','autocomplete'=>"off")
				));
			?>
		</div>
	</div>
	<div class="row-fluid">
		<div class="input-prepend" style="margin-left:-3px;">
		<span class="add-on">
			<i class="icon-eye-open"></i>
		</span>
		<?= $form->dropDownList($model,'status',Lookup::items('PostStatus'),array('style'=>'width:auto;')); ?>
		</div>
	</div>
	<div class="form-actions">
		<?php $this->widget('TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'search white', 'label'=>'Search')); ?>
        <?php $this->widget('TbButton', array('buttonType'=>'button', 'icon'=>'icon-remove-sign white', 'label'=>'Reset', 
        					'htmlOptions'=>array('class'=>'btnreset'))); ?>
	</div>

<?php $this->endWidget(); ?>
</div>

