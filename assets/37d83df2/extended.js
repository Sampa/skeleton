/*
 the bpopmodal related functions
*/
// set default settings, use this with selector.bPopup(modalDefaults());

  
  function sModal(options={}){        

        var sSettings = sModalSettings();
        getDefaultElement().html("");
        //if no custom settings sent along, use defaults
        /*bugfix to clear any changes*/
        var bSettings =  modalDefaults(); 
       if(options.settings){
            $.each(options.settings,function(key,value){
                bSettings[key] = value;
            });
        }
        //if there is no special element to popup use the default div
        if(typeof options.element =="undefined"){
            element = getDefaultElement();
        }else{
            element = options.element;        
        }
        //if there is no data sent,back up and use the divs current content 
        if(!options.data){
           options.data = element.children('.smodalContent').html();             
            if(typeof options.data == "undefined"){
                options.data = element.html();
            }
        }
        // insert design template
        if(!options.templateHtml){
            options.templateHtml = $(".sTemplate").html();        
        }
        element.html(options.templateHtml)

        //title;
        if(options.title){
            element.children('.draghandle').children('span').html(options.title);
        }
        //insert correct data
        element.children(".smodalContent").html(options.data);              
       
       
        if(!element.hasClass('bpopup')){
            element.addClass('bpopup');
        }                
        //show modal                
        element.bPopup(bSettings);
        //ignore
        if($.isArray(options.ignore)){
            $(options.ignore).each(function(index,value){
                element.children(".bButtons").children("."+value).hide();                
            });
        }
        //buttons
        if($.isArray(options.buttons)){
            element.children(".bButtons").children().hide();                
            $(options.buttons).each(function(index,value){
                element.children(".bButtons").children("."+value).show();                
            });
        }
        if(typeof options.draggable == "undefined"){
            options.draggable = sSettings.draggable;            
        }
        if(options.draggable){
            if(typeof options.draggableSettings =="undefined"){
                options.draggableSettings ={};
            }
            element.draggable(options.draggableSettings);
        }

        if(sSettings.resizeable){
        if(typeof options.resizeSettings == "undefined"){
                options.resizeSettings = {
                    start:function(){
                        element.children(".smodalContent").show();
                    },
                };
            }
            resizeModals(element,options.resizeSettings);
        }
        //return element with data
        $(".bunfold").hide();            
        return element.children(".smodalContent");
}



  

function getDefaultElement(){
            var sSettings = sModalSettings();
            return $("#bpopup");//$("body").children($(sSettings.defaultElement));
        }
 

 /* JQUERY UI RELATED resizing AND draggable*/
   $(window).resize(function(e) {
        if (!$(e.target).hasClass('ui-resizable')) {
                $(".bpopup").each(function(i,e){
                    //get current viewport sizes and leave some margin
                    var viewportWidth = $(window).width()-50,
                    viewportHeight = $(window).height()-80,
                    width = $(this).width(),
                    height = $(this).height();
                    //animate it to correct size if they are to big
                    if(width+300 > viewportWidth){
                        $(this).animate({
                            width:viewportWidth,                              
                            left:0,
                        }, 600, function() {
                        // Animation complete.
                        });
                    }
                    if(height+200 > viewportHeight){
                        $(this).animate({
                            height:viewportHeight,        
                        }, 600, function() {
                        // Animation complete.
                        });
                    }
                });
           } 
        });

    function resizeModals(element=false,settings=false){
            var viewportWidth = $(window).width()-200,
            viewportHeight = $(window).height()-150,
            sSettings = sModalSettings();
            if(!settings){
            var settings= {         
                minHeight: sSettings.minimizeHeight,
                minWidth:sSettings.minimizeWidth, 
                maxWidth:viewportWidth,
                maxHeight:viewportHeight,
                alsoResize: ".smodalContent "
                };
            }
            /* rebind bugfix */
            if(element){
                 try{
                   element.resizable("destroy");
                }catch(err){}

                element.resizable(settings);

            }
    }
   
     //takes a modal element and resizes it to
    function maximizeModal(element,minusWidth,minusHeight){
        element.show();
        var currentHeight = element.height(),
            currentWidth = element.width(),
            viewportWidth = $(window).width()-minusWidth,
            viewportHeight = $(window).height()-minusHeight;
        if(currentWidth < viewportWidth){
            element.animate({
                width:viewportWidth,  
                height:viewportHeight,                      
                left:0,      
            }, 600, function() {
            // Animation complete.
            });
            element.children(".smodalContent").animate({
                width:viewportWidth,  
                height:viewportHeight,                      
                left:0,      
            }, 600, function() {
            // Animation complete.
            });
        }       
         //swap fold button
        element.children('.bButtons').children('.bunfold').hide();
        element.children('.bButtons').children('.bfold').show();
        //make sure content is shown .
        element.children(".smodalContent").slideDown();
    }   

    function minimizeModal(element){
        element.show();
        var settings = sModalSettings();
        element.animate({
                height:settings.minimizeHeight,     
                width:settings.minimizeWidth,                  
                left:0,      
            }, 600, function() {
                    var width = element.width();
                    element.children(".smodalContent").animate({
                    height:settings.minimizeHeight,     
                    width:width,
                    left:0,      
                }, 600, function() {
                // Animation complete.
                });


            });

                         
        //swap fold button
        element.children('.bButtons').children('.bunfold').hide();
        element.children('.bButtons').children('.bfold').show();
        //make sure content is shown .
        element.children(".smodalContent").slideDown();

    }
    
    /*
        Accepts: a jqueryobject that is either inside a .bButtons parent element or in a sTaskbar ul 
        returns : the modal element
    */ 
    function getModalFromButton(button){
        var modalOpen = button.parent().hasClass('bButtons');
        var element = (modalOpen) ? button.closest(".bpopup") : getModalFromTaskbar(button);
        return element;
     }

     /*
        See getModalFromButton();
     */
    function getModalFromTaskbar(button){
       var element = button.closest('.sTaskbarItem');
        var id = element.attr('id').replace('taskbar','');  
        element.remove();  
        return $("#"+id);
    }
    /*
        Accepts a modal element and puts it in folded mode
    */
    function foldModal(element){
        //make sure element is shown
      
        element.show();
         //make sure the content is hidden
        element.children(".smodalContent").slideUp();        
        //get and backup current height
        var currentHeight = element.height();        
        //The animation
        element.animate({
                height:00,        
            }, 600, function() {
                //animation complete
        });        
        return currentHeight;
    }
    /*
        Accepts: a modal element and the height to restore to
        Puts the modal in unfolded mode
    */ 
    function unfoldModal(element,height){
        //make sure modal is seen
        element.show();
        //make sure content is shown
        element.children(".smodalContent").slideDown();
        //The animation    
        element.animate({
                height:height,        
            }, 600, function() {
            // Animation complete.
        });
    }
