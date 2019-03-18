/* document javascript */

/*Array.prototype.delete = function(idx) {

}*/

window.dd = console.log.bind(console);

var powerPoint = {
	items : [
		{
			children : [
			],
			select : true,
		},
	],

	EFFECT : {
		view : "나타나기",
		fade : "서서히 나타나기",
		rotate : "회전",
		scale : "커지기",
	},

	selectIdx : null,
	selectChild : null,

	itemLoad ( items = this.items ) {
		this.items = items;

		$(".slides > div > div").remove();

		$.each(items, (idx, item) => {
			var $div = $("<div></div>");

			$div
				.attr("data-idx", idx)
				.append("<span>"+(idx+1)+"</span>")
				.addClass("item");

			if(item.select) {
				$div.addClass("select");

				this.selectIdx = idx;
			}

			if(item.make) {
				$div.addClass("effect show")
				delete item.make;
			}

			$(".slides > div").append($div);
		})

		setTimeout(function() {
			$(".item").removeClass("effect show");
		}, 500);

		App.hook();

		this.itemSave();
		this.selectLoad();
	},

	selectLoad () {
		$(".state > ul > li").remove();
		$("#shell *").remove();

		$.each(this.items, (idx, item) => {
			if(item.select) {
				$(".state h3").html("슬라이드"+(idx+1));
				var count = {
					image : 0,
					text : 0,
				}

				$.each(item.children, (key, data) => {
					var $li = $("<li></li>"),
						text,

						$element;

					if(data.type == "image") {
						var $image = $("<img>");

						count.image++;
						text = "이미지";

						$element = $("<div class='image_box'></div>");
						$image.attr("src", data.src);

						$element.append($image);
					} else {
						count.text++;
						text = "텍스트";

						$element = $("<span></span>");

						$element
							.css({
								fontSize : data.size+"px",
								color : data.color
							})
							.append(data.text);
					};

					$li
						.attr("data-child", key)
						.addClass("element")
						.append(text+count[data.type])
						.on({
							click : function() {
								var idx = $(this).data("child");

								$(".element").removeClass("select");
								powerPoint.childSelectChange(idx);
							}
						});

					if(data.effect != undefined) {
						$li
							.append("<ul><li>"+this.EFFECT[data.effect]+"</li></ul>");
					};

					$element
						.attr("data-child", key)
						.draggable({
							containment : "parent",
							stop : function() {
								var idx = $(this).data("child"),
									child = powerPoint.getChildren(idx);

								child.left = parseInt($(this).css("left"));
								child.top = parseInt($(this).css("top"));

								powerPoint.itemSave();
							}
						})
						.on({
							click : function() {
								$("#shell *").removeClass("selected");

								var idx = $(this).data("child");

								powerPoint.childSelectChange(idx);
							}
						})
						.css({
							left : data.left+"px",
							top : data.top+"px",
						});

					if(data.type == "image") {
						$element
							.resizable({
								containment: "parent",
								stop : function() {
									var idx = $(this).data("child"),
										child = powerPoint.getChildren(idx);

									child.width = parseInt($(this).css("width"));
									child.height = parseInt($(this).css("height"));		

									powerPoint.itemSave();
								}
							})
							.css({
								width : data.width+"px",
								height : data.height+"px",
							});
					};

					if(data.select) {
						$element
							.addClass("selected");
						$li.addClass("select");

						powerPoint.selectChild = key;
					}

					$(".state > ul").append($li);
					$("#shell").append($element);
				});
			};
		});
	},

	itemSave () {
		var json = JSON.stringify(this.items);

		localStorage.setItem("item", json);
	},

	getChildren (idx = this.selectChild ) {
		return this.items[this.selectIdx].children[idx];
	},

	childSelectChange (idx) {
		var child = powerPoint.getChildren(powerPoint.selectChild);

		if(child != undefined)
			child.select = false;

		var child = powerPoint.getChildren(idx);
		child.select = true;

		powerPoint.itemLoad();
	}
}

