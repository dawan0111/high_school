
/* document javascript */

window.dd = console.log.bind(console);

const ls = localStorage;

const App = {
	/*
		메인페이지 기본설정
	 */
	init () {
		this.scale = ls.getItem("scale") || 1;

		this.x = parseInt(ls.getItem("x")) || 0;
		this.y = parseInt(ls.getItem("y")) || 0;


		this.mainMap = $(".main__map")[0];
		this.mCtx = this.mainMap.getContext("2d");
		this.miniMap = $(".main__minimap")[0];
		this.sCtx = this.miniMap.getContext("2d");
		this.$wrap = $(".wrap__main");
		this.resizeImage = document.createElement("canvas");

		this.resizeImage.width = 360;
		this.resizeImage.height = 150;

		this.move = {
			state : false,
			sx : null,
			sy : null,
			cx : null,
			cy : null,
		};

		this.mapSetting();

		this.mapLoad();
	},

	/*
		현재 스케일에 맞는 맵을 고른다
	 */
	mapSetting () {
		var image = $(".x"+this.scale)[0];
		var rCtx = this.resizeImage.getContext("2d");

		rCtx.drawImage(image, 0, 0, 360, 150);

		if(image.height < this.$wrap.height()) {
			image.height = this.$wrap.height();
		};

		this.mainMap.width = image.width;
		this.mainMap.height = image.height;

		this.image = image;
	},
	/*
		좌표에 맞는 맵을 로드한다.
	 */
	mapLoad () {
		this.offsetChk();

		var x = this.x;
		var y = this.y;
		var r_w = this.prop(this.mainMap.width, this.$wrap.width(), 360);
		var r_h = this.prop(this.mainMap.height, this.$wrap.height(), 150);
		var r_x = this.prop(this.mainMap.width, this.x, this.miniMap.width);
		var r_y = this.prop(this.mainMap.height, this.y, this.miniMap.height);

		if(r_h > 150)
			r_h = 150;

		ls.setItem("x", x);
		ls.setItem("y", y);

		this.mCtx.clearRect(0, 0, 99999, 99999);
		this.sCtx.clearRect(0, 0, 99999, 99999);

		this.sCtx.globalAlpha = .5;

		this.mCtx.drawImage(this.image, -x, -y, this.mainMap.width, this.mainMap.height);
		this.sCtx.drawImage(this.resizeImage, 0, 0);

		this.sCtx.globalAlpha = 1;
		this.sCtx.drawImage(this.resizeImage, r_x, r_y, r_w, r_h, r_x, r_y, r_w, r_h);

		this.sCtx.rect(r_x, r_y, r_w, r_h);
		this.sCtx.strokeStyle = "red";
		this.sCtx.stroke();
		this.sCtx.beginPath();

		Marker.markerOffset();
	},
	/*
		이상한 좌표를 걸러준다.
	 */
	offsetChk () {
		var wrapWidth = this.$wrap.width();
		var wrapHeight = this.$wrap.height();

		// dd(this.x, this.x < 0, this.move);

		if(this.x + wrapWidth > this.mainMap.width) {
			this.x = (this.mainMap.width - wrapWidth);
		};

		if(this.y + wrapHeight > this.mainMap.height) {
			this.y = (this.mainMap.height - wrapHeight);
		};

		if(this.x < 0) {
			this.x = 0;
		};

		if(this.y < 0) {
			this.y = 0;
		};
		
	},
	/*
		스케일을 바꾼다.
	 */
	scaleChange (scale, x, y) {
		var prev = this.scale;

		if(scale < 0) {
			this.scale *= 2;
		} else {
			this.scale /= 2;
		};

		if(this.scale > 4)
			this.scale = 4;

		if(this.scale < 1)
			this.scale = 1;

		if(prev != this.scale) {
			var downX = x + this.x;
			var downY = y + this.y;

			var xPrt = this.prop(this.mainMap.width, 100, downX);
			var yPrt = this.prop(this.mainMap.height, 100, downY);

			ls.setItem("scale", this.scale);

			this.move.state = false;
			this.mapSetting();

			/*
				전체 움직인 거리에서
				마우스 좌표만큼만 빼준다.
			 */	

			var x = this.mainMap.width / 100 * xPrt - x;
			var y = this.mainMap.height / 100 * yPrt - y;

			this.x = x;
			this.y = y;

			this.mapLoad();
		};
	},

	prop (x1, x2, y1) {
		return x2 * y1 / x1;
	},
};

