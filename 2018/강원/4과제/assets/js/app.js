/* document javascript */

$(function() {
	$(".give-image").on({
		click () {
			if(confirm("기부하시겠습니까?")) {
				location.href = "/point/change?kind="+$(this).attr("alt");
			};
		},
	});

	$(".ball").on({
		click () {
			$(this).toggleClass("active");

			if($(".ball.active").length > 6) {
				alert("이미 모두 선택하셨습니다.");
				$(this).removeClass("active");
				return false;
			};

			var number = [];

			$(".ball.active").each((idx, el) => {
				number.push($(el).data("num"));
			});

			$("#number").val(number.join(","));
		},
	});

	$(".cancle_btn").on({
		click() {
			$(".ball").removeClass("active");
			$("#number").val("");
		},
	})

	$(".user-image").on({
		click () {
			alert("회원만 기부 가능합니다.");
		},
	})
})