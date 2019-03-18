/* document javascript */

window.dd = console.log.bind(console);

/*
	10시간 12분
 */

String.prototype.getCho = function() {
	var cho = ["ㄱ","ㄲ","ㄴ","ㄷ","ㄸ","ㄹ","ㅁ","ㅂ","ㅃ","ㅅ","ㅆ","ㅇ","ㅈ","ㅉ","ㅊ","ㅋ","ㅌ","ㅍ","ㅎ"],
		result = "",

		length = $(this).length;

	for(var i = 0; i < length; i++) {
		var code = this.charCodeAt(i)-44032;

		if(code > -1 && code < 11172) {
			result += cho[Math.floor(code/588)];
		} else {
			result += this.charAt(i);
		}
	};

	return result;
}

var Tourist = {
	tourLists : touristData.data,
	sort : "idx",
	keyword : "",

	// 가져오는 데이터를 사용하기 쉽게 바꿔줌
	getData () {
		this.tourLists = touristData.data;

		this.tourLists.sort((a, b) => {
			if(this.sort == "idx") {
				return a.idx - b.idx;
			} else {
				if( a.name < b.name ) return -1;
				if( b.name < a.name ) return 1;

				return 0;
			};
		});

		this.tourLists.map((tour) => {
			var total = tour.date.reduce(function(a, b) {
				return a + b;
			}, 0);

			tour.average = Math.floor(total / tour.date.length);
			tour.color = "#"+Math.floor(Math.random()*16777215).toString(16);
		});

		if(this.keyword != "") {
			this.tourLists = this.tourLists.filter((tour) => {
				var keyword = this.keyword,

					choReg = new RegExp(keyword.getCho(), "g"),
					chk = true;

				var match = tour.name.getCho().search(choReg);

				if(match != -1) {
					for(var i = 0; i <= match + keyword.length; i++) {
						var code = keyword.charCodeAt(i);

						if(44032 <= code && 54616 >= code) {
							if(keyword.charAt(i) != tour.name.charAt(match + i))
								chk = false;
						};
					};
				} else {
					chk = false;
				};

				return chk;
			});
		};

		return this.tourLists;
	},

	// 데이터를 화면에 추가해줌
	listAppend ( tourList ) {
		$(".body").remove();

		$.each(tourList, (idx, tour) => {
			var $ul = $("<ul class='body'></ul>");

			$ul.append(`
        		<li>
        			<div class="nm input-field col s1">
			          	<input type="checkbox" class="chk filled-in" id="${tour.idx}" value='${idx}'/>
			      		<label for="${tour.idx}"></label>
			        </div>
        		</li>
        		<li>${tour.idx}</li>
        		<li>${tour.name}</li>
        		<li>${tour.average}</li>
        		<li>
        			<a class="waves-effect waves-light btn" data-idx='${idx}'>보기</a>
        		</li> 
        		<li class="canvas">
        			<canvas width='1160' height='500'>
        		</li>
			`);

			$(".table").append($ul);
		});
	}
}

var canvas = {

	count : 0,

	drawDefault ( canvas ) {
		this.count = 0;

		ctx = canvas[0].getContext("2d");

		ctx.fillStyle = "#ffffff";

		ctx.fillRect(0, 0, 1160, 500);
		ctx.globalAlpha = ctx.lineWidth = 1;
		ctx.fillStyle = ctx.strokeStyle = "#000000";


		ctx.moveTo(80, 20);
		ctx.lineTo(80, 410);

		ctx.moveTo(80, 410);
		ctx.lineTo(1080, 410);

		for(var i = 1; i <= 10; i++) {
			var y = 390 - 390 / 10 * i + 20;

			ctx.font = "margungothic 20pt";

			ctx.fillText(i * 100, 52, y + 5);

			ctx.moveTo(80, y);
			ctx.lineTo(1080, y);
		};

		for(var i = 1; i <= 31; i++) {
			var x = 1000 / 31 * i + 70;

			ctx.fillText(i, x, 420);
		}


		ctx.stroke();
		ctx.beginPath();
	},

	drawData (data, canvas, element, range = 1, bold = null) {
		var ctx = canvas[0].getContext("2d");
		var maxCount = Math.ceil(data.date.length / range);

		var prev = {};
		var color = data.color;

		for(var i = 1; i <= maxCount; i++) {
			var $p = $("<p class='data_mark'></p>"),
				arcr = 2.5;

			ctx.strokeStyle = ctx.fillStyle = color;

			if(bold != null) {
				if(data.idx == bold) {
					ctx.lineWidth = 3;
					ctx.globalAlpha = 1;
					arcr = 4;
				} else {
					ctx.lineWidth = 1;
					ctx.globalAlpha = 0.4;
				};
			};

			var value = data.date[(i - 1) * range];

			var prt = value / 1000 * 100;

			var x = 1000 / 31 * ((i - 1) * range) + 105;
			var y = 390 - 390 / 100 * prt + 20;

			ctx.arc(x ,y, arcr, 0, Math.PI * 2);
			ctx.fill();

			$p
				.css({
					position : "absolute",
					left : x+"px",
					top : y+"px",
					width : "5px",
					height : "5px",
					transform : "translate(-50%, -50%)",
					borderRadius : "50%",
				})
				.attr("data-value", value);

			element.append($p);

			ctx.beginPath();

			if(i > 1) {
				ctx.moveTo(prev.x, prev.y);
				ctx.lineTo(x, y);

				ctx.stroke();
				ctx.beginPath();

			};

			prev = {
				x : x,
				y : y
			};
		};

		ctx.globalAlpha = 1;

		var $div = $("<div class='list'></div>");

		ctx.fillRect(80 + 200 * this.count, 450, 10, 10);
		ctx.fillText(data.name, 95 + 200 * this.count, 460);

		var textStatus = ctx.measureText(data.name);

		$div
			.attr("data-idx", data.idx)
			.css({
				position : "absolute",
				left : (95 + 200 * this.count)+"px",
				top : 446,
				width : textStatus.width+"px",
				height : 15+"px",
			});

		element.append($div);

		this.count++;
	}
}

