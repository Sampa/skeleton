<?php
$this->breadcrumbs=array(
	'Users',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('user-grid', {
        data: $(this).serialize()
    });
    return false;
});
");

?>

<h1>Users</h1>
<hr />

<?php 
$this->beginWidget('zii.widgets.CPortlet', array(
	'htmlOptions'=>array(
		'class'=>''
	)
));
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		array('label'=>'Create', 'icon'=>'icon-plus', 'url'=>'javascript:return;','linkOptions'=>array('onclick'=>'renderCreateForm()')),
                array('label'=>'List', 'icon'=>'icon-th-list', 'url'=>Yii::app()->controller->createUrl('index'),'active'=>true, 'linkOptions'=>array()),
		array('label'=>'Search', 'icon'=>'icon-search', 'url'=>'#', 'linkOptions'=>array('class'=>'search-button')),
		array('label'=>'Export to PDF', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GeneratePdf'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
		array('label'=>'Export to Excel', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GenerateExcel'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
	),
));
$this->endWidget();
?>



<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<div class="span11">
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
        'type'=>'striped bordered condensed',
        'template'=>'{summary}{pager}{items}{pager}',
	'columns'=>array(
		'id',
		'username',
		'password',
		'email',
		'profile',
		'role',
               array(
		     
		      'type'=>'raw',
		       'value'=>'"
		      <a href=\'javascript:return;\' onclick=\'renderView(".$data->id.")\'   class=\'btn btn-small view\'  ><i class=\'icon-eye-open\'></i></a>
		      <a href=\'javascript:return;\' onclick=\'renderUpdateForm(".$data->id.")\'   class=\'btn btn-small view\'  ><i class=\'icon-pencil\'></i></a>
		      <a href=\'javascript:return;\' onclick=\'delete_record(".$data->id.")\'   class=\'btn btn-small view\'  ><i class=\'icon-trash\'></i></a>
		     "',
		      'htmlOptions'=>array('class'=>'')  
		     ),
        
	),
)); 


 $this->renderPartial("_ajax_update");
 $this->renderPartial("_ajax_create_form",array("model"=>$model));
 $this->renderPartial("_ajax_view");

 ?>
</div>
 
<script type="text/javascript"> 

function delete_record(id)
{
      bootbox.dialog("Are you sure you want to delete?", [
        {
        "label" : "No",
        "class" : "btn-danger",
        "callback": function() {
          
          }
        }, 
        {
        "label" : "Yes",
        "class" : "btn-success",
        "callback": function() {
           //  $('#ajaxtest-view-modal').modal('hide');
 
           var data="id="+id;
           

            $.ajax({
             type: 'POST',
              url: 'http://skeleton/post/delete',
             data:data,
          success:function(data){
                           if(data=="true")
                            {
                               $('#post-view-modal').modal('hide');
                               $.fn.yiiGridView.update('post-grid', {
                               
                                   });
                           
                            } 
                           else
                             alert("deletion failed");
                        },
             error: function(data) { // if error occured
                     alert(JSON.stringify(data)); 
                   alert("Error occured.please try again");
                 //  alert(data);
              },

            dataType:'html'
            });
          }
         },
      ]
      );
      
        
  


}
</script>

<style type="text/css" media="print">
body {visibility:hidden;}
.printableArea{visibility:visible;} 
</style>
<script type="text/javascript">
function printDiv()
{

window.print();

}
</script>
 

