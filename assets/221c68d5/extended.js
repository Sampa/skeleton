/*
 the bpopmodal related functions
*/
// set default settings, use this with selector.bPopup(modalDefaults());

 

 /* JQUERY UI RELATED resizing AND draggable*/
   $(window).resize(function(e) {
        if (!$(e.target).hasClass('ui-resizable')) {
                $(".bpopup").each(function(i,e){
                    //get current viewport sizes and leave some margin
                    var viewportWidth = $(window).width()-40;
                    var viewportHeight = $(window).height()-150;
                    //get current elements size
                    var width = $(this).width();
                    var height = $(this).height();
                    //animate it to correct size if they are to big
                    if(width+300 > viewportWidth){
                        $(this).animate({
                            width:viewportWidth,  
                            top:0,
                            left:20,
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
            var viewportWidth = $(window).width()-200;
            var viewportHeight = $(window).height()-150;
            /*var sSettings ={
            minimizeWidth:150,//".$this->minimizeWidth.",
            minimizeHeight:200,//".$this->minimizeHeight.",
        }*/ var sSettings = sModalSettings();
            if(!settings){
            var settings= {         
                minHeight: sSettings.minimizeHeight,
                minWidth:sSettings.minimizeWidth, 
                maxWidth:viewportWidth,
                maxHeight:viewportHeight,
                alsoResize: ".smodalContent"
                };
            }
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
               //top:0,
                //left:20,      
            }, 600, function() {
            // Animation complete.
            });
        }
        if(currentHeight < viewportHeight){
            element.animate({
                height:viewportHeight,        
            }, 600, function() {
            // Animation complete.
            });
            element.recenter();
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
            width:settings.minimizeWidth,  
                //top:0,
                //left:20,      
            }, 600, function() {
            // Animation complete.
            });

            element.animate({
                height:settings.minimizeHeight,        
            }, 600, function() {
            // Animation complete.
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

   
    /*
 Maximize button
      animates to a size thrue maximizeModal()
    */
    $("body").on('click','.bmax',function(){
        var element = getModalFromButton($(this));
       /*modal element, int to subtract from the viewport with, int to substract from the viewport height */ 
        maximizeModal(element,40,150);                           
    });

    /*
Minimize button , sets modal size to your configurated min-size and min-width*/
    $("body").on('click','.bmin',function(){
        var element = getModalFromButton($(this));
        minimizeModal(element);
    });

    /*
Fold Button ,folds the size of the modal content*/
    $("body").on('click','.bfold',function(){
         var element = getModalFromButton($(this));
         //folds modal and saves the current modal height @ .unfold
        $(this).siblings('.bunfold').attr('rel',foldModal(element));       
        $(this).hide();
        $(this).siblings('.bunfold').show();
    });

    /*
Unfold Button , returns modal content size*/
    $("body").on('click','.bunfold',function(){
       var element = getModalFromButton($(this));
       var height = $(this).attr('rel');
        unfoldModal(element,height);
        $(this).hide();
        $(this).siblings('.bfold').show();
    });
    /*
    closebutton li item from taskbar and closes the modal  
*/   
     $("body").on('click','.bclose',function(){
        var modal = getModalFromButton($(this))    
        modal.bPopup().close();        
     });
/*
    sTaskbar 
*/

    /*
show modal again by clicking the title link
    */     
    $("body").on('click','.sTaskbarItem a', function(){
        var taskbarId = $(this).attr('href');
        var modalId = taskbarId.replace('taskbar','');
        $(modalId).show();
        $(this).closest('.sTaskbarItem').remove();
    });
    /*
bugfix, hide actions menus on sTaskbarh over
    */
    $("#sTaskbar").on('hover',function(){
        $(this).children('.sTaskbarItem').each(function(index){
            $(this).children('ul').hide();
        });
    })
    /*
hover a item to show its action menu
    */
    $("body").on('hover','.sTaskbarItem a', function(){
        $(this).next('ul').show();
        $(this).next('ul:visible').unbind('mouseleave').bind('mouseleave',function(){
            $(this).hide();
        })
    });
    /* 
hide action menu when mouse no longer hoover
    */ 
    $("body").on('mouseleave','.sTaskbarItem ul',function(){
        $(this).hide();
    });
}