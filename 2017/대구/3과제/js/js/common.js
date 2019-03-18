// common.js

/*
	ajax 로 json 파일을 불러와 cors 조건에 맞춰야 합니다. 서버환경에서 돌려주세요.
 */

window.dd = console.log.bind(console);
/* indexedDB */
var Storage = {
	open : function(database, table) {
		var request = indexedDB.open(database, 5),
			self = this,
			def = $.Deferred();

		request.onupgradeneeded = function(e) {
			var db = e.target.result;

			$.each(table, function(name, option) {
				option = option || {keyPath : "index", autoIncrement : true};
				var dos = db.createObjectStore(name, option);

				dos.createIndex("index", "index");
			});
		};

		request.onsuccess = function(e) {
			self.db = e.target.result;
			def.resolve();
		};

		return def.promise();
	},
	table : function(table) {
		return this.db.transaction([table], "readwrite").objectStore(table);
	}
}
/*  popup Effect  */
var Effect = {
	open : function(classname) {
		dd(classname);

		$("body").css("overflow", "hidden");

		$(".bg").stop().animate({"height" : "100vh", opacity : 1}, 500, function(e){
			$("."+classname).show();
		});

		this.classname = classname;
	},
	close : function(classname) {
		$("body").css("overflow", "auto");

		classname = classname || this.classname;

		$("."+classname).hide(function(){
			$(".bg").stop().animate({"height" : 0, opacity : 0}, 500);
		});
	}
}