const Marker = {
	/*
		맵 마커 설정
	 */
	init () {
		this.earth = [];
		this.island = [];

		this.activeEarth = [];

		$.ajax({
			url : "data/information.json",
			dataType : "json",
			success : (e) => {
				this.list = e.districts;


				$.each(this.list, (idx, data) => {
					this.earth.push(data);
					this.island.push(...data.islands);
				});

				this.listLoad();
				this.markerLoad();
				this.markerOffset();
			},
		});
	},

	/*
		마커를 화면에 보인다.
	 */
	markerLoad () {
		$.each(this.island, (idx, data) => {
			var {x, y} = data.position;

			var image = $("<img />", {
				class : "marker",
				src : "imgs/marker.png",
				css : {
					position : "absolute",
					width : "14px",
				},
				x,
				y,
				idx
			});

			$(".wrap__main").append(image);
		});
	},

	/*
		해당 마커로 이동한다.
	 */
	animation (idx) {
		var island = this.island.filter(x => x.idx == idx)[0];

		var image = $(".x1")[0];
		var {width, height} = image;

		var left = App.prop(width, island.position.x, App.mainMap.width) - App.$wrap.width() / 2;
		var top = App.prop(height, island.position.y, App.mainMap.height) - App.$wrap.height() / 2;

		this.$ani = $("<i>");

		this.$ani
			.css({
				left : App.x,
				top : App.y
			})
			.animate({
				left : left,
				top : top
			}, {
				duration : 1000,
				step : (now, type) => {
					App[type.prop == "left" ? "x" : "y"] = now;
					App.mapLoad();
				},
			})

		this.active = island;
		this.viewPopup(left, top, island);
	},

	/*
		팝업창을 띄운다.
	 */
	viewPopup (left, top, island = null) {
		if(island != null) {
			var like = JSON.parse(ls.getItem("like"));

			$(".marker").css("transform", "scale(1)");
			$(".marker[idx="+island.idx+"]").css("transform", "scale(2)");

			$(".title__text--big").html(island.name);
			$(".title__favorite")
				.attr("data-idx", island.idx)
				.removeClass("fa far shine")
				.addClass(like.includes(island.idx) ? "fa shine" : "far");

			$(".box__img").attr("src", island.img);
			$(".box__location").html(island.location);
			$(".area__text").html(island.area+"㎢");
			$(".population__text").html(island.population);
			$(".box__note").html(island.note);
		};

		$(".main__box").show();

		var popup_left = left - 250;
		var popup_top = top;
		var popup_right = popup_left + 500 + App.x;
		var org_left = popup_left + App.x;

		if(top > App.$wrap.height () / 2 - 50) {
			popup_top -= 10 + $(".main__box").height();
		} else {
			popup_top += 60;
		};

		if(popup_left < 0 && org_left < 0) {
			popup_left += org_left * -1 + 20;
		};

		if(popup_right > App.mainMap.width) {
			popup_left += App.mainMap.width - popup_right - 20;
		};

		$(".main__box").css({
			left : popup_left,
			top : popup_top,
		})
	},

	/*
		리스트를 다시 불러온다.
	 */
	listLoad () {
		$(".list__ele, .drop__list").remove();
		var likes = JSON.parse(ls.getItem("like"));

		$.each(this.earth, (idx, el) => {
			var style = "display:none";
			var className = "fa-caret-down";

			if(this.activeEarth.includes(el.idx)) {
				style = "display:block";
				className = "fa-caret-up";
			};

			$(".sideBar__list").append(`
				<li class="list__ele" data-idx='${el.idx}'>
					<div class="ele__title">
						<span class="title__text">${el.name}</span>
						<i class="title__toggle fa ${className}"></i>
					</div>
					<div class="ele__drop" data-idx='${el.idx}' style='${style}'>
					</div>
				</li>
			`);

			$.each(el.islands, (idx, island) => {
				var starClass = "far fa-star";

				if(likes.includes(island.idx)) {
					starClass = "fa fa-star shine";

					$(".favorite__drop").append(`
						<div class="drop__list" data-idx='${island.idx}'>
							<span class="list__title">${island.name}</span>
							<i class="list__star fa fa-star shine" data-idx='${island.idx}'></i>
						</div>
					`);
				};

				$(".ele__drop[data-idx="+el.idx+"]").append(`
					<div class="drop__list" data-idx='${island.idx}'>
						<span class="list__title">${island.name}</span>
						<i class="list__star ${starClass}" data-idx='${island.idx}'></i>
					</div>
				`);
			});
		});
	},

	/*
		좌표에 맞는 마커 위치 이동
	 */
	markerOffset () {
		var image = $(".x1")[0];
		var {width, height} = image;

		$(".marker").each((idx, el) => {
			var left = App.prop(width, $(el).attr("x"), App.mainMap.width) - 7;
			var top = App.prop(height, $(el).attr("y"), App.mainMap.height) - 12;

			left -= App.x;
			top -= App.y;

			$(el).css({
				left,
				top
			});
		});

		if(this.active) {
			var $marker = $(".marker[idx="+this.active.idx+"]");
			var offset = $marker.position();

			this.viewPopup(offset.left, offset.top);
		};
	},
};

