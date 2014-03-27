<?php $this->beginContent('/layouts/main'); ?>

	<div class="span8">
		<div id="content">
					<?php echo $content; ?>
		</div><!-- content -->
	</div>
	<div class="span4" id="sidebar">
		<h3>Kontakta mig!</h3>
        <a href="mailto:linn.oscarsson@gmail.com">Maila</a>
        <br/>
        <a href="facebook.com">Besök mig på facebook</a>
			<?php 
			//if(!Yii::app()->user->isGuest) $this->widget('UserMenu');
			?>

			<?php $this->widget('TagCloud', array(
				'maxTags'=>Yii::app()->params['tagCloudCount'],
			)); ?>

			<?php 
			/*$this->widget('RecentComments', array(
				'maxComments'=>Yii::app()->params['recentCommentCount'],
			));
			*/
			 ?>
	</div><!-- sidebar -->
<?php $this->endContent(); ?>