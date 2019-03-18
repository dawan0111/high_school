// JavaScript Documen
$(function(){
	$("#number").change(function(){
		$(".hotel-view").find("td").not(".bg-primary").attr("class","");
		var num = $("#number").val();
		for(var f = 0; f < num.length; f++){
			$(".hotel-view").find("td:contains("+num[f]+")").addClass("bg-info");
		}
	});
});