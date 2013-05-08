<?php
		$tag = $this->beginWidget('TbBox', array(
			'title' => 'Tags',
			'headerIcon' => 'icon-th-list',
			'htmlOptions' => array('class'=>'bootstrap-widget-table')
		));
		$items = array();
		echo CHtml::tag('div',array('style'=>'padding-left:20px;'));
		foreach($this->getTags() as $tag=>$weight)
		{
			$link=CHtml::link(CHtml::encode($tag), array('post/index','tag'=>$tag));
			echo CHtml::tag('span', array(
				'class'=>'tag',
				'style'=>"font-size:{$weight}pt",
			), $link)."\n";
			$items[] = array('label'=>CHtml::encode($tag), array('post/index','tag'=>$tag),'itemOptions'=>array('class'=>'tag','style'=>"font-size:{$weight}pt")); 
		}
		echo CHtml::closeTag('div');
		
		/*
		$this->widget('bootstrap.widgets.TbMenu', array(
		'type'=>'list',
		'items' => $items,
		));*/
			 

		$this->endWidget();
?>