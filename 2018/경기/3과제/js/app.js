/* document javascript */

Date.prototype.ymdhis = function() {
	return (
		this.getFullYear() + "-" +
		zero(this.getMonth() + 1) + "-" +
		zero(this.getDate()) + " " +
		zero(this.getHours()) + ":" +
		zero(this.getMinutes()) + ":" +
		zero(this.getSeconds())
	);

	function zero(n) {
		return n < 10 ? "0"+n : n;
	}
};

window.dd = console.log.bind(console);

const DEBUG = false;
const ls = localStorage;

/* 오른쪽 리스트 */
const List = {
	init () {
		this.$element = $(".list").clone();
		$(".list").remove();
	},
	refresh () {
		var {list} = JSON.parse(ls.getItem("webSite"));
		var sort = $("#sort").val();
		var order = $("#order").val();

		list = list.sort((a, b) => {
			var result  = a[sort] < b[sort] ? -1 : 1;

			if(a[sort] == b[sort])
				result = 0;

			if(order == "desc")
				result *= -1;

			return result;
		});

		$(".list").remove();

		$.each(list, (idx, data) => {
			var $list = this.$element.clone();
			var canvas = document.createElement("canvas");
			var ctx = canvas.getContext("2d");
			var image = new Image();

			canvas.width = 400;
			canvas.height = 225;

			image.onload = function() {
				ctx.fillStyle = "#fff";
				ctx.fillRect(0, 0, 400, 255);
				ctx.drawImage(image, 0, 0, 400, 225);
				$list.find("img").attr("src", canvas.toDataURL());
			};

			var svgData = `
				<svg xmlns="http://www.w3.org/2000/svg" width="${data.width}" height="${data.height}">
		           <foreignObject width="100%" height="100%">
			           <div xmlns="http://www.w3.org/1999/xhtml" style="position:relative">
			            	${data.html}
			           </div>
		           </foreignObject>
	           </svg>
			`;

			svgData = encodeURIComponent(svgData);

			image.src = "data:image/svg+xml," + svgData;

			$list.attr("data-idx", data.idx);
			$list.find(".title a").html(data.name);
			$list.find(".des").html(data.info);
			$list.find(".date").html(new Date(data.date).ymdhis());

			$list.appendTo($(".listBox"));
		});
	},
};

/* 웹페이지 제작 창 */
const Editor = {
	styleSet : {
		shape : {
			borderWidth : "1px",
			borderColor : "black",
			borderStyle : "solid",
			backgroundColor : "#fff",
		},
		text : {
			backgroundColor : "#fff",
		}
	},

	open (option) {
		var {width, height, html} = option;

		$("#start")
			.hide()
			.next().show();

		$("#makeView")
			.css({
				height
			})

		$("#makeLayer")
			.css({
				width,
				height,
				overflow : "hidden",
				border : "1px solid #ccc",
				position : "relative",
			})
			.html(html);

		this.width = width;
		this.height = height;
		this.idx = option.idx || false;
		this.clear();
		this.state = "open";
	},

	clear () {
		$("#leftMenu > div").removeClass("selected");
		this.tool = false;
	},

	close () {
		$("#start")
			.show()
			.next().hide();

		List.refresh();
	},

	getOffset (x, y) {
		var x = x - $("#makeLayer").offset().left;
		var y = y;

		return {x, y};
	},

	makeElement (type, left, top) {
		var styleSet = this.styleSet[type];
		var $element = $("<div></div>", {
			class : "element "+type,
			css : $.extend({
				position : "absolute",
				left,
				top,
			}, styleSet),
			type
		}).appendTo("#makeLayer");

		if(type == "text") {
			$element
				.attr("contenteditable", true);

			setTimeout(() => { $element.focus(); });
		};

		return $element;
	},
};

/* 만들기용 오브젝트 */
const Make = {
	start ($target, x, y) {
		this.$target = $target;
		this.x = x;
		this.y = y;
	},

	move (x, y) {
		this.$target.css({
			left : Math.min(this.x, x),
			top : Math.min(this.y, y),
			width : Math.abs(this.x - x),
			height : Math.abs(this.y - y)
		});
	},

	end () {
		this.$target = null;
	},
};

/* 움직이기용 오브젝트 */
const Move = {
	start ($target, x, y) {
		this.$target = $target;

		this.x = x;
		this.y = y;
		this.left = parseInt($target.css("left"));
		this.top = parseInt($target.css("top"));
	},

	move (x, y) {
		var moveX = x - this.x;
		var moveY = y - this.y;

		this.$target.css({
			left : this.left + moveX,
			top : this.top + moveY,
		});
	},

	end () {
		this.$target = null;
	},
};

