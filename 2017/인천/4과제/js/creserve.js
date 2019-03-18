/* doucment javacsript */

window.dd = console.log.bind(console);

$(function() {
	$(".date").on({
		change : function() {
			var indate = $(".indate").val(),
				outdate = $(".outdate").val();

			$("#number").attr("disabled", true);
			$("#number option").hide();

			if(indate == "" || outdate == "")
				return false;

			if(new Date(indate).getTime() > new Date(outdate).getTime()) {
				$(".outdate").val("");

				alert("입실이 퇴실보다 미래일 수는 없습니다.");
			} else {
				searchRoom(indate, outdate);
			};
		},
	}).trigger("change");
})

function searchRoom(indate, outdate) {
	$.ajax({
		url : "/reserve/getReserveRoom",
		data : {
			indate : indate,
			outdate : outdate,
		},
		type : "POST",
		success : function(e) {
			console.log(e);
			$(".hotel-view td").removeClass("bg-primary");
			$("#number option").show();

			var datas = JSON.parse(e);

			$("#number").attr("disabled", false);

			$.each(datas, function(idx, data) {
				$(".hotel-view td:contains("+data+")").addClass("bg-primary");
				$("#number option:contains("+data+")").hide();
			});
		},
	});
}