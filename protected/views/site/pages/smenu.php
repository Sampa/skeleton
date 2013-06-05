<div class="span8"  style="min-height:480px;">
	<h3> sMenu </h3>
	<p>
		Extends CMenu with 
	</p>

	<h5>Features</h5>
	<ul>
		<li> Added a general $submenuClass to class submenu items</li>
		<li> Added $submenuWidth that controls a certain items submenu</li>
		<li> Adds "icon" property to items</li>
		<li> Possible to split a submenu in columns by specifying a  array('column') item where the submenu should be split.<br/>
			array('column','width'=>'50%') controls the width of each column.50% is default.
		</li>
		<li> Themeable </li>

	</ul>

	<h3>Examples</h3>
		<h5> Default values </h5>
		<?php
			$code ="\$this->widget('SMenu',array(
			'id'=>'sphere-orange',
			'theme'=>'sphere-orange',
			'htmlOptions'=>array(),
			'itemTemplate'=>'{menu}',
			'itemCssClass'=>'topmenu',
			'submenuClass'=>'', //added to the submenu &lt;li> items
			'items'=>array(
				array('label'=>'Home', 'url'=>array('site/index')),
				array('label'=>'Posts','url'=>array('/posts/index'),'visible'=>!Yii::app()->user->isGuest, 'items'=>array(
			            	array('label'=>'Create New Post','icon'=>'external-link', 'url'=>array('post/create')),
			            	array('column'),
							array('label'=>'Manage Posts','url'=>array('/post/admin')),
			        )),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ";
			echo CHtml::tag('div',array('class'=>'span12'));
				$this->widget('ext.sprism.sprism',array('content'=>$code));
			echo CHtml::closeTag('div');
		?>


</div>	