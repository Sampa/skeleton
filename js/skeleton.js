
/*USEFULL FUNCTIONS*/


//check file extension
function getExtension(filename) {
    return filename.split('.').pop().toLowerCase();
}

$(document).ready(function(){
	$('#LoginForm_rememberMe').tooltip({'placement':'bottom','html':true});
});


  $("#login-form").submit(function(event){
    event.preventDefault();
    if (this.beenSubmitted){
        $(this).isLoading("hide");
       this.beenSubmitted = false;
        return false;
    }else
      this.beenSubmitted = true;

    $(this).isLoading();
    $.post($(this).attr('action'), $(this).serialize(),function(data){
      if(data !== null && data.status=="success"){
        $("#login").bPopup().close();         
          $(location).attr('href',data.url);
        }
        $(this).isLoading("hide");
    }, "json");       
    return false;
  });




