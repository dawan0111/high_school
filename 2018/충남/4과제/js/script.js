$(function(){
	
	// 카드번호
	$(".cardPay > li > #cardNum").keyup(function() {
		this.value = this.value.replace(/[^0-9]/g, '');
	});
	
	// 무통장번호
	$(".cashPay > li > #phone").keyup(function() {
		this.value = this.value.replace(/[^0-9]/g, '');
	});
	
	// 검색예약
	$("#category").change(function() {
		var selected = $(this).find("option:selected");
		var category = selected.data("category");
		$(".div-category").each(function(e, el) {
			if($(el).attr("data-category") == category) $(el).show();
			else $(el).hide();
		});
	});

	var date = new Date(),
		e_date = new Date();

var dont = [];
	date.setDate(date.getDate() + 1);

	if($("#start").length != 0) {
		if($("#start").data("dont")) {
			var dont = $("#start").data("dont").split(",").map(function(arr) {
				return new Date(arr+" 00:00:00");
			});
		};
	}

	$("#start").datepicker({
		minDate : date,
		dateFormat : "yy-mm-dd",
		beforeShowDay : function(date) {
			var disabled = true;

			for (var i = 0; i < dont.length; i++) {
				if(date - dont[i] == 0) {
					disabled = false;
					break;
				}
			};

			return [disabled, 0, 0];
		},
	}).on({
		change : function() {
			var date = new Date($(this).val());
			date.setDate(date.getDate() + 1);


			$("#end").datepicker("option", "minDate", date);
		},
	});
	e_date.setDate(e_date.getDate() + 2);
	$("#end").datepicker({
		minDate : e_date,
		dateFormat : "yy-mm-dd",
		beforeShowDay : function(date) {
			var disabled = true;

			for (var i = 0; i < dont.length; i++) {
				if(date - dont[i] == 0) {
					disabled = false;
					break;
				}
			};

			return [disabled, 0, 0];
		},
	});

	$("#category").on("change", function() {
		var type = $(this).find("option:selected").data("category");

		$(".div-category").hide();
		$("div[data-category="+type+"]").show();
	});
});
