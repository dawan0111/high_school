// JavaScript Document
// 
// 
//  2시간 15분
//  서버 환경에서 구동시켜 주세요.
//  
window.dd = console.log.bind(console);



var storage = new(function() {
	var db ,store;

	this.open = function(database, table) {
		var request = indexedDB.open(database, 6);

		request.onupgradeneeded = function(e) {
			var db = e.target.result;

			$.each(table, function(name, option) {
				db.createObjectStore(name, option);
			});
		}

		request.onsuccess = function(e) {
			db = e.target.result;
		}
	},

	this.table = function(table) {
		store = db.transaction([table], "readwrite").objectStore(table);

		return this;
	},

	this.put = function(data) {
		var dif = $.Deferred();

		store.put(data).onsuccess = function(e) {
			dif.resolve(e.target.result);
		};

		return dif.promise();
	},

	this.getAll = function(col, val) {
		var save = [],
			dif = $.Deferred();

		store.openCursor().onsuccess = function(e) {
			var cursor = e.target.result;

			if(cursor) {
				var value = cursor.value,
					chk = true;

				if(col != undefined) {
					if(value[col] != val)
						chk = false;
				};

				if(chk)
					save.push(value);

				cursor.continue();
			} else {
				dif.resolve(save);
			};
		};

		return dif.promise();
	}
})

storage.open("helloWedb", {
	group : {
		keyPath : "idx",
		autoIncrement : true,
	},
	media : {
		keyPath : "idx",
		autoIncrement : true,
	}
});

var Page = {
	file : [],

	pageMove : function(page) {
		$(".page").hide();
		$(".page"+page).show();
		$(".back_btn").hide();

		switch(page) {
			case 1:
				break;
			case 2:
				$(".back_btn").show();
				$(".page1").show();
				$("g").removeClass("hover");

				var infoData = App.placeInfo.filter(function(arr) {
					if(Page.place.replace("시", "") == arr.지역명)
						return arr;
				});
				var tourList = App.placeList.filter(function(arr) {
					if(Page.place.replace("시", "") == arr[0])
						return arr[1];
				});

				tourList = tourList[0];

				var $path = $("g#"+Page.place);
				var offset = $path[0].getBBox();

				var $path = $("g#"+Page.place).clone();

				$path.attr({
					transform : "translate(-"+offset.x+",-"+offset.y+")"
				});

				var $div = $("<div></div>");

				$.each(tourList[1], function(idx, arr) {
					var $line = $("<div></div>");

					$line.append("<b>"+arr[0]+"</b>");
					$line.append("<div>"+arr[1]+"</div><br>");

					$div.append($line);
				});

				$(".info_image svg").html($path);
				$(".info_text h1").html(infoData[0].지역명);
				$(".info_text div").html(infoData[0].소개);
				$(".tourList div").html($div);

				Page.drawGraph();
				Page.galleryLoad();

				$(".page1").hide();

				break;
		}
	},

	drawGraph : function() {
		var dates = ["201608", "201609", "201610", "201611", "201612", "201701", "201702", "201703", "201704", "201705"]

		var datas = [],
			type = $("#type option:selected").val();

		$.each(App.peoples, function(idx, people) {
			var total = 0;

			$.each(people, function(key, data) {
				if(data.지역명.split(" ")[1].match(Page.place) != null) {
					total += parseInt((""+data[type]).replace(/,/g, ""));
				};
			});

			datas.push(total);
		});

		var canvas = document.getElementById("canvas"),	
			ctx = canvas.getContext("2d");

		ctx.clearRect(0, 0, 9999, 9999);

		ctx.strokeStyle = ctx.fillStyle = "blue";
		ctx.lineWidth = 2;

		ctx.moveTo(0, 400);
		ctx.lineTo(1140, 400);
		ctx.stroke();

		ctx.beginPath();

		var max = Math.max.apply(null, datas);
		var prev = {};

		$.each(dates, function(idx, date) {
			idx = parseInt(idx);

			var x = 1140 / (dates.length - 0.7) * idx,
				prt = datas[idx] / max * 100,
				y = (400 - 400 / 100 * prt) + 20;

			var difX = 0;
			var difY = 0;

			ctx.fillStyle = "black";
			ctx.fillText(date, x, 430);
			ctx.fillText(datas[idx], x, y - 10);
			ctx.fillStyle = "blue";
			ctx.fillRect(x, y - 2.5, 5, 5);

			if(idx > 0) {
				ctx.moveTo(prev.x, prev.y);

				difX = x - prev.x;
				difY = y - prev.y;

				var cx = 2;

				ctx.bezierCurveTo(prev.x + (difX / cx), prev.y, x - (difX / cx), y, x, y);
				ctx.stroke();
				ctx.beginPath();
			};

			prev = {
				x : x,
				y : y,
				difX : difX,
				difY : difY
			};
		});
	},

	galleryLoad : function() {
		$(".gallery_content *").remove();

		storage.table("group").getAll("place", Page.place).done(function(idxs) {
			$.each(idxs, function(key, idx) {
				var groupBox = $("<div class='group_box'></div>");

				$(".gallery_content").append(groupBox);

				storage.table("media").getAll("groupIdx", idx.idx).done(function(medias) {;
					groupBox
						.attr({
							"data-idx" : idx.idx,
							"data-target" : "#viewer",
							"data-toggle" : "modal",
						})
						.append("<span>"+medias.length+"</span>");

					$.each(medias, function(k, media) {
						if(k == 0) {
							var url = URL.createObjectURL(media.file);

							if(media.file.type == "video/mp4") {
								var video = document.createElement("video"),

									canvas = document.createElement("canvas"),
									ctx = canvas.getContext("2d");

								canvas.width = canvas.height = 200;

								video.onloadedmetadata = function() {
									video.currentTime = video.duration / 2;
								};

								video.ontimeupdate = function() {
									ctx.drawImage(video, 0, 0, 200, 200);

									groupBox.find("img").remove();
									groupBox.append("<img src='"+canvas.toDataURL()+"' alt='이미지'>");
								};

								video.src = url;
							} else {
								var image = new Image;

								image.onload = function() {
									groupBox.append(image);
								};

								image.src = url;
							};
							return false;
						}
					});
				});
			});
		});
	}
}