/* main Model */
var App = {
	/* 기본 설정 */
	init : function(type) {
		var self = this;

		$("#search").val(localStorage.getItem("search") || "");

		Storage.table("data").getAll().onsuccess = function(e) {
			self.datas = e.target.result;

			if(type == "first") {
				self.hook();
			};
			self.filterDataSet();
			self.appendData(0, localStorage.getItem("limit") || 3);

			$(window).scrollTop(localStorage.getItem("scroll") || 0);
		};

		this.viewUpdate();

		loginChange();
	},
	/* 걸러진 데이터 설정하기 */
	filterDataSet : function() {
		$(".view-box").remove();
		$(window).scrollTop(0);

		var category = localStorage.getItem("category") || "",
			search = localStorage.getItem("search") || "";

		filterData = this.datas.filter(function(data) {
			var error = false;

			if(category != "" && data.categories != category)
				error = true;

			if(search != "" && data.name.indexOf(search) == -1)
				error = true;

			return !error;
		});

		App.filterData = filterData;	
	},
	/* 데이터 화면에 보여주기 */
	appendData : function(start, end) {
		var appendDatas = this.filterData.slice(start, end);

		$.each(appendDatas, function(idx, data) {
			var $div = $("<div></div>", {
				class : "col-md-12 feeds box view-box",
			});

			$div.append(`
				<div class='feed_image'>
					<img src='images/${data.image}' alt='이미지'>
				</div>
				<div class="feed_con">
					<h1>${data.name}</h1>
					<div class='line'></div>
					<p>${data.info}</p>
					<h3>업데이트 날짜 : ${data.date}</h3>
					<h3>카테고리 : ${data.categories}</h3>
					<div>
						<button class='more-view' data-idx="${data.index}">더 보기</button>
					</div>
				</div>
			`);

			$(".newsfeed .row").append($div);
		});
	},
	/* 업데이트 내역 보기 */
	viewUpdate : function() {
		Storage.table("update").getAll().onsuccess = function(e) {
			var datas = e.target.result;

			$(".update_list li").remove();

			$.each(datas, function(idx, data) {
				var $li = $("<li></li>", {
					attr : {
						"data-idx" : data.pidx,
					},
				});

				$li.append(`
					[${data.name}]의 정보가 수정되었습니다.
					<span>${data.date}</span>
				`);

				$(".update_list").append($li);
			});
		}
	},
	/* 이벤트 */
	hook : function() {
		// Popup Event
		// login
		$(".login_btn").click(function(e){
			Effect.open("login");
		});
		// join
		$(".join_btn").click(function(e){
			Effect.open("join");
		});
		// more
		$(".more_view").click(function(e){
			Effect.open("view");
		});
		// modi_view
		$(".modi_view").click(function(e){
			Effect.open("modi");
		});
		$(".bg span").click(function(e){
			Effect.close();
		});
		// page scroll 
		$(window).scroll(function() {
			var scroll = $(window).scrollTop();

			localStorage.setItem("scroll", scroll);

			if($(document).height() == scroll + $(window).height()) {
				var limit = parseInt(localStorage.getItem("limit")) + 3 || 6;

				var totalPage = Math.ceil(App.filterData.length / 3),
					nowPage = Math.ceil(limit / 3);

				if(nowPage <= totalPage) {
					$(".loading").show();
					$("body").css("overflow", "hidden");

					setTimeout(function() {
						$(".loading").hide();
						$("body").css("overflow", "auto");

						localStorage.setItem("limit", limit);
						App.appendData(limit-3, limit);
					}, 1000);
				};
			};
		});
		$(".categories li").on({
			click : function() {
				var category = $(this).text().trim();

				localStorage.setItem("category", category);
				localStorage.setItem("limit", 3);

				App.filterDataSet();
				App.appendData(0, 3);
			},
		});
		$(joinForm).on({
			submit : function(e) {
				e.preventDefault();
				var data = changeFormFormat($(this).serializeArray()),
					message = [];

				$.each(data, function(name, val) {
					if(val == "") {
						var label = $("#jo_"+name).prev().text().replace(" : ", "");

						if(label != "")
							message.push(label+"을(를) 입력해 주세요.");
					} else {
						switch(name) {
							case "name":
								if(val.match(/^[ㄱ-ㅎ가-힣ㅏ-ㅣ]+$/) == null)
									message.push("이름은 반듯이 한글만 사용가능합니다.");
								break;
							case "phone":
								if(val.match(/^[0-9]+$/) == null)
									message.push("전화번호는 숫자만 사용가능합니다.");
								break;
						};
					};
				});

				if(data.pw != data.pwchk)
					message.push("비밀번호와 비밀번호확인이 상이합니다.");

				Storage.table("member").getAll().onsuccess = function(e) {
					var datas = e.target.result;

					var idoverLap = datas.filter(function(arr) {
						return data.id == arr.id;
					});

					if(idoverLap.length) {
						message.push("중복하는 아이디 입니다.");
					};

					if(!message.length) {
						Storage.table("member").put({
							id : data.id,
							pw : data.pw,
							name :data.name,
							phone : data.phone
						}).onsuccess = function() {
							alert("회원가입이 완료되었습니다.");
							Effect.close();
						};
					} else {
						alert(message.join("\r"));
					};
				}
			}
		});
		$(loginForm).on({
			submit : function(e) {
				e.preventDefault();
				var login = changeFormFormat($(this).serializeArray());

				Storage.table("member").getAll().onsuccess = function(e) {
					var datas = e.target.result,
						loginChk = false;

					$.each(datas, function(idx, data) {
						if(data.id == login.id && data.pw == login.pw) {
							loginChk = data;
							return false;
						};
					});

					if(loginChk) {
						sessionStorage.setItem("login", JSON.stringify(loginChk));	
						loginChange();

						alert("로그인이 완료되었습니다.");
						Effect.close();

					} else {
						alert("존재하지 않는 아이디 이기나 비밀번호를 잘못입력 하셨습니다.");
					};
				};
			},
		});
		$(".logout_btn").on({
			click : function() {
				sessionStorage.removeItem("login");
				alert("로그아웃이 완료되었습니다.");

				loginChange();
			}
		});
		$(searchForm).on({
			submit : function(e) {
				e.preventDefault();
				var search = $("#search").val();

				if(search == "") {
					alert("검색값을 입력해주세요.");
					return false;
				}

				$(".auto").html("");

				localStorage.setItem("category", "");
				localStorage.setItem("search", search);
				localStorage.setItem("limit", 3);

				App.filterDataSet();
				App.appendData(0, 3);
			},
		});
		$(search).on({
			input : function() {
				var search = $(this).val();
				var autoSearch = [];

				$.each(App.datas, function(idx, data) {
					if(data.name.indexOf(search) != -1 && search != "") {
						autoSearch.push(data.name);
					};
				});

				autoSearch = autoSearch.map(function(arr) {
					return "<div>"+arr+"</div>";
				});

				$(".auto").html(autoSearch.join(""));
			}
		});
		$(document).on({
			click : function() {
				var text = $(this).text().trim();

				$("#search").val(text).trigger("input");
			},
		}, ".auto > div");
		$(document).on({
			click : function() {
				var idx = $(this).data("idx");

				More.open(idx);
				Effect.open("view");

			},
		}, ".more-view");
		$(commentForm).on({
			submit : function(e) {
				e.preventDefault();
				var comment = $(".comment-content").val(),
					date = new Date();

				$(".comment-content").val("");

				Storage.table("comment").put({
					content : comment,
					pidx : More.idx,
					date : getDate(),
					realDate : date,
					id : App.login.id,
					name : App.login.name,
				}).onsuccess = function(e) {
					More.getComment();
				};
			}
		});
		$(document).on({
			click : function() {
				var idx = $(this).data("idx");

				Storage.table("comment").delete(idx).onsuccess = function() {
					More.getComment();
				};
			}
		}, ".delete");
		$(".modify").on({
			click : function() {
				Effect.close();
				setTimeout(function() {
					Effect.open("modi");
					Modi.open();
				}, 1000);
			},
		});
		$(modiForm).on({
			submit : function(e) {
				e.preventDefault();
				var data = changeFormFormat($(this).serializeArray()),
					orgData = $.extend({}, More.viewData);

				if(data.name != orgData.name || data.info != orgData.info) {
					orgData.name = data.name;
					orgData.info = data.info;
					orgData.date = getDate();

					Storage.table("data").put(orgData).onsuccess = function() {
						dd("test");
						Storage.table("update").put({
							name : More.viewData.name,
							date : getDate(),
							pidx : orgData.idx,
						}).onsuccess = function() {
							Effect.close();
							App.init();
						};
					};
				} else {
					alert("수정된 내용이 없습니다.");
				};
			}
		})
		$(document).on({
			click : function() {
				More.open($(this).data("idx"));
				Effect.open("more-view-modal");
			},
		}, ".update_list li");
	}
}
/* 더보기 */
var More = {
	open : function(idx) {
		this.idx = idx;
		var self = this;

		Storage.table("data").index("index").get(idx).onsuccess = function(e) {
			var data = e.target.result;

			$(".more_image img").attr("src", "images/"+data.image);
			$(".more_content h1").html(data.name);
			$(".more_content p").html(data.info);
			$(".more_content h3").html("카테고리 : "+data.categories);

			self.viewData = data;
		};

		this.getComment();
	},
	getComment : function() {
		var idx = this.idx;

		$(".comment-list").html("");

		Storage.table("comment").getAll().onsuccess = function(e) {
			var comments = e.target.result;

			comments = comments.filter(function(comment) {
				if(comment.pidx == idx)
					return true;
			});

			comments = comments.sort(function(a, b) {
				return b.realDate.getTime() - a.realDate.getTime();
			})

			$.each(comments, function(idx, comment) {
				var $div = $("<div></div>");

				$div.append(`
					<p>${comment.content}</p>
					<p>${comment.name}</p>
					<p>${comment.date.split(" ")[0]}</p>
				`);

				if(App.login ||comment.id == App.login.id) {
					$div.append(`<p class='delete' data-idx='${comment.index}'>삭제</p>`);
				} else {
					$div.append("<p></p>");
				};

				$(".comment-list").append($div);
			});
		};
	}
}
/* 수정창 */
var Modi = {
	open : function() {
		Storage.table("data").index("index").get(More.idx).onsuccess = function(e) {
			var data = e.target.result;

			$("#modiForm input").val(data.name);
			$("#modiForm textarea").val(data.info);
		};
	}
}