/* 색깔 변경 및 스타일용 오브젝트 */
const Option = {
	makeOption ($target, $element) {
		this.$target = $target;
		this.$option = $element;
		this.canvas = $element.find("canvas")[0];
		this.ctx = this.canvas.getContext("2d");
		this.activeType = null;
		this.rgb = [255, 255, 255];
		this.opacity = 1;

		$(".elementOption.clone").remove();
		$("#makeView").append($element);

		$element
			.on("mousedown", function(e) {
				e.stopPropagation();
			})
			.on("click", "canvas", function(e) {
				Option.getColor(e.offsetX, e.offsetY);
			})
			.on("click", ".box[data-type]", function() {
				var type = $(this).data("type");
				Option.activeType = type;
				Option.$option.find(".box[data-type]").removeClass("active");

				$(this).addClass("active");
			})
			.on("change", ".color", function() {
				Option.makeColorPicker( $(this).val() );
			})
			.on("input", ".alpha", function() {
				Option.opacity =  $(this).val() / 100;
				Option.colorChange();
			})
			.on("change", ".borderSize", function() {
				Option.$target.css("borderWidth", $(this).val());
			})
			.on("change", ".fontSize", function() {
				document.execCommand("fontSize", false, $(this).val());
			})
			.on("click", ".link-btn", function() {
				var type = $(this).hasClass("createLink") ? "create" : "unlink";

				if(type == "create") {
					var link = prompt("링크를 입력해주세요.");

					if(link) {
						document.execCommand("createLink", false, link);
						$("a").attr("target", "_blank");
					}
				} else {
					document.execCommand("unlink", false, false);
				};
			})

		this.makeColorPicker(360);
	},

	makeColorPicker ( hue ) {
		var {canvas, ctx} = this;
		var grd1 = ctx.createLinearGradient(0, 0, 200, 0);
		var grd2 = ctx.createLinearGradient(0, 0, 0, 120);

		ctx.clearRect(0, 0, 999, 999);

		grd1.addColorStop(0, `hsl(${hue}, 100%, 100%)`);
		grd1.addColorStop(1, `hsl(${hue}, 100%, 50%)`);

		grd2.addColorStop(0, "transparent");
		grd2.addColorStop(1, "black");

		ctx.fillStyle = grd1;
		ctx.fillRect(0, 0, 200, 120);

		ctx.fillStyle = grd2;
		ctx.fillRect(0, 0, 200, 120);
	},

	getColor (x, y) {
		var {ctx} = this;
		var imageData = ctx.getImageData(x, y, 1, 1);

		this.rgb = imageData.data.slice(0, 3);
		this.colorChange();
	},

	colorChange () {
		var rgba = [...this.rgb, this.opacity];
		var rgbaCode = "rgba("+rgba.join(", ")+")";

		switch (this.activeType) {
			case "backgroundColor":
			case "borderColor":
				this.$target.css(this.activeType, rgbaCode);
				break;
			case "color":
				document.execCommand("styleWithCSS", false, true);
				document.execCommand("foreColor", false, rgbaCode);
				break;
		};

		this.$option.find(".active .currentColor").css("background", rgbaCode);
	},
};

