<?php $this->beginContent('/layouts/main'); ?>
<div class="container">
	<div class="span8">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
		<div class="span3" id="sidebar">
			<?php 
			//if(!Yii::app()->user->isGuest) $this->widget('UserMenu');
			?>

			<?php $this->widget('TagCloud', array(
				'maxTags'=>Yii::app()->params['tagCloudCount'],
			)); ?>

			<?php $this->widget('RecentComments', array(
				'maxComments'=>Yii::app()->params['recentCommentCount'],
			)); ?>
		</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>