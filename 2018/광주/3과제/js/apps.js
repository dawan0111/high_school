/* document javascript */

window.dd = console.log.bind(console);

/* 비동기식 애니메이션 */
function animation($target, effect, duration) {
	return new Promise(resolve => {
		$target.animate(effect, duration, () => {
			resolve();
		});
	});
};

/* 비디오 섬네일 만들기 */
function makeSomenail(file) {
	return new Promise(resolve => {
		var canvas = document.createElement("canvas");
		var ctx = canvas.getContext("2d");
		var video = document.createElement("video");

		canvas.width = 200;
		canvas.height = 180;

		video.onloadedmetadata = function(e) {
			video.currentTime = video.duration / 2;
		};

		video.ontimeupdate = function() {
			if(video.currentTime != 0) {
				ctx.drawImage(video, 0, 0, 200, 180);
				resolve(canvas.toDataURL("image/png"));
			};
		};

		video.src = URL.createObjectURL(file);
	});
}

/* 이미지 만들기 */
function getImage(image) {
	return typeof image[0] == "string" ? image[0] : URL.createObjectURL(image[0]);
};

/* indexed DB */
const DB = {
	open () {
		var request = indexedDB.open("database_134", 5);
		var deferred = $.Deferred();

		request.onupgradeneeded = (e) => {
			var db = e.target.result;
			db.createObjectStore("gallery", { keyPath: "idx", autoIncrement : true });
		};

		request.onsuccess = (e) => {
			this.db = e.target.result;
			deferred.resolve();
		};

		return deferred.promise();
	},

	table () {
		return this.db.transaction(["gallery"], "readwrite").objectStore("gallery");
	},
};