$( function () {
	List.init();

	if(!ls.getItem("webSite")) {
		ls.setItem("webSite", JSON.stringify({
			idx : 0,
			list : [],
		}));
	};

	if(DEBUG) {
		Editor.open({
			width : 1440,
			height : 3000,
			html : "",
		});
	};
	/* 이벤트 */
	$(document)
		.on("click", "#makeWebBtn", function() {
			var height = prompt("페이지의 높이를 입력해주세요.");

			if( height.match(/^[0-9]+$/) == null ) {
				alert("페이지의 높이는 0이상의 정수로 입력해주세요.");
				return;
			};

			Editor.open({
				width : $(window).width(),
				height : height,
				html : "",
			});
		})
		.on("keydown", function(e) {
			if( Editor.state == "open" && e.keyCode == 9 ) {
				$("#leftMenu").toggleClass("on");
				e.preventDefault();
			};
		})
		.on("click", "#leftMenu .btnBlock", function (e) {
			var tool = $(this).data("type");

			$(".element.text").attr("contenteditable", tool == "text");
			$(".element:not(.text)").css({
				resize : tool == "crop" ? "both" : "none",
				overflow : "auto",
			});

			switch(tool) {
				case "home":
					Editor.close();
					break;
				case "save":
					var {list} = JSON.parse(ls.getItem("webSite"));
					dd(list);
					list = list.filter(x => x.idx == Editor.idx)[0];

					if(list) {
						$("#name").val(list.name);
						$("#info").val(list.info);
					} else {
						$("#name").val("");
						$("#info").val("");
					};

					$("#back, #popup").show();
					break;
				case "delete":
					if(confirm("삭제하시겠습니까?")) {
						$(".element").remove();
					};
					break;
				default:

					Editor.tool = tool;
					$(this)
						.addClass("selected")
						.siblings().removeClass("selected");
					break;
			};
		})
		.on("click", "#save-btn", function() {
			var webSite = JSON.parse(ls.getItem("webSite"));
			var name = $("#name").val();
			var info = $("#info").val();

			if(Editor.idx) {
				webSite.list = webSite.list.map((x) => {
					if(x.idx == Editor.idx) {
						x.html = $("#makeLayer").html();
						x.name = name;
						x.info = info;
					};

					return x;
				});
			} else {
				webSite.list.push({
					idx : ++webSite.idx,
					name : name,
					info : info,
					width : Editor.width,
					height : Editor.height,
					date : new Date(),
					html : $("#makeLayer").html(),
				});

				Editor.idx = webSite.idx;
			};

			ls.setItem("webSite", JSON.stringify(webSite));
			$("#back, #popup").hide();
		})
		.on("click", "#openList, #closeList", function() {
			$("#saveList").toggleClass("active");

			if($("#saveList").hasClass("active")) {
				List.refresh();
			};
		})
		.on("click", ".delete, .htmlDownload, .thumbDownload, .editBtn", function() {
			var $list = $(this).parents("div.list");
			var webSite = JSON.parse(ls.getItem("webSite"));
			var idx = $list.data("idx");
			var list = webSite.list.filter(arr => arr.idx == idx)[0];

			if($(this).hasClass("delete")) {
				webSite.list = webSite.list.filter(arr => arr.idx != idx);
				ls.setItem("webSite", JSON.stringify(webSite));

				List.refresh();
			};

			if($(this).hasClass("htmlDownload")) {
				var $wrap = $("<div></div>", {
					css : {
						width : list.width,
						height : list.height,
						position : "relative",
						margin : "0 auto",
					},
					html : list.html,
				});
				var html = `
					<!DOCTYPE html>
					<html lang="en">
					<head>
						<meta charset="UTF-8">
						<title>${list.name}</title>
						<style>
							::-webkit-scrollbar{
								display: none;
							}
							* {
								box-sizing:border-box;
							}
							body {
								font-size: 14px;
								margin : 0;
								padding : 0;
							}
						</style>
					</head>
					<body>
						${$wrap[0].outerHTML}
					</body>
					</html>
				`;

				var htmlBlob = new Blob([html], {type:"text/html"});

				var a = document.createElement("a");

				a.href = URL.createObjectURL(htmlBlob);
				a.download = list.name+".html";

				a.click();
			};

			if($(this).hasClass("thumbDownload")) {
				var a = document.createElement("a");

				a.href = $list.find("img").attr("src");
				a.download = list.name+".png";

				a.click();
			};

			if($(this).hasClass("editBtn")) {
				Editor.open({
					width : list.width,
					height : list.height,
					html : list.html,
					idx : list.idx
				});
			};
		})
		.on("change", "#sortBox select", function() {
			List.refresh();
		})

	$("#makeView")
		.on("mousedown mouseup mousemove", function (e) {
			var {x, y} = Editor.getOffset(e.pageX, e.pageY);

			switch(e.type) {
				case "mousedown":
					if(e.buttons == 2)
						return false;

					$(".elementOption.clone").remove();

					if(["shape", "text"].includes(Editor.tool)) {
						var $element = Editor.makeElement(Editor.tool, x, y);

						if(Editor.tool == "shape") {
							Make.start($element, x, y);
						};
					};
					break;
				case "mousemove":
					if(Make.$target)
						Make.move(x, y);

					if(Move.$target)
						Move.move(x, y);
					break;
				case "mouseup":
					if(Make.$target)
						Make.end();
					break;
			};
		})
		.on("mousedown mouseup contextmenu", ".element", function(e) {
			var {x, y} = Editor.getOffset(e.pageX, e.pageY);
			var type = $(this).attr("type");

			switch(e.type) {
				case "mousedown":
					if(Editor.tool == "move") {
						Move.start($(this), x, y);
					};

					if(Editor.tool == "text" && type == "text") {
						$(".elementOption.clone").remove();
						e.stopPropagation();
					}
					break;
				case "mouseup":
					if(Move.$target)
						Move.end();
					break;
				case "contextmenu":
					if(["text", "shape"].includes(Editor.tool)) {
						e.preventDefault();

						var selection = window.getSelection();

						if(
							type == "text" &&
							selection.toString() == ""
						) {
							return false;
						};

						$(".elementOption.clone").remove();
						
						var $option = $(".elementOption").clone();

						$option
							.css({
								display : "block",
								left : e.pageX,
								top : e.pageY
							})
							.addClass("clone")
							.find(".box").hide()
							.parent()
							.find("."+type+"-box").show();

						Option.makeOption($(this), $option);
					};
					break;
			};
		})
		.on("drop dragover", function(e) {
			var {x, y} = Editor.getOffset(e.pageX, e.pageY);
			e.preventDefault();

			switch(e.type) {
				case "drop":
					var file = e.originalEvent.dataTransfer.files[0];
					var fileReader = new FileReader();
					var image = new Image();

					var error = function() {
						alert("이미지를 업로드 해주세요.");
					};

					image.onload = function(e) {
						$block = Editor.makeElement("image", x - image.width / 2, y - image.height / 2);

						$block.css({
							width : image.width,
							height : image.height,
							backgroundImage : "url("+image.src+")"
						});
					};

					fileReader.onload = function(e) {
						image.src = e.target.result;
					};

					image.onerror = error;
					fileReader.onerror = error;

					fileReader.readAsDataURL(file);
					break;
			};
		})
} );
