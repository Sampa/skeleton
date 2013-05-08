<?php

class TagCloud extends CWidget
{
	public $title='Tags';
	public $maxTags=20;
	 public function init() {
        parent::init();
    }

	public function run(){
		$this->render('tags');
	}
	public function getTags()
	{
		return Tag::model()->findTagWeights($this->maxTags);
	}

}