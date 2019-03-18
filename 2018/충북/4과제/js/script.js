// JavaScript Document
$(function (){
	$(document).on('keyup','.content .item_list .search > div > .price input',function (){
		var val = $(this).val();
		val = val.split(",").join("");
		val = numbercomma(val);
		$(this).val(val);
	});
	
	
});

function numbercomma(x) {
	return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}