$(function(){
	$.ajaxSetup({
		cache : false,
	});

	$.when(
		Storage.open("jejuwekiOTL", {
			data : false,
			member : false,
			comment : false,
			update : false,
		})
	).done(function() {
		var firstPage = !localStorage.getItem("visit") ? true : false;

		if(firstPage) {
			var dataLoad = firstDataLoad();
			var memberLoad = putAdmin();

			$.when(dataLoad, memberLoad).done(function() {
				App.init("first");
				localStorage.setItem("visit", true);
			});
		} else {
			App.init("first");
		};
	});
});

/* 로그인 비 로그인 관리자 변경 */
function loginChange() {
	var login = sessionStorage.getItem("login") || false;

	$(".login-hide").hide();

	if(login) {
		App.login = JSON.parse(login);
		$(".yes-login").show();

		if(App.login.id == "admin")
			$(".modify").show();
	} else {
		App.login = false;
		$(".no-login").show();
	};
}
/* 첫 페이지 로드 */
function firstDataLoad () {
	var def = $.Deferred();

	Storage.table("data").clear().onsuccess = function() {
		$.ajax({
			url : "/data/information.json",
			success : function(datas) {
				var count = 0;

				$.each(datas.information, function(idx, data) {
					data.date = getDate();

					Storage.table("data").put(data).onsuccess = function(e) {
						count++;

						if(datas.information.length == count)
							def.resolve();
					};
				});
			}
		});
	};

	return def.promise();
}
/* 첫 관리자 계정 넣기 */
function putAdmin() {
	var def = $.Deferred();

	Storage.table("member").put({
		id : "admin",
		pw : "1234",
		name : "어드민",
		admin : true,
	}).onsuccess = function() {
		def.resolve();
	};

	return def.promise();
}
function getDate() {
	var d = new Date();

	return d.getFullYear()+"-"+zero(d.getMonth()+1)+"-"+zero(d.getDate())+" "+zero(d.getHours())+":"+zero(d.getMinutes());
}
function changeFormFormat(data) {
	var result = {};

	$.each(data, function(idx, val) {
		result[val.name] = val.value;
	});

	return result;
}
function zero(n) {
	return n < 10 ? "0"+n : n;
}