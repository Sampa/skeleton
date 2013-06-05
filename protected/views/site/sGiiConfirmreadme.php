Customize the deletion with bootbox instead<br/>
These snippets are also commented out in the sGiiTemplate.js file
<ol>
	<li><h5>open sGiiTemplate.js</h5></li>
	<li><h5>Change the delete_record() function  </h5>
		<div>
		Result:
		<?php		
$code = '
function delete_record(id,modelClass,url)
{
	url = typeof url == "undefined" ? "/"+modelClass+"/delete" : url;
	bootbox.dialog("Are you sure you want to delete?",
	 [
		{
			"label" : "No",
			"class" : "btn-danger",
			"callback": function() {}
		}, 
		{
			"label" : "Yes",
			"class" : "btn-success",
			"callback": function() {
				  $.post(url,{id:id,modelClass:modelClass}, function(data, textStatus, xhr) {			    
					var grid = data.modelClass.toLowerCase();
		            $.fn.yiiGridView.update(grid+"-grid", { });	                                  
				  },"json");
			  }
		},
	 ]
	);		
}';			
		$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'javascript','lines'=>array('start'=>1,'end'=>20)));
		?>
  		</div>
	</li>

	<li><h5>Change the trigger for multiple deletion </h5>
		<div>
		Result:
		<?php		
$code = '
$("body").on("click",".deleteSelected",function(){
	var grid = $(".grid-view").attr("id");{
	url = typeof url == "undefined" ? "/"+modelClass+"/delete" : url;
	bootbox.dialog("Are you sure you want to delete?",
	 [
		{
			"label" : "No",
			"class" : "btn-danger",
			"callback": function() {}
		}, 
		{
			"label" : "Yes",
			"class" : "btn-success",
			"callback": function() {
					jQuery.post("/post/deleteMany", {models: $(".select-result").html()}, function(data, textStatus, xhr) {
						$.fn.yiiGridView.update(grid, {	});	
					});
			  }
		},
	 ]
	);		
}

';			
		$this->widget('ext.sprism.sprism',array('content'=>$code,'lang'=>'javascript','lines'=>array('start'=>1,'end'=>20)));
		?>
  		</div>
	</li>

</ol>
	