function handleImage(element,tag){
    if(tag.prop("tagName")=="IMG"){
                var imgUrl = tag.attr('src');
            }else{
                var imgUrl = tag.attr('href');
            }
            cap = tag.html();
            //preload the image
            window.loadImage(
            imgUrl,
            function (img) {
                element = sModal({'element':$("#bpopup"),'settings':settings});
                element.siblings('.bButtons').children(':not(".'+settings.closeClass+'")').hide();
                element.html(img);
                if(img.type === "error") {
                    console.log("Error loading image " + imageUrl);
                } else {
                    return;
                }
            },
            {
                maxHeight: 400
            }
            );
}

function resizeTaskbar(width,height=false){
        if(!height){
            height = $("#sTaskbarWrapper").height();
        }
        $("#sTaskbarStart ul").fadeOut();
        $("#sTaskbarWrapper").animate({
            width:width,
            height:height,
        },600,function(){
          
        });
}
function bindButtons(){
     $("body").on('click','.bpin',function(){
        var modalElement = $(this).closest(".bpopup"), 
            id = modalElement.attr('id');
            modalElement.hide();
        //if not already in the taskbar add it there
            if(typeof $("#taskbar"+id).html() == "undefined"){
                var title = modalElement.children('.draghandle').html(),
                template= $(".sTaskbarTemplate").clone();
                template.attr('class','sTaskbarItem');
                template.attr('id',"taskbar"+id);
                template.children('a').attr('href',"#taskbar"+id).prepend(title);
                $("#sTaskbar").append(template);
            }

    });

   
/*maximize  */
    $("body").on('click','.bmax',function(){
        var element = getModalFromButton($(this));
       /*modal element, int to subtract from the viewport with, int to substract from the viewport height */ 
        maximizeModal(element,50,50);
        element.css('top','0px;');                           
    });

/*minimize*/
    $("body").on('click','.bmin',function(){
        var element = getModalFromButton($(this));
        minimizeModal(element);
    });

/*fold*/
    $("body").on('click','.bfold',function(){
         var element = getModalFromButton($(this));
         //folds modal and saves the current modal height @ .unfold
        $(this).siblings('.bunfold').attr('rel',foldModal(element));       
        $(this).hide();
        $(this).siblings('.bunfold').show();
    });

/*unfold*/
    $("body").on('click','.bunfold',function(){
       var element = getModalFromButton($(this));
       var height = $(this).attr('rel');
        unfoldModal(element,height);
        $(this).hide();
        $(this).siblings('.bfold').show();

    });
/* close */
    $("body").on('click','.bclose',function(){
        var modal = getModalFromButton($(this))    
        modal.bPopup().close();        
    });
/* sTaskbar */

    //show modal again by clicking the title link     
    $("body").on('click','.sTaskbarItem a', function(){
        var taskbarId = $(this).attr('href');
        var modalId = taskbarId.replace('taskbar','');
        $(modalId).show();
        $(this).closest('#sTaskbar li').remove();
    });
    //shows the submenu of a taskbar item
    $("body").on('click','.subToggle', function(){
        $(this).closest('li').children('ul').fadeToggle();
    });

    //clear the sTaskbar of items "close all" button
    $("body").on('click','#sTaskbarCloseAll',function(){
        $(".sTaskbarItem").each(function(){
            var taskbarId = $(this).children("a").attr("href");
            var modalId = taskbarId.replace("taskbar","");
            $(modalId).bPopup().close();
            $(this).remove();
        });
        $("#sTaskbarStart ul").fadeOut();
    });
 


    $("body").on('click','#sTaskbarFold', function(){
        resizeTaskbar(30);     
    });
     $("body").on('click','#sTaskbarUnfold', function(){
        resizeTaskbar("100%");
    });
      //if trying to open a modal
    $("body").on('click',".bOpen",function(event){
        event.preventDefault();
        
        var title = $(this).next(".bTitle").html(); /* get title element */
        element = $("#"+$(this).attr('data-target')),/* get the div to popup */  
        settings = modalDefaults(), /* get bPopup settings */       
        type = $(this).attr('rel'); 
        
        if(type=="image"){     
            settings.content = 'image';
            element = handleImage(element,$(this));
        }else{
            var sOptions ={ /* set special options for sModal */
                'element':element,
                'settings':settings,
                'title':title,
            }, 
           contentElement = sModal(sOptions);
        }
    });

}
$(document).ready(function(){
    //hide divs and titles for modals
    $(".bOpen").each(function(index){
        var id = $("#"+$(this).attr('data-target'));
        $(id).hide();
        $(this).next(".bTitle").hide();
    });
bindButtons();
});//end document ready