var slideShow = {
	show() {
		this.item = powerPoint.items;
		this.idx = 0;
		this.child = -1;

		this.maxIdx = this.item.length - 1;

		$("#shell *").remove();

		$("#shell").on({
			click : function(e) {
				if($(this).hasClass("last")) {
					$(this).removeClass("last");

					document.webkitExitFullscreen();

					powerPoint.itemLoad();

					return false;
				}

				slideShow.nextChild();
			}
		})

		this.defaultShow();
	},

	defaultShow() {
		$("#shell *").remove();

		if(this.item[this.idx] == undefined) {
			$("#shell").addClass("last");

			return false;
		}

		$.each(this.item[this.idx].children, (idx, child) => {
			var type = "";

			if(child.effect == undefined)
				this.appendChild(child);
		});
	},

	appendChild(child, type = "view") {
		var $element;

		if(child.type == "image") {
			$element = $("<img>");

			$element
				.attr("src", child.src)
				.css({
					width : getPrt(child.width, 840)+"%",
					height : getPrt(child.height, 580)+"%",
				});
		} else {
			$element = $("<span></span>");

			$element
				.append(child.text)
				.css({
					fontSize : child.size+"px",
					color : child.color
				});
		};

		$element.css({
			left : getPrt(child.left, 840)+"%",
			top : getPrt(child.top, 580)+"%",
		});

		if(type != "view")
			$element.addClass(type+"effect");

		$("#shell").append($element);
	},

	nextChild() {
		var chk = false;
		$.each(this.item[this.idx].children, (idx, child) => {
			if(this.child < idx && child.effect != undefined) {
				chk = true;

				this.child = idx;
				this.appendChild(child, child.effect)

				return false;
			};
		});

		if(!chk) {
			this.idx++;
			this.child = -1;

			this.defaultShow();
		};
	}

}

