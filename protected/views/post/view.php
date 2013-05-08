<?php
$this->breadcrumbs=array(
	'Posts'=>array('index'),
	$model->title,
);
?>
<h1>View Post <?php echo $model->id; ?></h1>

<?php $this->widget('editable.EditableDetailView',array(
	'data'=>$model,
	'url' => $this->createUrl('/Post/updateAttribute'), //common submit url for all fields
    'params' => array('YII_CSRF_TOKEN' => Yii::app()->request->csrfToken), //params for all fields
	'attributes'=>array(
array(
	   	 'name' => 'id',
		    'editable' => array(
			    'type' => 'text',
			    'inputclass' => 'input-large',			    			    
		    )
	    ),
array(
	   	 'name' => 'title',
		    'editable' => array(
			    'type' => 'text',
			    'inputclass' => 'input-large',			    			    
		    )
	    ),
array(
	   	 'name' => 'content',
		    'editable' => array(
			    'type' => 'text',
			    'inputclass' => 'input-large',			    			    
		    )
	    ),
array(
	   	 'name' => 'tags',
		    'editable' => array(
			    'type' => 'text',
			    'inputclass' => 'input-large',			    			    
		    )
	    ),
array(
	   	 'name' => 'status',
		    'editable' => array(
			    'type' => 'text',
			    'inputclass' => 'input-large',			    			    
		    )
	    ),
array(
	   	 'name' => 'create_time',
		    'editable' => array(
			    'type' => 'text',
			    'inputclass' => 'input-large',			    			    
		    )
	    ),
array(
	   	 'name' => 'update_time',
		    'editable' => array(
			    'type' => 'text',
			    'inputclass' => 'input-large',			    			    
		    )
	    ),
array(
	   	 'name' => 'author_id',
		    'editable' => array(
			    'type' => 'text',
			    'inputclass' => 'input-large',			    			    
		    )
	    ),
array(
	   	 'name' => 'fileFolder',
		    'editable' => array(
			    'type' => 'text',
			    'inputclass' => 'input-large',			    			    
		    )
	    ),
	),
)); ?>
