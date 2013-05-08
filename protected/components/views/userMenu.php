<?php 
	$box = $this->beginWidget('TbBox', array(
		'title' => CHtml::encode(Yii::app()->user->name),
		'headerIcon' => 'icon-th-list',
		'htmlOptions' => array('class'=>'bootstrap-widget-table')
	));
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'list',
	'items' => array(
			array('label'=>'Create New Post', 'url'=>'/post/create'),
			array('label'=>'Manage Posts', 'url'=>'/post/admin'),
			array('label'=>'Approve Comments'  . ' (' . Comment::model()->pendingCommentCount . ')', 'url'=>'/comment/index'),
			array('label'=>'Logout', 'url'=>'/site/logout'),
		),
	));

	$this->endWidget();
?>
