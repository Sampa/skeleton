Customize the javascript to use, for example with sModal:

<ol>
	<li><h5>open sGiiTemplate.js</h5></li>
	<li><h5>Change the ajax successcallback in renderView() </h5>
		<div>
		Result:
		<?php		
$code = 'function renderView(id,url)
{ 
url = typeof url == "undefined" ? "/"+modelClass+"/view" : url;
 var data="id="+id;

  $.ajax({
  	type: "POST",
 	url: url,
  	data:data,
	success:function(data){		
		sModal({
			element:$(".view-wrapper"),	
			data:data,		
			buttons:["bmax","bclose","bmin"],
  		});
   },
   error: function(data) { // if error occured
         alert("Error occured.please try again");
    },

  dataType:"html"
  });

}';			
		$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'javascript','lines'=>array('start'=>1,'end'=>20)));
		?>
  		</div>
	</li>

	<li><h5>Modify successfunction in renderUpdateForm </h5>
		<div>
		Remove $(".admin-form").slideDown();<bro>
		And put in your modal code 
		<?php		
$code = 'function renderUpdateForm(id,modelClass,url)
{
	url = typeof url == "undefined" ? "/"+modelClass.toLowerCase()+"/jsonAttributes" : url;
  	$.ajax({
  		type: "POST",
    	url: url,
   		data:{"id":id},
		success:function(data){
			sModal({
			element:$(".admin-form"),	
			buttons:["bmax","bclose","bmin"],
  			});
			data = $.parseJSON(data);

			$.each(data, function(index, value) {
				var selector = "#"+modelClass+"_"+index;
				try{
					$(".admin-form "+selector).val(value);
				}catch(err){
				}
			});
			
			
        },
   error: function(data) { // if error occured
           alert(JSON.stringify(data)); 
         alert("Error occured.please try again");
    },

  dataType:"html"
  });
}';			
		$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'javascript','lines'=>array('start'=>1,'end'=>20)));
		?>
		</div>
	</li>
	<li><h5>Modify .toggleForm trigger</h5></li>
		<div>
		<?php
$code ="$('body').on('click','.toggleForm',function(){
	sModal({
		element:$('.admin-form'),
	});
});";
			$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'javascript','lines'=>array('start'=>1,'end'=>5)));
		?>
		</div>
	</li>
	<li><h5>in $(".admin-form form").submit(function(event){ fix success callback</h5>
		<div>
		<?php
$code ="success:function(data){
  			var data = jQuery.parseJSON(data);
			if(data !== null && data.success){
      			$('#'+id)[0].reset();      			
				try{
					$('.admin-form').bPopup().close();
					$.fn.yiiGridView.update('post-grid', { });	                                  
   			 	}catch(err){}
	   			 	
		    }";
		$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'javascript','lines'=>array('start'=>1,'end'=>5)));
		?>
		</div>
	</li>
	<li><h5></h5>
		<div>
		<?php
$code ="";
		$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'javascript','lines'=>array('start'=>1,'end'=>5)));
		?>
		</div>
	</li>
</ol>
	
