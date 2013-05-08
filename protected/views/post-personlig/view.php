<?php
	$this->breadcrumbs=array(
		$model->title,
	);
	$this->pageTitle=$model->title;

	echo $this->renderPartial('_view', array('data'=>$model,'editableTitle'=>true),true,false); 

		if($comment){
			if(Yii::app()->user->hasFlash('commentSubmitted')){ 				
				echo CHtml::tag('div',array('class'=>'flash-success'),Yii::app()->user->getFlash('commentSubmitted')); 				
			}
		}
	?> 
<div id="comments">
	<?php
		if($model->commentCount > 0){
			echo "<h3>";
			echo $model->commentCount >1 ? $model->commentCount . ' comments' : 'One comment';
			echo "</h3>";
		}
		$this->renderPartial('_comments',array(
			'post'=>$model,
			'comments'=>$model->comments,
		));
	?> 
</div><!-- comments -->

