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
	<div id="disqus_thread"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'lynncomments'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments</a></noscript>
    
<!--<div id="comments">
	<?php
	/*	if($model->commentCount > 0){
			echo "<h3>";
			echo $model->commentCount >1 ? $model->commentCount . ' comments' : 'One comment';
			echo "</h3>";
		}
		$this->renderPartial('_comments',array(
			'post'=>$model,
			'comments'=>$model->comments,
		));
	*/?> 
</div>--><!-- comments -->

