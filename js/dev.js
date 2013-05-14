  
/*!
 * jQuery lightweight plugin boilerplate
 * Original author: @ajpiano
 * Further changes, comments: @addyosmani
 * Licensed under the MIT license
 */

// the semi-colon before the function invocation is a safety
// net against concatenated scripts and/or other plugins
// that are not closed properly.
;(function ( $, window, document, undefined ) {

    // undefined is used here as the undefined global
    // variable in ECMAScript 3 and is mutable (i.e. it can
    // be changed by someone else). undefined isn't really
    // being passed in so we can ensure that its value is
    // truly undefined. In ES5, undefined can no longer be
    // modified.

    // window and document are passed through as local
    // variables rather than as globals, because this (slightly)
    // quickens the resolution process and can be more
    // efficiently minified (especially when both are
    // regularly referenced in your plugin).

    /*
        small workaround so we can let the rest of the code run on document.ready
        and register the script in the widget on doc ready
    */
    var defaults={element: $("#bpopup")};
    var pluginName = "sModal";

    $(document).ready(function(){
    var sSettings = sModalDefaults();
    // Create the defaults
        defaults = {
            element: getDefaultElement(),
            templateHtml: $(".sTemplate").html(),
            draggable:sSettings.draggable,
            draggableSettings:{},
            resizeable:sSettings.resizeable,
            resizeSettings:sSettings.resizeSettings,
        };
    });
    function closeConfirm(obj){
            obj.closest('.bpopup').bPopup().close();

    }
    // The actual plugin constructor
    function Plugin( element, options ) {
        this.element = element;

        if(typeof options =="undefined")
                options={};
        this.options = $.extend( {}, defaults, options) ;
        
        this._defaults = defaults;
        this._name = sModal;
        this.init();

    }

    Plugin.prototype = {
        conf: function(options,object){
            object.html($("#sConfirmTemplate").html());
            object.find(".confirmTrue").addClass(options.yes.class).append(options.yes.label);
            object.find(".confirmFalse").addClass(options.no.class).append(options.no.label);
            var data =$("#sConfirmTemplate").html();
           $("body").on('click','.confirmTrue',options.yes.click);
            return data;
        },
        init: function() {
        var sSettings = sModalDefaults(),
            bSettings =  bpopupDefaults(),
            options = this.options,
            element = this.element;

        /*bugfix to clear any changes*/
       if(options.settings){
            $.each(options.settings,function(key,value){
                bSettings[key] = value;
            });
        }
        // insert design template
        if(!options.templateHtml){
            options.templateHtml = $(".sTemplate").html();        
        }

     
        //if there is no data sent,back up and use the divs current content 
        //to preserve ajax features in basic modals we need a fix control variable
        var insertedTemplate = false; 

        if(typeof options.data == "undefined"){
                options.data = element.children('.smodalContent').html();
                if(typeof options.data =="undefined"){      
                 element.wrapInner('<div class="smodalContent">');                
                 element.prepend(options.templateHtml);
                 insertedTemplate = true;
            }
        }
        
        if(!insertedTemplate){
          // making sure it goes right
            element.html(options.templateHtml);
            element.append('<div class="smodalContent">'+options.data+'</div>');  
        }

        if(options.confirm){
            options.data = this.conf(options.confirm,element.children('.smodalContent') );                             
        }
        //title;
        if(options.title){
            element.children('.draghandle').children('span').html(options.title);
        }   
        if(!element.hasClass('bpopup')){
            element.addClass('bpopup');
        }                
        
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
  
        if(options.draggable){
            element.draggable(options.draggableSettings);
        }    
        
        if(options.resizeable){
            if(options.resizeSettings == {}){
                options.resizeSettings = {
                    start:function(){
                        element.children(".smodalContent").show();
                    },
                };
            }
          resizeModals(element,options.resizeSettings);
        }
        //show modal                
        element.bPopup(bSettings);
        //return element with data
        $(".bunfold").hide();            
        return element.children(".smodalContent");
        },

        
    };

    // A really lightweight plugin wrapper around the constructor,
    // preventing against multiple instantiations
    $.fn.sModal = function ( options) {
        if(typeof this =="function"){
            var object = defaults.element;
            object.html("");
        }else{
            var object = this;
       }
        new Plugin( object, options );
       
        return this.each(function () {
            if (!$.data(object, "plugin_" + pluginName)) {
                $.data(object, "plugin_" + pluginName,
                new Plugin( object, options ));
            }
        });        
    }
     $.extend({
        sModal:$.fn.sModal 
    });

})( jQuery, window, document );