/* APP */
const App = {
	init () {
		$(".wow").each((idx, el) => {
			var $el = $(el);
			$el.css("transition", $el.data("wow-delay"));
		});

		$("a[href=#top]").attr("href", "#home");
		$(".wow").css("opacity", 0);
		$(".fadeInUp").css("transform", "translateY(30px)");
		$(".fadeInLeft").css("transform", "translateX(-30px)");
		$(".fadeInRight").css("transform", "translateX(30px)");
		$(".bounceIn").css("transform", "scale(.3)");
		$("header + nav").css({
			left : 0,
			top : 0,
		});
		$("input[type='email']").attr("type", "text");
		$("#home .element").html("");
		$("#portfolio h2").html(`<span>"YEOSU"</span> CITYTOUR`);

		$("textarea").attr({
			fixed : "off",
		}).css({
			wordBreak : "break-all",
			whiteSpace : "normal",
			resize : "vertical",
		});

		this.typingText = [
			'"안녕하세요. YEOSU T-STORY입니다."',
			'"YEOSU T-STORY를 방문하신 여러분을 환영합니다."',
			'"YEOSU T-STORY는 미향여수의 아름다움을 전하고자 제작되었습니다."',
		];
		this.typingCount = 0;
		this.loginToggle();
	},

	loginToggle () {
		var login = sessionStorage.getItem("login") || false;

		$(".mb-btn button").hide();

		if(login) {
			App.login = true;
			$(".logout-btn").show();
		} else {
			App.login = false;
			$(".login-btn, .join-btn").show();
		};
	},

	typingStart (duration) {
		var text = this.typingText[this.typingCount];
		var start = duration == 1 ? 0 : text.length;
		var len = text.length;
		var timer;

		timer = setInterval(() => {
			if(
				(duration == 1 && start == len) ||
				(duration == -1 && start == 0)
			) {
				if(duration == -1)
					this.typingCount = (this.typingCount + 1) % 3;

				this.typingStart(duration * -1);
				clearInterval(timer);
			};

			$("#home .element").html(text.substr(0, start));
			start += duration;
		}, duration == 1 ? 100 : 50);
	},

	scroll () {
		var scrollTop = $(window).scrollTop();
		var scrollBottom = scrollTop + $(window).height();

		$("header + nav").css("position", scrollTop != 0 ? "fixed" : "static");

		$(".wow").each((idx, el) => {
			var $el = $(el);
			var elTop = $el.offset().top;
			var elBottom = elTop + $(el).outerHeight();

			if($el.hasClass("fadeInUp")) {
				elTop -= 30;
				elBottom -= 30;
			};

			if(scrollBottom >= elTop && scrollTop <= elBottom) {
				this.scrollEffect($el);
			};
		});

		this.scrollMenu();
	},

	scrollMenu () {
		var scrollTop = $(window).scrollTop();

		$("nav ul li a").css("color", "");

		$("section[id]").each((idx, el) => {
			var top = $(el).offset().top;
			var bottom = top + $(el).outerHeight();

			if(bottom > scrollTop) {
				var id = $(el).attr("id");
				$("nav ul li a[href=#"+id+"]").css("color", "rgb(40, 167, 233)");
				return false;
			};
		});

		$("nav ul li a:hover").css("color", "#ff4e00");
	},

	scrollEffect ($element) {
		var delay = $element.data("wow-delay");
		var opacity = $element.css("opacity");
		var animation = $element.attr("class").split(" ").pop();

		switch(animation) {
			case "fadeIn":
				if(opacity == 1)
					return false;

				setTimeout(() => {
					$element.css("opacity", 1);
				}, ["0.9s", "1.6s"].includes(delay) ? 1000 : 500);
				break;
			case "bounceIn":
				if(opacity == 1)
					return false;

				setTimeout(() => {
					$element.css("opacity", 1);
				}, 100);
				setTimeout(() => {
					$element.css("transform", "scale(1.1)");
				}, 200);
				setTimeout(() => {
					$element.css("transform", "scale(0.9)");
				}, 600);
				setTimeout(() => {
					$element.css("transform", "scale(1)");
				}, 1000);
				break;
			default:
				setTimeout(() => {
					$element.css({
						transform : "translate(0, 0)",
						opacity : 1,
					});
				}, animation == "fadeInUp" ? 1000 : 500);
				break;
 		};
	},

	async loading () {
		this.load = true;

		$("body").append(`
			<div class='preloader'>
				<div class="sk-spinner-wave sk-spinner" style='transform: scale(.5)'>
					<div class="sk-rect1"></div>
					<div class="sk-rect2"></div>
					<div class="sk-rect3"></div>
					<div class="sk-rect4"></div>
					<div class="sk-rect5"></div>
				</div>
			</div>
		`);

		await DB.open();
		await this.galleryRefresh();

		this.init();

		setTimeout(() => {
			$(".preloader").fadeOut(500, () => {
				$(".preloader").remove();
			});
			this.typingStart(1);
			this.scroll();

			this.load = false;
		}, 2000);
	},

	galleryRefresh () {
		return new Promise(resolve => {
			DB.table().get(1).onsuccess = (e) => {
				var data = e.target.result;

				if(!data) {
					var images = [];
					$(".portfolio-thumb img").each((idx, el) => {
						images.push([$(el).attr("src")]);
					});

					DB.table().put({
						idx : 1,
						images : images,
					});

					resolve();
				} else {
					var view_image = data.images.slice(0, 8);
					var view_label = ["One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eignt"];

					$("#portfolio .col-md-3").remove();

					view_image.forEach((val, idx) => {
						var image = getImage(val);
						var play = val.length == 2 ? `<span style='font-size:40px; position: absolute; color:#000; left: 50%; top: 50%; transform: translate(-50%, -50%)'>▶</span>` : "";

						$("#portfolio .row").append(`
							<div class="col-md-3 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="0.6s" style='opacity: 0; transition: 0.6s ease;'>
							    <div class="portfolio-thumb" style='position:relative;'>
							    	${play}
							       <img src="${image}" class="img-responsive" alt="portfolio img 2">
							            <div class="portfolio-overlay">
							                <h4>CITYTOUR ${view_label[idx]}</h4>
							                <p>시민과 함께하는 해양 관광 휴양도시, 아름다운 여수의 밤바다와 힐링이 있는 그 곳. 오늘 여수는 당신에게 주는 선물입니다.</p>
							                <a href="#" class="btn btn-default">DETAIL</a>
							            </div>
							    </div>
							</div>
						`);
					});

					for (var i = view_image.length; i < 8; i++) {
						$("#portfolio .row").append(`
							<div class="no-image col-md-3 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="0.6s">
							    <h4 style='text-align:center;'>No Image</h4>
							    <div class="portfolio-thumb">
							    	<div class="portfolio-overlay">
							    	</div>
							    </div>
							</div>
						`);
					};

					resolve();
				};
			};
		});
	},
};

