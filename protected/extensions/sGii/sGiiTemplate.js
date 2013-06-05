
/* CRUD template js */
/*
	This is triggered when the user tries to delete one or more records
	if it returns true the deletion will continue,else it will be aborted
*/
function confirmDelete(){
	var r=confirm("Are you sure?");
	if (r==true){
 		return true;
	}
	return false;
}

$(".admin-form form").submit(function(event){
	event.preventDefault();
	 if (this.beenSubmitted){
      	$(this).isLoading("hide");
 	     this.beenSubmitted = false;
      	return false;
    }else
      this.beenSubmitted = true;

	var id = this.id;
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
	url = typeof url == 'undefined' ? "/"+modelClass.toLowerCase()+"/jsonAttributes" : url;
  	$.post(url,{"id":id},function(data){
			$.each(data, function(index, value) {
				var selector = "#"+modelClass+"_"+index;
				try{
					$(".admin-form "+selector).val(value);
				}catch(err){}
			});
			$(".admin-form").slideDown();
        },'json'
  	);

}

/* render view in modal */

function renderView(id,url)
{ 
url = typeof url=="undefined" ? "/"+modelClass+"/view" : url;
 jQuery.get(url, {id:id}, function(data, textStatus, xhr) {
   	$(".admin-form").slideUp('slow');
	$(".search-form").slideUp('slow');
	$(".view-content").html(data);
	$(".view-wrapper").slideDown();
 });
}


//deletes a post if the dialog is confirmed
function delete_record(id,modelClass,url)
{
	url = typeof url == 'undefined' ? "/"+modelClass+"/delete" : url;
	if(!confirmDelete()){
		return;
	}
	
 	$.post(url,{id:id,modelClass:modelClass}, function(data, textStatus, xhr) {			    
			var grid = data.modelClass.toLowerCase();
		    $.fn.yiiGridView.update(grid+'-grid', { });	                                  
	},'json');
}
// making a grid selectable so you can do multi delete
function makeSelectable(id){
			$(".deleteSelected").fadeOut();
			$( "#" +id+ " table tbody" ).selectable({
				cancel: "a, button",
				stop: function() {
					var result = $(".select-result" ).empty();
					var data ="";
					$("#"+id+" table tbody tr td").each(function(){
						var dataColor = $(this).attr('data-color');					
						if(typeof dataColor =="string")
							$(this).css('background-color',dataColor);
					});
					$( ".ui-selected", this ).each(function() {
						var index = $( "#"+id+" table tbody tr" ).index( this );
						var tr = $( "#"+id+" table tbody tr:eq("+index+")");
						var td = tr.children("td");
						td.attr('data-color', td.css('background-color'));
						td.css('background-color','#DA4F49');
						data = data + tr.children("td").children("a").attr('data-pk')+ ",";
					});
					result.append( data );
					result.hide();
					if(data !="")
						$(".deleteSelected").fadeIn();
					else
						$(".deleteSelected").fadeOut();		
				}			
			});
		}


//delete the selected rows
$("body").on('click',".deleteSelected",function(){
	var grid = $(".grid-view").attr('id');
	if(!confirmDelete()){
		return;
	}
	jQuery.post('/post/deleteMany', {models: $(".select-result").html()}, function(data, textStatus, xhr) {
		$.fn.yiiGridView.update(grid, {	});	
	});
});
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