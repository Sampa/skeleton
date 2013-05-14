<?php

class Sprism extends CWidget
{
	public $content;
	public $lines="";
	public $htmlOptions = array(	);
	public $lang="php";
	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		$this->registerClientScript();
	
	}


	/**linear-gradient(to bottom, #EE5F5B, #BD362F)
	 * Run this widget.
	 */
	public function run()
	{
	 
		if(!is_array($this->lines)){
			$lineNumbers = $this->lines;
		}else{
			$lineNumbers ="";
			for($i = $this->lines['start'];$i<=$this->lines['end']+2;$i++){
				if(isset($this->lines['each']) && $this->lines['each'] ){
					$lineNumbers .=$i.", ";
				}else{
					if($i % 2 !=0){
						$lineNumbers .=$i.", ";
					}
				}
			}
		}		
?>
	<pre style="width:95%; height:95%;" class="language-<?=$this->lang;?>" data-line="<?=$lineNumbers;?>"><code class="language-<?=$this->lang;?>"><?=$this->content;?></code></pre>
<?php
	}
	public function registerClientScript()
	{			
		try{
			$assets = dirname(__FILE__).'/assets';
			$baseUrl = Yii::app()->assetManager->publish($assets);
			$cs=Yii::app()->getClientScript();		
			$cs->registerScriptFile($baseUrl.'/prism.js', CClientScript::POS_END);		
			$cs->registerCssFile($baseUrl.'/prism.css');							
		}catch(CException $e){
			throw new CException('failed to publish/register assets : '.$e->getMessage());
		}
	}	
	
}