/* GALLERY */
const Gallery = {
	timer : null,

	open (idx) {
		$(".gallery-area").fadeIn(500);

		this.count = idx;
		this.refresh();
	},

	close () {
		$(".gallery-area").fadeOut(300);
	},

	refresh () {
		clearTimeout(this.timer);

		$(".img-list ul").html("");
		$(".now-img").html("");

		DB.table().get(1).onsuccess = (e) => {
			var images = e.target.result.images;
			var remove = App.login ? `<span class="gallery-remove">x</span>` : "";
			var len = images.length;

			images.forEach((image, idx) => {
				var len = image.length;
				var media = len == 2 ? URL.createObjectURL(image[1]) : getImage(image);
				var image = getImage(image);

				$(".img-list ul").append(`
					<li data-idx="${idx}">
					    <img src="${image}" alt="pt1">
					    ${remove}
					</li>
				`);

				if(len == 2) {
					$(".now-img").append(`<video src='${media}' alt='image' class='item' style='width:100%;height:100%;position:absolute;left:0;top:0;' controls></video>`);
				} else {
					$(".now-img").append(`<img src='${media}' alt='image' class='item'>`);
				};
			});

			this.page = 1;
			this.totalPage = Math.ceil(len / 8);
			this.totalCount = len;
			this.mediaList = images;

			if(this.totalCount <= this.count) {
				$(".now-img").append(`
					<div class='no-gallery-image' style='color:#000; width: 100%; height:100%; background:#fff; position: absolute; left: 0; top: 0; text-align:center; color:#000; font-size:70px; padding-top: 120px;'>NO Image</div>
				`);

				if(this.totalCount != 0) {
					this.count = -1;
					this.autoPlay();
				} else {
					$(".img-paging").hide();
				};
			} else {
				this.paging();
				this.autoPlay();
				this.effect();

				$(".img-paging").show();
			};
		};
	},

	paging () {
		var start = (this.page - 1) * 8;
		var end = (this.page) * 8;

		$(".img-list ul li").hide();

		for (var i = start; i < end; i++) {
			$(".img-list ul li").eq(i).show();
		};

		$(".now").html(this.page);
		$(".all").html(this.totalPage);
	},

	effect () {
		this.count %= this.totalCount;

		$(".now-img .item").css({
			"opacity" : 0,
			zIndex: 1,
		});
		$(".now-img .item").eq(this.count).css({
			"opacity" : 1,
			zIndex : 2,
		});

		$(".img-list ul li").removeClass("anishow");
		$(".img-list ul li").eq(this.count).addClass("anishow");

		$(".no-gallery-image").fadeOut(500);

		setTimeout(() => {
			$(".now-img .item").css("transition", "1s ease");
		}, 10);

		this.autoPlay();
	},

	async fileUpload (file) {
		if(!App.login) {
			alert("관리자만 사진 추가가 가능합니다.");
			return false;
		};
		if(!file) {
			alert("파일을 드래그 드롭해주세요");
			return false;
		};

		if(file.type.match(/^(image|video)\/.+$/) == null) {
			alert("이미지 혹은 비디오 파일을 드래그 드롭 해주세요.");
			return false;
		};

		var image = getImage([file]);
		var pushData = [file];

		if(file.type.match(/^video\/.+$/)) {
			image = await makeSomenail(file);
			pushData = [image, file];
		};

		this.mediaList.unshift(pushData);

		DB.table().put({
			idx : 1,
			images : this.mediaList,
		}).onsuccess = async (e) => {
			this.count = 0;
			this.refresh();

			await App.galleryRefresh();
			App.scroll();
		};
	},

	remove (idx) {
		this.mediaList.splice(idx, 1);

		DB.table().put({
			idx : 1,
			images : this.mediaList,
		}).onsuccess = async (e) => {
			this.count = 0;
			this.refresh();

			await App.galleryRefresh();
			App.scroll();
		};
	},

	pageMove (duration) {
		this.page += duration == "next" ? 1 : -1;

		this.page = this.page > this.totalPage ? this.totalPage : this.page;
		this.page = this.page < 1 ? 1 : this.page;

		this.paging();
	},

	autoPlay () {
		clearTimeout(this.timer);

		this.timer = setTimeout(() => {
			this.count++;
			this.effect();
		}, 3000);
	},
};

