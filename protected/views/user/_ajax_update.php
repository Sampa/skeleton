<div id="user-update-modal-container" >

</div>

<script type="text/javascript">
function update()
 {
  
   var data=$("#user-update-form").serialize();

  $.ajax({
   type: 'POST',
    url: '<?php echo Yii::app()->createAbsoluteUrl("user/update"); ?>',
   data:data,
success:function(data){
                if(data!="false")
                 {
                  $('#user-update-modal').modal('hide');
                  renderView(data);
                  $.fn.yiiGridView.update('user-grid', {
                     
                         });
                 }
                 
              },
   error: function(data) { // if error occured
          alert(JSON.stringify(data)); 

    },

  dataType:'html'
  });

}

function renderUpdateForm(id)
{
 
   $('#user-view-modal').modal('hide');
 var data="id="+id;

  $.ajax({
   type: 'POST',
    url: '<?php echo Yii::app()->createAbsoluteUrl("user/update"); ?>',
   data:data,
success:function(data){
                 // alert("succes:"+data); 
                 $('#user-update-modal-container').html(data); 
                 $('#user-update-modal').modal('show');
              },
   error: function(data) { // if error occured
           alert(JSON.stringify(data)); 
         alert("Error occured.please try again");
    },

  dataType:'html'
  });

}
</script>