var App = {
	init : function() {
		Page.pageMove(1);

		App.map.css({
			width : "1140px",
			height : "587px",
		});

		$(".page1").html(App.map);

		this.hook();
	},

	hook : function() {
		$("#Layer_1 g").on({
			mouseenter : function() {
				$(".label").remove();
				$("g").removeClass("hover");

				$(this).addClass("hover");

				var $label = $("<span class='label'></span>"),
					placeName = $(this).attr("id"),

					position = $(this)[0].getBBox();

				$label
					.attr({
						id : placeName,
					})
					.append(placeName)
					.css({
						left : (position.x + position.width / 2)+"px",
						top : (position.y + position.height / 2)+"px",
					});


				$(".page1").append($label);
			},
			click : function() {
				Page.place = $(this).attr("id");

				$(".label").remove();

				Page.pageMove(2);
			},
		});
		$("#Layer_1").on({
			mousemove : function(e) {
				if(e.target.tagName == "svg") {
					$("g").removeClass("hover");
					$(".label").remove();
				}
			},
		});
		$("#type").on({
			change : function() {
				Page.drawGraph();
			}
		});
		$(".back_btn").on({
			click : function() {
				Page.pageMove(1);
			}
		});
		$(".upload_btn").on({
			click : function() {
				Page.file = [];
			}
		});
		$(".add_btn").on({
			click : function() {
				var files = Page.file;

				if(files.length != 0) {
					storage.table("group").put({
						place : Page.place,
						type : "group",
					}).done(function(idx) {
						$.each(files, function(key, file) {
							storage.table("media").put({
								groupIdx : idx,
								file : file,
							}).done(function() {
								if(key + 1 == files.length)
									Page.galleryLoad();
							});
						});
					});
				} else {
					alert("파일은 DROP 부분에 넣어주세요.");
				}
			}
		})
		$(".dropbox").on({
			dragover: function(e) {
				e.preventDefault();
			},
			drop : function(e) {
				var files = e.originalEvent.dataTransfer.files,
					chk = true;

				$.each(files, function(idx, file) {
					if(file.type.match(/^(image\/(jpeg|png|gif)|video\/mp4)$/) == null) {
						chk = false;
					};
				});

				if(chk) {
					$.each(files, function(idx, file) {
						Page.file.push(file);
					});
				} else {
					alert("파일중에 이미지 또는 동영상이 아닌 파일이 존재합니다.");
				}

				e.preventDefault();
			}
		});
		$(document).on("mouseenter click", ".label", function(e) {
			var id = $(this).attr("id");

			if(e.type == "mouseenter") {

				$("g#"+id).addClass("hover");
			} else {
				Page.place = id;
				Page.pageMove(2);
			}
		});
		$(document).on("click", ".group_box", function(e) {
			$(".slide_item *").remove();

			var idx = $(this).data("idx");

			storage.table("media").getAll("groupIdx", idx).done(function(medias) {

				$.each(medias, function(idx, media) {
					var $item = $("<div class='item'></div>");

					if(idx == 0)
						$item.addClass("active");

					$(".slide_item").append($item);

					var url = URL.createObjectURL(media.file);

					if(media.file.type == "video/mp4") {
						var video = document.createElement("video");

						$(video).attr({
							controls : true,
						});

						video.onloadedmetadata = function() {
							$item.html(video);
						};

						video.src = url;

					} else {
						var image = new Image;

						image.onload = function() {
							$item.html(image);
						};

						image.src = url;
					};
				});
			});
		});
	}
}

$(function() {
	$.ajaxSetup({
		cache : false,
	});

	$.when(
		$.ajax({ url : "제공파일/인구/201608.json" }),
		$.ajax({ url : "제공파일/인구/201609.json" }),
		$.ajax({ url : "제공파일/인구/201610.json" }),
		$.ajax({ url : "제공파일/인구/201611.json" }),
		$.ajax({ url : "제공파일/인구/201612.json" }),
		$.ajax({ url : "제공파일/인구/201701.json" }),
		$.ajax({ url : "제공파일/인구/201702.json" }),
		$.ajax({ url : "제공파일/인구/201703.json" }),
		$.ajax({ url : "제공파일/인구/201704.json" }),
		$.ajax({ url : "제공파일/인구/201705.json" }),
		$.ajax({ url : "제공파일/문화재.txt", mimeType : "text/plain; charset=euc-kr"}),
		$.ajax({ url : "제공파일/지역소개.json" }),
		$.ajax({ url : "제공파일/jeju.svg" })
	).done(function() {
		var peoples = [];

		$.each(arguments, function(idx, arg) {
			arg = arg[0];

			switch(idx) {
				case 10:
					var placeList = arg.split("\r\n\r\n\r\n");

					placeList = placeList.map(function(arr) {
						var infoList = arr.split("\r\n\r\n"),
							returnData = [];

						returnData.push(infoList.shift());

						infoList = infoList.map(function(info) {
							return info.split("\r\n");
						});

						returnData.push(infoList);

						return returnData;
					});

					App.placeList = placeList;
					break;
				case 11:
					App.placeInfo = arg;
					break;
				case 12:
					App.map = $(arg).find("svg");
					break;
				default:
					peoples.push(arg);
					break;
			};
		});

		App.peoples = peoples;

		App.init();
	})
});

