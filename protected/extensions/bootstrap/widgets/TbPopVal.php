<?php

class TbPopVal extends CWidget
{
	public $form = false;
	public $model;
	public $attribute;
	public $position = "right";
	public $top = "0px";
	public $left = "0px";
	public $headerText ="Title";
	public $headerClass ="btn-primary"; 
	public $noErrorHeaderClass ="btn-success";
	public $errorHeaderClass ="red";
	public $content="Content";
	public $type = "val";
	public $width ="300px";
	public $height;
	public $element;

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		isset($this->width) ?	$this->width = "width:".$this->width.";" : $this->width = null;
		isset($this->height) ? $this->height = "height".$this->height.";" : $this->height = null;
		isset($this->top) ?	$this->top = "top:".$this->top.";" : $this->top = null;
		isset($this->left) ?	$this->left = "left:".$this->left.";" : $this->left = null;
		$this->element = $this->type."_".get_class($this->model)."_".$this->attribute;
		// validation style style

		
		$cs = Yii::app()->getClientScript();
		$baseUrl = dirname(__FILE__).'/assets/';

		$cs->registerScriptFile($baseUrl. 'js/popval.js', CClientScript::POS_END);
		$cs->registerCssFile($baseUrl. 'css/popval.css');

		if($this->form &&  $this->type != "tooltip"){
			if($this->attribute=="summary"){

			}
			$this->content = $this->form->error($this->model,$this->attribute,array('afterValidateAttribute' => 'js:function(form, attribute, data, hasError)
							    { 
							    	if(hasError){							    		
							    		$("label[for=\""+attribute.inputID+"\"]").removeClass("green");
							    		
							    		$("label[for=\""+attribute.inputID+"\"]").addClass("red");
							    		
							    		$("#pop_val_"+attribute.inputID).show();
							    	}else{

							    		$("#"+attribute.inputID).attr("style","border:1px solid #5BB75B;");
							    		
							    		$("label[for=\""+attribute.inputID+"\"]").removeClass("red");
							    		
							    		$("label[for=\""+attribute.inputID+"\"]").addClass("green");  		
							    				   	
					   				   	
					   				   	$("#pop_val_"+attribute.inputID).hide();
								    	
							    	}

							    }'));
		}
	}


	/**linear-gradient(to bottom, #EE5F5B, #BD362F)
	 * Run this widget.
	 */
	public function run()
	{
	?>
		<div style="position: relative; display:inline; <?= $this->top . $this->left; ?>">
			<div id="pop_<?=$this->element;?>"  class="popover fade <?=$this->position;?> in" style="<?= $this->width . $this->height;?> display:none;">
				<div class="arrow"></div>
					<div class="popover-inner panel-danger">
						<h3 class="popover-title <?=$this->headerClass;?>" style="background-color:#BD362F;"><?=$this->headerText;?></h3>
						<div class="popover-content">
							<p>
								<?=$this->content;?>
							</p>
					</div>
					</div>
			</div>
		</div>
<?php
	}

	
}
