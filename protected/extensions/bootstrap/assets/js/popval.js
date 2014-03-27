
function popTooltip(prefix){
		var selector = "[id^="+prefix+"]";
		$("body").on("focus",selector,function(){
			var id = $(this).attr("id");
			$("#pop_tooltip_"+id).show();
		});
		$("body").on("blur",selector,function(){
			var id = $(this).attr("id");
			$("#pop_tooltip_"+id).hide();
		});
}