<?php

Yii::import('zii.widgets.CPortlet');

class RecentComments extends CWidget
{
	public $title='Recent Comments';
	public $maxComments=10;
	 public function init() {
        parent::init();
    }

	public function run(){
		$this->render('recentComments');
	}
	public function getRecentComments()
	{
		return Comment::model()->findRecentComments($this->maxComments);
	}

	
}