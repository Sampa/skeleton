$(document).ready(function(){
//about
	$("body").on('click','#aboutUs',function(e){
		$.isLoading( { 'position': "overlay"});
		jQuery.get('/site/ajaxAbout', {}, function(data) {
			sModal({
				element:$("#aboutUsDiv"),
				data:data,
				settings:{transition:"slideIn"}
			});		 
		$.isLoading("hide");
		});		
	});
	

	//double trigger on two diffrent events
	$("body").on('click',"#contactSubmit",function(event){
		event.preventDefault();
		handleContactForm();

	});
	$("#contactForm").submit(function(event){
		event.preventDefault();
		handleContactForm();
	});
	/* end contact form */


	$('#Post_content').markItUpRemove(myBBcodeSettings);
 	$('#Post_content').markItUp(myBBcodeSettings);
	$(".select2-input").hide();

	/* Preserves the uploadcallback for the file upload in post form*/
	$("#Post-form").bind('fileuploadsubmit', function (e, data) {
	   	var input = $('#Post_fileFolder');
		data.formData = {example: input.val()};
	});

	/*
	clicking the filename icon with an attachment
	*/
	$('body').on('click', '.att',function(e){
			e.preventDefault();
			settings = modalDefaults();
			settings.content="image";
			var element = sModal(false,'<div class="imgcontainer"></div>',settings);
			//element.html("hahe");
			var imgUrl = $(this).attr('name'),
			cap = $(this).html();
		 	//preload the image
			window.loadImage(
		    imgUrl,
		    function (img) {
		        if(img.type === "error") {
		            console.log("Error loading image " + imageUrl);
		        } else {
		            $(".imgcontainer").html(img);
		        }
		    },
		    {
		    	maxHeight: 400
		    }
			);



		});
	//deleting an attachment uploaded to a post
	$("body").on('click','.delAttachment',function(){
	        var filePath = $(this).attr('name');
	        var obj = $(this);     
	        $.ajax({
	        type: "POST",
	        url: "/post/deleteAttachment",
	        data: {filePath:filePath},
	        cache:false,
	        dataType: 'json',
	        success:function( data ) {
	        if(data.status == 'success'){
					$.pnotify({
					    title: 'Success',
					    text: 'attachment deleted',
					    icon: 'icon-ok',
					    type: 'success',
				    });             
			obj.parent().remove();
	        }else{
					$.pnotify({
					    title: 'Error',
					    text: 'Unexpected error',
					    icon: 'icon-ok',
					    type: 'error',
				    });    
				}
	        },
	    });
	});

	//resetting search form
	$("#content").on('click',".btnreset",function(){
			$(":input","#search-post-form").each(function() {
			var type = this.type;
			var tag = this.tagName.toLowerCase(); // normalize case
			if (type == "text" || type == "password" || tag == "textarea") this.value = "";
			else if (type == "checkbox" || type == "radio") this.checked = false;
			else if (tag == "select") this.selectedIndex = "";
		  });
	});
}); /*doc ready*/

function portfolioUploadCallback(e,data){
    var filename = data.files[0]["name"];
    var publicurl = data.result[0].publicUrl;
    var path = data.result[0].location;
    $("#portfolio").append('<a href="'+publicurl+'" title="'+filename+'"><img src="'+publicurl+'" title="'+filename+'" height="75" width="75"/></a>');

}
//handles the submmitting of the contactform
function handleContactForm(){
	$.isLoading( { 'position': "overlay"});
    var formFields=$("#contact-form").serialize();
    $.ajax({
            url: '/site/contact',
            type: 'post',
            data: formFields,
            success: function (data) {
       			$.isLoading("hide");
                var data = jQuery.parseJSON(data);              
                if(data.status=="success"){
                        $.pnotify({
                            title: 'Success',
                            text: 'We have recieved your arrend',
                            icon: 'icon-ok',
                            type: 'success',
                        });
                      getModalElement().bPopup().close();
                      $("#contact-form").empty();
                }else{
                    sModal({
                        data:data.content,
                        title:'Contact',
                        buttons:["bclose"],
                    });
                }
            }
        });
}  



/****
POST  CLASS JS
****/

/**
 Upload related 
 **/
//after attachment has been uploaded
function uploadCallback(e,data){
	var filename = data.files[0]["name"];
	var publicurl = data.result[0].publicUrl;
	var path = data.result[0].location;
	$("#Post_fileFolder").val(data.result[0].fileFolder); // add the folder with the files to the form
	$("#attachments ul").append('<li><i name="'+path+'" class="icon-remove cursor delAttachment"></i> <a href="'+publicurl+'" title="'+filename+'"><img src="'+publicurl+'" title="'+filename+'" height="75" width="75"/></a></li>');
}


$('#attachments').magnificPopup({
        delegate: 'a',
        type: 'image',
        tLoading: 'Loading image #%curr%...',
        mainClass: 'mfp-img-mobile',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0,1] // Will preload 0 - before current, and 1 after the current image
        },
        image: {
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
            titleSrc: function(item) {
                return item.el.attr('title') + '<small>&copy; Linn Oscarsson</small>';
            }
        }
    });