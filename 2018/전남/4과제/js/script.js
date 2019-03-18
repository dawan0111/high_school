$(function(){

	score_icon();
	flexAlign();
	textOverFlow();

	var alert = $("<div></div>", {
		class : 'alert',
	});
	alert.append("<div class='message'></div>");
	alert.append("<button class='yes'>예</button>");
	alert.append("<button class='no'>아니요</button>");

	$(".confirm-a").on({
		click (e) {
			e.preventDefault();
			var self = this;

			$(".alert").remove();

			var alert_clone = alert.clone();

			alert_clone.find(".message").html("정말로 삭제 하시겠습니까?");
			$("body").append(alert_clone);

			alert_clone.find(".yes").on({
				click () {
					location.href = $(self).attr('href');
				},
			});
			alert_clone.find(".no").on({
				click () {
					$(".alert").remove();
				},
			});

			/*if(confirm("정말로 삭제 하시겠습니까?")) {
			};*/
		},
	});

	$(".modi-a").on({
		click (e) {
			e.preventDefault();

			var alert_clone = alert.clone();

			alert_clone.find(".message").html(`
				<form class="form" method="post" action="/comment/modify/${$(this).data("idx")}">
					<table>
						<tr>
							<td>
								<label for="">제목</label>
							</td>
							<td>
								<input type="text" name="title">
							</td>
						</tr>
						<tr>
							<td>
								<label for="">평점</label>
							</td>
							<td class="js-score">
								<input type="hidden" name="star" value="-1" class="js-getScore">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</td>
						</tr>
						<tr>
							<td>
								<label for="">내용</label>
							</td>
							<td>
								<textarea name="info" style="font-family:'malgun gothic'"></textarea>
							</td>
						</tr>
					</table>
					<input type="submit" value="전 송">
				</form>
			`);
		},
	})
});

function score_icon(){
	var obj = ".js-score i";
	$(obj).click(function(e){
		var max = $(obj).index(this);
		$(obj).removeClass('on');
		for(var i = 0; i <= max; i++){
			$(obj).eq(i).addClass('on');
		}
		get_score(i);
	});
}

function get_score($score){
	var obj = "input.js-getScore";
	$(obj).val($score);
}

function flexAlign(){
	var obj = ".js-flexAlign";
	for(var i = 0; i < 3; i++){
		$(obj).append('<div class="empty"></div>');
	}
}

function textOverFlow(){
	var obj = ".js-overFlow";
	$(obj).each(function(i, e) {
		var string = $(e).text();
		var stringLength = string.length;
		var max = 55;

		if ( $(e).data('length') ) max = $(e).data('length');

		if ( stringLength > max) {
			$(e).text(string.substr(0,max) + "...");
		}
	});
}