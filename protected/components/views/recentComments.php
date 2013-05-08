<?php 
	$box = $this->beginWidget('TbBox', array(
		'title' => 'Recent Comments',
		'headerIcon' => 'icon-th-list',
		'htmlOptions' => array('class'=>'bootstrap-widget-table')
	));

	$items = array();
	foreach($this->getRecentComments() as $comment){
			 $items[] = array('label'=>$comment->author . " on " .$comment->post->title, 'url'=>$comment->getUrl()); 
	}

	$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'list',
	'items' => $items,
	));

	$this->endWidget();
?>