var App = {
	init () {
		Tourist.listAppend(Tourist.getData());

		this.hook();
	},

	hook () {
		$("#filled-in-box").on({
			click : function() {
				if($(this).is(":checked")) {
					Tourist.sort = "korean";
				} else {
					Tourist.sort = "idx";
				};

				Tourist.listAppend(Tourist.getData());
			}
		});

		$("#name").on({
			input : function() {
				$(".autocomplete li").remove();
			
				Tourist.keyword = $(this).val();

				var tourList = Tourist.getData();

				if($(this).val() != "") {
					$.each(tourList, function(idx, tour) {
						var $li = $("<li></li>");

						$li.append(tour.name);

						$(".autocomplete").append($li);
					});
				};

				Tourist.listAppend(tourList);
			}
		});

		$(".graphBtn").on({
			click : function() {
				var $popup = $("<div class='popup'></div>"),
					$graph = $("<div class='graph' id='popupGraph'></div>'");

				$graph
					.css({
						position : "relative",
					})
					.append("<canvas width='1160' height='580' id='canvas'>");

				$popup
					.append($graph)
					.append("<div class='popupSlider'></div>");

				$popup.dialog({
					title : "그래프 비교",
					width : "auto",
					height : "auto",
					open : function() {
						var can = $(this).find("canvas");

						canvas.drawDefault(can);

						$(".filled-in:checked").each((idx, el) => {
							canvas.drawData(touristData.data[$(el).val()], can, $graph);
						});

						var $slider = $(".popupSlider");

						$slider
							.css({
								width : "80%",
								margin : "0 auto",
							})
							.slider({
								min : 1,
								max : 5,
								change : function() {
									canvas.drawDefault(can);

									$(".filled-in:checked").each((idx, el) => {
										canvas.drawData(touristData.data[$(el).val()], can, $graph, $(this).slider("value"));
									});
								}
							});
					},
					modal : true,
					close : function() {
						$(this).remove();
					},
					buttons : {
						닫기 : function() {
							$(this).dialog("close");
						},
					}
				})
			}
		})

		$(document).on("keydown", function(e) {
			if(e.keyCode == 27) {
				$(".popup").dialog("close");
			};
		})

		$(document).on("click", ".waves-effect", function() {
			var $canvas = $(this).parents("ul.body").find(".canvas"),
				$btn = $(this),
				idx = $(this).data("idx");

			$($canvas).find(".slider").remove();

			$canvas.toggleClass("active");

			if($canvas.hasClass("active")) {
				canvas.drawDefault($canvas.find("canvas"));
				canvas.drawData(touristData.data[idx], $canvas.find("canvas"), $canvas);

				var $slider = $("<div class='slider'></div>");

				$slider
					.css({
						width : "80%",
						margin : "0 auto",
					})
					.slider({
						min : 1,
						max : 5,
						change : function() {
							canvas.drawDefault($canvas.find("canvas"));
							canvas.drawData(touristData.data[idx], $canvas.find("canvas"), $canvas, $(this).slider("value"));
						}
					});

				$canvas.append($slider);
				
			}
		});

		$(document).on("mouseenter mouseleave", ".data_mark", function(e) {
			$(".mark").remove();
			var $p = $(this);

			if(e.type == "mouseenter") {
				var $mark = $("<div class='mark'></div>");

				$mark
					.css({
						position : "absolute",
						left : (parseInt($p.css("left")) + 5)+"px",
						top : (parseInt($p.css("top")) + 5)+"px",
						width : "70px",
						height : "30px",
						lineHeight : "30px",
						color : "#fff",
						background : "rgba(0, 0, 0, 0.5)",
						textAlign : "center",
					});

				$mark.append($p.data("value")+"명");

				$p.parent().append($mark);
			} else {
				$(".mark").remove();
			};
		});

		$(document).on("change", ".filled-in", function() {
			var count = 0;

			$(".filled-in").each((idx, el) => {
				if($(el).is(":checked"))
					count++;
			});

			if(count > 1) {
				if(count > 3) {
					alert("3개 까지 체크 가능합니다.");
					$(this).prop("checked", false);
				};

				$(".graphBtn").removeClass("disabled");
			} else {
				$(".graphBtn").addClass("disabled");
			};
		});

		$(document).on("mouseenter mouseleave", ".list", function(e) {
			var can = $("#canvas"),
				$graph = $("#popupGraph"),

				idx = $(this).data("idx");

			if(e.type == "mouseenter") {
				canvas.drawDefault(can);

				$(".filled-in:checked").each((key, el) => {
					canvas.drawData(touristData.data[$(el).val()], can, $graph, $(".popupSlider").slider("value"), idx);
				});
			} else {
				canvas.drawDefault(can);

				$(".filled-in:checked").each((key, el) => {
					canvas.drawData(touristData.data[$(el).val()], can, $graph, $(".popupSlider").slider("value"));
				});
			};
		});
	}
}

$(function() {
	App.init();
})