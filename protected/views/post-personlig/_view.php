<?php
	if($data->author_id == Yii::app()->user->id){
		$canEdit = true;
	}
	if(!Yii::app()->user->isGuest){
		$canCommentPost = true;
	}
?>		
<div class="bootstrap-widget bootstrap-widget-table" >
	<div class="bootstrap-widget-header">
		<h3>
		<?php 
			if(isset($canEdit) && isset($editableTitle)){
				$this->widget('TbEditableField', array(
				'type' => 'text',
				'model' => $data,
				'attribute' => 'title',
				'url' => $this->createUrl('post/updateAttribute'), 
				'placement' => 'right',
				'enabled' => true				
			));
			}else
				echo CHtml::link(CHtml::encode($data->title), $data->url); 
		?>
		</h3>
		<!-- buttons -->
		<?php if(isset($canCommentPost)):?>
			<div class="bootstrap-toolbar pull-right">
				<button  name="<?=$data->id;?>" class="btn btn-primary btn-small leaveComment">
						<i class="icon-comment icon-white"></i>
				</button>
			</div>
		<?php endif;?>
		<!-- end buttons-->
	</div>
	<div id="yw0" class="bootstrap-widget-content" style="padding:1em;">
		<div class="post">
			<div class="author">
				posted by <?php echo $data->author->username . ' on ' . date('F j, Y',$data->create_time); ?>
			</div>
			<div class="content span7" id="<?=$data->id;?>">
				<?php
				if(isset($canEdit)){
					$this->widget('TbEditableField', array(
						'type' => 'textarea',
						'model' => $data,
						'attribute' => 'content',
						'url' => $this->createUrl('post/updateAttribute'), //url for submit data
						'placement' => 'right',
						'enabled' => true				
					));
				}else{
					// to parse links and bb code
					echo Post::parseText($data->content);
				}
				?>
			</div>
			<div>
				<b>Tags:</b>
				<?php echo implode(', ', $data->tagLinks); ?>
				<br/>
				<?php echo CHtml::link('Permalink', $data->url); ?> |
				<?php echo CHtml::link("Comments ({$data->commentCount})",$data->url.'#comments'); ?> |
				Last updated on <?php echo date('F j, Y',$data->update_time); ?>
			</div>
		</div>
	</div>
</div>
