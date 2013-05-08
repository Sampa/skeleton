//Breadcrumbs
		echo CHtml::tag('div',array('id'=>'breadcrumbs','style'=>'margin-top:42px;'));
		/* $this->widget('TbBreadcrumbs', array(
	    	'links'=>$this->breadcrumbs,
	    ));*/
	    $this->widget('application.extensions.exbreadcrumbs.EXBreadcrumbs', array(
	    	'htmlOptions'=>array(),
			'collapsible'=> false,
    		//'collapsedWidth' => 15, //if collapsible is true this is the width in px of the collapsed item
        	'bcIcon'=>"icon-share-alt", //icon class for link-items 
        	'bcDropdownIcon'=>'icon-chevron-down', //icon class for drop-down items
			'currentClass'=>'active',
    		'homeLink'=>array(
    			'label'=>'<i class="icon-home"></i>'.Yii::t('skeleton','Home'),
    			'url'=>Yii::app()->homeUrl,
    			'htmlOptions'=>array('class'=>'home')
    		),
		    'links'=>array(
		    	//breadcrumb level
		        '' => array('controller/route1','param1'=>'value1',
		        	'htmlOptions'=>array(), // set html options for the submenu ul if you wish
		           //optional: add a submenu to the breadcrumb link
		            'menu'=>array(
                		'sub1'=>array( 
                			//clicking the label triggers:
		                	'url'=>array('controller/routeMenu1','paramM1' => 'valueM1'),
		                	//hovering label shows:
		                	'submenu'=>array(
		                		'Sub2menu1'=>array(
			                		'url'=>array('controller/routeMenu1','paramM1' => 'valueM1'),
		                		),
		                		'Sub2menu2'=>array(
			                		'url'=>array('controller/routeMenu1','paramM1' => 'valueM1'),
		                		),
		                	),		                			
                		),
		                //submenu with just a link
				        'sub2'=> array('controller/routeMenu2','paramM2' => 'valueM2'),		            		                
		            )
		        ),    
		        //text only
		        'crumb2',
		        //link only
		        'crumb3' => array('controller/route2','param2'=>'value2'),	        
		    ),
		)); 
		echo CHtml::closeTag('div');
    	
?>