$(function() {
	App.loading();

	$(window).on("resize scroll", function() {
		if(!App.load)
			App.scroll();
	});

	$(document)
		.on("mouseenter mouseleave", "button, .btn, .social-icon a, #about .fa, #service .fa, .close-btn, .gallery-remove", function(e) {
			var color = e.type == "mouseenter" ? "rgb(40, 167 ,233)" : "";

			$(this).css({
				backgroundColor : color,
				borderColor : color,
				transition : "background-color .5s ease, border-color .5s ease",
			});
		})
		.on("mouseenter mouseleave", "nav ul li a", function() {
			App.scrollMenu();
		})
		.on("click", "a", function(e) {
			e.preventDefault();
		})
		.on("click", "nav ul li a", function() {
			var top = $($(this).attr("href")).offset().top;
			top += $("header + nav").css("position") == "fixed" ? 0 : -70;

			$("body, html").stop().animate({
				scrollTop : top
			}, 500);
		})
		.on("mouseover", "#about .fa", async function() {
			$(this).stop();

			await animation($(this), {marginTop : 60}, 400);
			await animation($(this), {marginTop : 0}, 100);
			await animation($(this), {marginTop : 30}, 200);
			await animation($(this), {marginTop : 0}, 50);

			if($(this).is(":hover")) {
				$(this).trigger("mouseover");
			};
		})
		.on('mouseenter', ".team-wrapper img", function() {
			$(this).parent().css({
				opacity : .5,
				transform : "translateY(-2px)",
			})
		})
		.on("mouseleave", ".team-wrapper", function() {
			$(this).css({
				opacity : 1,
				transform : "translateY(0px)",
			});
		})
		.on("mouseenter mouseleave", "#service .col-md-4", function(e) {
			var color = e.type == "mouseenter" ? "#505050" : "";
			$(this).css("background", color);
		})
		.on("mouseenter mouseleave", ".portfolio-overlay", function(e) {
			var bgColor = e.type == "mouseenter" ? "rgb(40, 167, 233, 0.5)" : "rgb(40, 167, 233, 0.5)";
			var textOpacity = e.type == "mouseenter" ? 0.5 : 0;

			$(this).css({
				opacity : textOpacity * 2,
				backgroundColor : bgColor,
				cursor : "pointer",
			});
			$(this).find("h4, p").css("opacity", textOpacity);
		})
		.on("click", ".portfolio-overlay", function(e) {
			var index = $(".portfolio-overlay").index($(this));
			Gallery.open(index);
		})
		.on("click", ".modal .login-btn", function() {
			var id = $("#userid").val();
			var pw = $("#pw").val();

			if(id == "admin" && pw == "1234") {
				alert("로그인이 완료되었습니다.");
				sessionStorage.setItem('login', "on");
				App.loginToggle();

				$(this).next().click();
			} else {
				alert("로그인에 실패하셨습니다.");
			};
		})
		.on("click", ".logout-btn", function() {
			sessionStorage.removeItem('login');
			App.loginToggle();

			alert("로그아웃이 완료되었습니다.");
		})
		.on("drop dragover", ".now-img, .img-list", function(e) {
			e.preventDefault();

			if(e.type == "drop") {
				var file = e.originalEvent.dataTransfer.files[0];
				Gallery.fileUpload(file);
			};
		})
		.on("click", ".next, .prev", function() {
			Gallery.pageMove($(this).hasClass("next") ? "next" : "prev");
		})
		.on("click", ".gallery-remove", function() {
			Gallery.remove($(this).parent().data("idx"));
		})
		.on("click", ".img-list ul li", function() {
			Gallery.count = $(this).data("idx");
			Gallery.effect();
		})
		.on("click", '.close-btn', function() {
			Gallery.close();
		})
		.on("submit", "#contact form", function(e) {
			e.preventDefault();

			var name = $("#fullname").val();
			var email = $("#email").val();
			var message = $("#message").val();

			if(name != "" && email != "" && message != "") {
				alert("메시지가 전송되었습니다.");
				$("body, html").stop().animate({scrollTop : 0}, 400);
				$("textarea").attr({
					"fixed" : "off",
					"rows" : 4,
				});

				return false;
			};
		})
		.on("dblclick", "#contact textarea", function(e) {
			var x = e.offsetX;
			var y = e.offsetY;
			var fixed = $(this).attr("fixed");
			var val = $(this).val();

			if($(this).width() < x && $(this).height() - 4 < y) {
				if(fixed == "off") {
					if(val == "") {
						$(this).attr({
							"rows" : 5,
							"fixed" : "on",
						}).css({
							"height" : "auto",
							overflowY : "auto",
						});
					} else {
						$(this).trigger("input");
					};
				} else {
					$(this).attr("fixed", "off");
					$(this).trigger("input");
				};
			};
		})
		.on("input", "#contact textarea", function() {
			if($(this).attr("fixed") == "on")
				return false;

			$(this).attr("rows", 1).css({
				height : "auto",
				overflowY : "hidden",
			});

			$(this).css("height", this.scrollHeight + 7);
		})
});
