<?php
	if($data->author_id == Yii::app()->user->id){
		$canEdit = true;
	}
?>		
<div class="bootstrap-widget bootstrap-widget-table" >
	<div class="bootstrap-widget-header">
		<h3>
		<?php 
		if(isset($canEdit)){
			$url = 	Yii::app()->createUrl('post/update', array(
					'id'=>$data->id
				));
				echo CHtml::link(CHtml::encode($data->title),$url,array()); 
			}else
				echo CHtml::link(CHtml::encode($data->title), $data->url); 
		
		?>
		</h3>
		
		<!-- end buttons-->
	</div>
	<div id="yw0" class="bootstrap-widget-content" style="width:80%; padding:1em;">
		<div class="post row">
			<div class="author">
				posted by <?php echo $data->author->username . ' on ' . date('F j, Y',$data->create_time); ?>
			</div>
			<div class="content col-12 col-lg-12" id="<?=$data->id;?>">
				<div class="col-8 col-lg-8">
				<?php
				if(isset($canEdit)){
					echo Post::parseText($data->content);
				}else{
					// to parse links and bb code
					echo Post::parseText($data->content);
				}
				?>
				</div>
			</div>
			<div>
				<b>Tags:</b>
				<?php echo implode(', ', $data->tagLinks); ?>
				<br/>
				<?php echo CHtml::link('Comment', $data->url); ?> |
				<?php echo CHtml::link('Permalink', $data->url); ?> |
				Last updated on <?php echo date('F j, Y',$data->update_time); ?>
			</div>
		</div>
	</div>
</div>