var App = {
	init () {
		var item = powerPoint.items;

		if(localStorage.getItem("item") != undefined) {
			item = JSON.parse(localStorage.getItem("item"));
		};

		powerPoint.itemLoad(item);

		$(".font_size").html("<option selected value=''>글자 크기</option>");

		for (var i = 8; i <= 80; i += 2) {
			$(".font_size").append("<option value='"+i+"'>"+i+"pt</option>");
		};

		powerPoint.selectIdx = $(".slides div.select").data("idx");
		powerPoint.selectChild = $(".element.select").data("child");

		this.hook();
	},

	hook () {
		var self = this;

		$("a").off().on({
			click : function(e) {
				e.preventDefault();

				switch($(this).data("type")) {
					case "view":
						document.documentElement.webkitRequestFullscreen();
						slideShow.show();
						break;
					case "save":
						var div = $("<div></div>");

						div.append(`
							<h2>저장</h2>
							<input type="text" id='save_name' required/>
						`);

						div.dialog({
							buttons : {
								저장 : function() {
									var fileName = $("#save_name").val();

									var a = document.createElement("a");

									a.href = "data:text/json;charset=utf-8,";
									a.href += encodeURIComponent(JSON.stringify(powerPoint.items));

									a.download = fileName+".json";

									a.click();

									$(this).dialog("close");
								},
								닫기 : function() {
									$(this).dialog("close");
								}
							},
							close : function() {
								$(this).remove();
							}
						})
						break;
					case "load":
						$("#loadfile").val("");

						$("#loadfile").click();
						break;
				}
			}
		})

		$("#loadfile").on("change", function() {
			var file = $(this)[0].files[0];

			var reader = new FileReader();

			reader.onload = function(e) {
				var file = e.target.result;

				powerPoint.items = JSON.parse(file);

				powerPoint.itemLoad();
			};

			reader.readAsText(file);
		});

		$(".slide_add").off().on({
			click : function(e) {
				powerPoint.items.push({
					children : [
					],
					select : false,
					make : true,
				});

				powerPoint.itemLoad();
			}
		});

		$(".slide_delete").off().on({
			click : function(e) {
				if(powerPoint.items.length == 1) {
					alert("최소 한개의 슬라이드는 있어야 합니다.");
					return false;
				}

				var idx = powerPoint.selectIdx;

				powerPoint.items.splice(idx, 1);

				powerPoint.items[idx-1].select = true;

				$(".item[data-idx='"+idx+"']").addClass("delete effect");

				setTimeout(function() {
					powerPoint.itemLoad();
				}, 500);
			}
		});

		$(".image_add").off().on({
			click : function() {
				$("#file").val("");

				$("#file").click();
			}
		});

		$("#file").off().on({
			change : function() {
				var file = $(this)[0].files[0];

				if(file != undefined) {
					if(!imageChk(file))
						return false;

					imageUpload(file);
				}
			}
		});

		$(".item").off().on({
			click : function() {
				var previdx = powerPoint.selectIdx,
					idx = $(this).data("idx");

				powerPoint.selectIdx = idx;

				if(powerPoint.items[previdx] !== undefined)
					powerPoint.items[previdx].select = false;

				powerPoint.items[idx].select = true;
				powerPoint.selectChild = null;

				powerPoint.itemLoad();
			}
		});

		$(".text_add").off().on({
			click : function() {
				var chk = true;

				var data = {
					color : $(".font_color option:selected").val(),
					text : $(".font_text").val(),
					size : $(".font_size").val()
				};

				$.each(data, function(idx, el) {
					if(el == ""){
						alert("글자 내용, 글자 색, 글자 크기 모두 입력해 주세요.");
						chk = false;

						return chk;
					}
				})

				if(chk) {
					data.type = "text";
					data.left = 0;
					data.top = 0;

					powerPoint.items[powerPoint.selectIdx].children.push(data);
					powerPoint.itemLoad();
				};
 			}
		});

		$("#shell").off().on({
			"drop dragover" : function(e) {
				e.preventDefault();

				var file = e.originalEvent.dataTransfer.files[0];

				if(e.type == "drop") {
					if(file != undefined) {
						if(!imageChk(file))
							return false;

						imageUpload(file);
					}
				}
			}
		});

		$(".child_delete").off().on({
			click : function() {
				var item = powerPoint.items[powerPoint.selectIdx];

				if(item == undefined) {
					alert("요소를 선택해 주세요.");
					return false;
				}

				item.children.splice(powerPoint.selectChild, 1);
				powerPoint.itemLoad();
			}
		});

		$(".effect_add").off().on({
			click : function() {
				var effect = $(".effect_box option:selected").val(),
					child = powerPoint.getChildren();

				if(effect == "" || child == undefined) {
					if(effect == "")
						alert("효과를 선택해 주세요.");
					if(child == undefined)
						alert("요소를 선택해 주세요.");

					return false;
				};

				child.effect = effect;

				powerPoint.itemLoad();
			}
		})
	}
}

$(function() {
	App.init();
})

function getPrt(val, allVal) {
	return val / allVal * 100;
}

function imageChk ( file ) {
	var chk = true;

	if(file.type.match(/^image\/(png|jpg|jpeg)$/) == null) {
		chk = false;
		alert("파일은 이미지 파일 (png, jpg, jpeg) 만 가능합니다.");
	}

	return chk;
}

function imageUpload ( file ) {
	var image = new Image,

		canvas = document.createElement("canvas"),
		ctx = canvas.getContext("2d");

	image.onload = function() {
		if(image.width > 840)
			image.width = 839;

		if(image.height > 580)
			image.height = 579;

		canvas.width = image.width;
		canvas.height = image.height;

		ctx.drawImage(image, 0, 0);

		powerPoint.items[powerPoint.selectIdx].children.push({
			type : "image",
			src : canvas.toDataURL(),
			left : 0,
			top : 0,
			width : image.width,
			height : image.height,
		});

		powerPoint.itemLoad();
	};

	image.src = URL.createObjectURL(file);
}