$.ajaxSetup({
	cache : false,
});

$.when(
	$.ajax({ url : "imgs/maps/6.4.png" }),
	$.ajax({ url : "imgs/maps/3.2.png" }),
	$.ajax({ url : "imgs/maps/1.6.png" })
).done(() => {
	if(!ls.getItem("like")) {
		ls.setItem("like", JSON.stringify([]));
	};

	App.init();
	Marker.init();
	/* 이벤트 */
	$(document)
		.on("mousedown mouseup mousemove", "body, .main__minimap", function(e) {
			var x = e.pageX;
			var y = e.pageY;
			var move = App.move;

			var type = $(this).hasClass("main__minimap") ? "mini" : "main";

			if(type == "mini")
				e.stopPropagation();

			switch(e.type) {
				case "mousedown":
					if(Marker.$ani)
						Marker.$ani.stop();

					if(type == "mini") {
						var r_w = App.prop(App.mainMap.width, App.$wrap.width(), 360);
						var r_h = App.prop(App.mainMap.height, App.$wrap.height(), 150);

						App.x = App.prop(360, e.offsetX - r_w / 2, App.mainMap.width);
						App.y = App.prop(150, e.offsetY - r_h / 2, App.mainMap.height);

						App.mapLoad();
					};

					move.state = true;
					move.type = type;
					move.sx = x;
					move.sy = y;
					move.cx = App.x;
					move.cy = App.y;
					break;
				case "mousemove":
					if(move.state) {
						var moveX = x - move.sx;
						var moveY = y - move.sy;

						if(move.type == "main") {
							App.x = move.cx - moveX;
							App.y = move.cy - moveY;
						} else {
							App.x = move.cx + App.prop(360, moveX, App.mainMap.width);
							App.y = move.cy + App.prop(150, moveY, App.mainMap.height);
						};

						App.mapLoad();
					};
					break;
				case "mouseup":
					var moveX = x - move.sx;
					var moveY = y - move.sy;

					if(moveX == 0 && moveY == 0 && $(e.target).hasClass("main__map")) {
						$(".marker").css("transform", "scale(1)");
						$(".main__box").hide();
						Marker.active = false;
					};

					move.state = false;
					break;
			};
		})
		.on("mousewheel", ".main__map", function(e) {
			var offset = $(this).offset();

			var x = e.pageX - offset.left;
			var y = e.pageY - offset.top;

			App.scaleChange(e.originalEvent.deltaY, x, y);
		})
		.on("click", ".list__ele", function() {
			var idx = $(this).data("idx");
			var earchActive = Marker.activeEarth;

			if(earchActive.includes(idx)) {
				var index = earchActive.indexOf(idx);
				earchActive.splice(index, 1);
			} else {
				earchActive.push(idx);
			};

			Marker.listLoad();
		})
		.on("click", ".favorite__title", function() {
			$(".favorite__drop").toggle();

			$(this).find(".title__toggle").toggleClass("fa-flip-vertical");			
		})
		.on("click", ".drop__list", function(e) {
			Marker.animation($(this).data("idx"));
			e.stopPropagation();
		})
		.on("click", ".fa-star", function(e) {
			var idx = $(this).data("idx");
			var like = JSON.parse(ls.getItem("like"));

			$(".fa-star[data-idx="+idx+"]").toggleClass("shine");

			$(this).removeClass("far fa");

			if($(this).hasClass("shine")) {
				$(this).addClass("fa");
				like.push(idx);
			} else {
				$(this).addClass("far");
				var index = like.indexOf(idx);
				like.splice(index, 1);
			};

			ls.setItem("like", JSON.stringify(like));
			Marker.listLoad();

			e.stopPropagation();
		})
		.on("click", ".marker", function() {
			var list = Marker.island.filter(x => x.idx == $(this).attr("idx"))[0];
			var offset = $(this).position();

			Marker.active = list;

			Marker.viewPopup(offset.left - 2, offset.top - 20, list);
			Marker.markerOffset();
		})

	$(window)
		.on("resize", function() {
			App.mapLoad();
		})
});