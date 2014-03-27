
<?php

Yii::import('zii.widgets.CPortlet');

class TagCloud extends CPortlet
{
	public $title='Common tags';
	public $maxTags=20;

	public function init()
    {
        $this->title = Yii::t('blog','Tags');
        parent::init();
    }
    public function run()
    {
        $tags=Tag::model()->findTagWeights($this->maxTags);
        $this->render('tagCloud',array('title'=>$this->title,'tags'=>$tags));
    }
}