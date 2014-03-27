
/* CRUD template js */
$(".admin-form form").submit(function(event){
	event.preventDefault();
	 if (this.beenSubmitted){
      	$(this).isLoading("hide");
 	     this.beenSubmitted = false;
      	return false;
    }else
      this.beenSubmitted = true;

	var id = this.id;
	$(this).isLoading({position:"overlay"});
	$.post($(this).attr('action'), $(this).serialize(),function(data){
	 	if(data !== null && data.success){
	  			$("#"+id)[0].reset();      			
				try{
					$(".admin-form").slideUp();
					$.fn.yiiGridView.update('post-grid', { });	
				 	}catch(err){}
	   			 	$.pnotify({
				    	title: 'Success',
				    	text: 'Saved your post',
				    	icon: 'icon-ok',
				    	type: 'success',
			    	});
		    }
		$(this).isLoading("hide");	  
	},'json');
});
function renderUpdateForm(id,modelClass,url)
{
	url = typeof url == 'undefined' ? "/"+modelClass+"/jsonAttributes" : url;
  	$.ajax({
  		type: 'POST',
    	url: url,
   		data:{"id":id},
		success:function(data){
			
			data = $.parseJSON(data);
			console.log(data);
			$.each(data, function(index, value) {
				var selector = "#"+modelClass+"_"+index;
				console.log(selector);
				try{
					$(".admin-form "+selector).val(value);
				}catch(err){
				}
			});
			$(".admin-form").removeClass('hide').slideDown();

        },
   error: function(data) { // if error occured
           alert(JSON.stringify(data)); 
         alert("Error occured.please try again");
    },

  dataType:'html'
  });

}

/* render view in modal */

function renderView(id,url)
{ 
url = typeof url == 'undefined' ? "/"+modelClass+"/view" : url;
 var data="id="+id;

  $.ajax({
  	type: 'POST',
 	url: url,
  	data:data,
	success:function(data){		
		$(".admin-form").slideUp('slow');
		$(".search-form").slideUp('slow');
		$(".view-content").html(data);
		$(".view-wrapper").slideDown();
		$(".view-wrapper").removeClass('hide');
   },
   error: function(data) { // if error occured
         alert("Error occured.please try again");
    },

  dataType:'html'
  });

}


//deletes a post if the dialog is confirmed
function delete_record(id,modelClass,url)
{
	url = typeof url == 'undefined' ? "/"+modelClass+"/delete" : url;

	bootbox.dialog("Are you sure you want to delete?", [
		{
		"label" : "No",
		"class" : "btn-danger",
		"callback": function() {}
		}, 
		{
		"label" : "Yes",
		"class" : "btn-success",
		"callback": function() {
			  $.ajax({
			    type: 'POST',
			    url: url,
		        data:{id:id,modelClass:modelClass},
				success:function(data){
					data = $.parseJSON(data);
					var grid = data.modelClass.toLowerCase();
	                 $.fn.yiiGridView.update(grid+'-grid', { });	                                  
			    },
			   error: function(data) { 
			         alert("Error occured.please try again");
			    },
			  dataType:'html'
			  });
		  }
		 },
		]
	);		
}


// toggle the  search form
$('body').on('click','.toggleSearch', function(){
	$(".admin-form").slideUp('slow');
	$(".view-wrapper").slideUp('slow');
    $('.search-form').slideToggle('slow');
    return false;
});


//displaying create/update form
$("body").on('click',".toggleForm",function(){
	$(".search-form").slideUp('slow');
	$(".view-wrapper").slideUp('slow');
	$(".admin-form").slideToggle('slow');

});

//hide the  view content form
$('body').on('click','.closeViewContent', function(){
	$(".admin-form").slideUp('slow');
	$(".search-form").slideUp('slow');
	$(".view-wrapper").slideUp('slow');
});

//making a search
$('body').on('submit','.search-form form',function(){
    $.fn.yiiGridView.update($(this).attr('data-target'), {
        data: $(this).serialize()
    });
    return false;
});
/* end template js*/