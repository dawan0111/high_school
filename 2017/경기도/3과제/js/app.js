window.dd = console.log.bind(console);

var Storage = {
	open : function(database, table) {
		var request = indexedDB.open(database, 5);
		var self = this;
		var def = $.Deferred();

		request.onupgradeneeded = function(e) {
			var db = e.target.result;

			$.each(table, function(name, option) {
				if(option == null)
					option = {keyPath : "idx", autoIncrement : true};

				var obs = db.createObjectStore(name, option);

				obs.createIndex("idx", "idx");
			});
		}

		request.onsuccess = function(e) {
			self.db = e.target.result;
			def.resolve();
		}

		return def.promise();
	},

	table : function(table) {
		return this.db.transaction([table], "readwrite").objectStore(table);
	},
}

var Upload = {
	file : [],
	filename : [],

	addFile : function(file) {
		var self = this;
		var image = new Image;

		image.onload = function() {
			if($.inArray(file.name, self.filename) == -1) {
				$("#imageBox").append(file.name+"<br>");

				self.file.push(file);
				self.filename.push(file.name);
			};
		};

		image.src = URL.createObjectURL(file);
	},
}

var Folder = {
	nowTab : false,
	/* 초기설정 */
	init : function() {
		this.$path = $(".path").eq(0).clone();
		this.$folder = $(".folder-li").clone();
		this.$file = $(".file-li").clone();
		this.$tab = $(".editor-tab > div").eq(0).clone();

		this.moveFolder(["/"]);
		this.hook();
	},
	/* 폴더 이동 */
	moveFolder : function(route) {
		this.route = route;

		this.changeDirPath();
		this.viewFolder();
	},
	/* 페스 바꾸기 */
	changeDirPath : function() {
		$(".path").remove();
		for(var i in this.route) {
			if(i == 0)
				continue;

			var $path = this.$path.clone();

			$path
				.attr("prev", parseInt(i)+1)
				.find(".text").html(this.route[i]);

			if(this.route.length - 1 == i) {
				$path.find(".right-btn").remove();
				$path.find(".text").removeClass("prev");
			};

			$(".dirPath").append($path);
		};
	},
	/* 폴더에 있는 파일목록 보기 */
	viewFolder : function() {
		var children = this.getChildren(this.route);
		var self = this;

		if(this.route.length == 1) {
			$(".parent-li").hide();
		} else {
			$(".parent-li").show();
		};

		$(".append-li").remove();

		$.each(children, function(name, child) {
			var element = child.type == "folder" ? self.$folder : self.$file;
			element = element.clone();

			element
				.addClass(child.type+"-li")
				.attr({
					name : name,
				})
				.find("a").html(name);

			element.draggable({
				revert : true,
			});

			$("."+child.type+"-ul").append(element);
		});

		$(".folder-ul li").not(".title").droppable({
			drop : function(e, ui) {
				var dragItem = ui.draggable;
				var dropFolder = $(this);
				var folderName = dropFolder.attr("name");
				var dragName = dragItem.attr("name");
				var overlap;

				if(folderName != "..") {
					overlap = Folder.overlapChk(Folder.nowChildren[folderName].children, dragName);
				} else {
					var parentChild = Folder.getChildren(Folder.route.slice(0, -1));
					overlap = Folder.overlapChk(parentChild, dragName);
				};

				if(overlap == "undefined") {
					var tmp_file = Folder.nowChildren[dragName];

					if(folderName != "..") {
						Folder.nowChildren[folderName].children[dragName] = tmp_file;
					} else {
						parentChild[dragName] = tmp_file;
					};

					delete Folder.nowChildren[dragName];

					Folder.update();
					Folder.viewFolder();
				} else {
					alert("옴기려는 폴더에 같은 이름의 폴더 혹은 파일이 있습니다.");
				};
			}
		});

		this.nowChildren = children;
		this.tabRefresh();
	},
	/* 폴더 경로를 주면 그 경로에 있는 파일이나 폴더를 가져온다 */
	getChildren : function(route) {
		var children = this.folder;

		for(var i in route) {
			children = children[route[i]].children;
		};

		return children;
	},
	getPath : function() {
		var name = [];

		for(var i in this.route) {
			if(i == 0)
				continue;

			name.push(this.route[i]);
		};

		return name.join("/");
	},
	/* 중복되는 이름 체크 */
	overlapChk : function(children, name) {
		return typeof children[name];
	},
	/* 파일 혹은 폴더 생성 이름 제한 */
	nameChk : function(name) {
		if(name.charAt(0) == "." || name.match(/\s/g) != null) {
			alert("폴더 이름은 .문자로 시작할수 없고 공백이여서는 안됩니다.");
			return false;
		} else {
			return true;
		};
	},
	/* local 에 저장 */
	update : function() {
		Storage.table("folder").put(this.folder);
	},
	/* 편집기 탭 가져오기 */
	tabRefresh : function() {
		var tabs = this.findTab(["/"], []);
		var self = this;

		$(".editor-tab > div").remove();

		tabs.sort(function(a, b) {
			return a.order > b.order;
		});

		$.each(tabs, function(idx, tab) {
			self.tabAppend(tab, idx);
		});

		this.tabs = tabs;
	},
	/* 열려있는 파일찾기 */
	findTab : function(route, result) {
		var children = this.getChildren(route);
		var self = this;

		$.each(children, function(idx, child) {
			if(child.type == "folder") {
				if(Object.keys(child.children).length != 0) {
					var folderRoute = route.slice(0, route.length);
					folderRoute.push(child.name);

					self.findTab(folderRoute, result);
				};
			} else {
				if(child.tab) {
					child.route = route;
					result.push(child);
				};
			};
		});

		return result;
	},
	/* 탭 추가 */
	tabAppend : function(tab, idx) {
		var $tab = this.$tab.clone();

		$tab
			.attr("idx", idx)
			.find(".editor-text").html(tab.name);

		if(tab.active) {
			$(".editor-input")
				.attr("readonly", false)
				.val(tab.tmpContent);

			$tab.addClass("this");
			Folder.nowTab = tab;
		}

		$(".editor-tab").append($tab);
	},
	/* 탭 저장 */
	tabSave : function() {
		if(Folder.nowTab) {
			Folder.nowTab.content = Folder.nowTab.tmpContent;

			Folder.update();
		};
	},
	hook : function() {
		$(".btn-wrap .btn").on("click", function(){
		    var id = $(this).attr("data-popup");

		    Upload.file = [];
		    Upload.filename = [];
		    $("#imageBox").html("");

		    onShowPopup(id);
		});
		$(".popup-close").on("click", function(){
		    var id = "#" + $(this).parents(".popup").attr("id");

		    onHidePopup(id);
		});
		$(document).on("click", ".editor-tab div", function(){
		    $(this).addClass("this").siblings().removeClass("this");
		});
		$(".logo-a").on({
			click : function() {
				Folder.moveFolder(["/"]);
			},
		});
		/* 파일, 폴더 생성 이벤트 */
		$(folderForm).on({
			submit : function(e) {
				e.preventDefault();
				var name = $(folderName).val();

				if(Folder.nameChk(name)) {
					var overlap = Folder.overlapChk(Folder.nowChildren, name);

					if(overlap == "undefined") {
						Folder.nowChildren[name] = {
							name : name,
							type : "folder",
							children : {

							},
						};
						onHidePopup("#popup-folder");
						Folder.update();
						Folder.viewFolder();
					} else {
						alert("이미 같은 이름의 폴더가 있습니다.");
					};
				};
			}
		})
		$(fileForm).on({
			submit : function(e) {
				e.preventDefault();
				var filename = $("#fileName").val();

				if(Folder.nameChk(filename)) {
					filename = filename+"."+$("#fileExt option:selected").val();

					var overlap = Folder.overlapChk(Folder.nowChildren, filename);

					if(overlap == "undefined") {
						Folder.nowChildren[filename] = {
							name : filename,
							type : "file",
							content : "",
							tmpContent : "",
						};

						onHidePopup("#popup-file");
						Folder.update();
						Folder.viewFolder();
					} else {
						alert("이미 같은 이름의 파일이 있습니다.");
					};
				};
			}
		})
		$("#imageBox").on({
			"drop dragover" : function(e) {
				e.preventDefault();
			},
			drop : function(e) {
				e.preventDefault();
				var files = e.originalEvent.dataTransfer.files;

				for(var i = 0; i < files.length; i++) {
					Upload.addFile(files[i]);
				};
			},
			click : function() {
				$("#imageName").val("");
			},
		});
		$("#imageName").on({
			change : function() {
				var files = $(this)[0].files;

				for(var i = 0; i < files.length; i++) {
					Upload.addFile(files[i]);
				};
			},
		});
		$(".image-btn").on({
			click : function() {
				var imageCount = 0;
				if(Upload.file.length == 0) {
					alert("이미지를 선택해 주세요.")
					return false;
				};

				$(".image-btns button").attr("disabled", true);


				$.each(Upload.file, function(idx, file) {
					Folder.nowChildren[file.name] = {
						name : file.name,
						type : "image",
						file : file,
					};

					imageCount++;

					if(Upload.file.length == imageCount) {
						setTimeout(function() {
							alert("업로드가 완료되었습니다.");

							$(".image-btns button").attr("disabled", false);

							onHidePopup("#popup-image");
							Folder.update();
							Folder.viewFolder();
						}, 100);
					};
				});

			},
		})
		/* 파일 관련 이벤트 */
		$(document).on({
			dblclick : function() {
				var name = $(this).attr("name");

				Folder.route.push(name)
				Folder.moveFolder(Folder.route);
			},
		}, ".folder-li");
		$(document).on({
			dblclick : function() {
				Folder.route.pop();
				Folder.moveFolder(Folder.route);
			}
		}, ".parent-li");
		$(document).on({
			dblclick : function(e) {
				e.preventDefault();
				var name = $(this).attr("name");

				window.open(URL.createObjectURL(Folder.nowChildren[name].file), "이미지 보기");
			}
		}, ".image-li");
		$(document).on({
			dblclick : function() {
				if($(this).hasClass("image-li"))
					return false;

				var file = Folder.nowChildren[$(this).attr("name")];
				var error = false;


				$.each(Folder.tabs, function(idx, tab) {
					if(file.route == undefined)
						return false;
					
					if(file.route.join("/")+file.name == tab.route.join("/")+tab.name) {
						error = true;
						$(".editor-tab > div[idx='"+idx+"']").trigger("click");
						return false;
					};
				});

				if(error)
					return false;

				if(Folder.tabs.length >= 8) {
					alert("최대 8개 까지 추가 가능합니다.");
					return false;
				};

				file.tab = true;
				file.order = Folder.tabs[Folder.tabs.length-1] ? Folder.tabs[Folder.tabs.length-1].order + 1 : 0;

				Folder.update();
				Folder.tabRefresh();
			},
		}, ".file-li");
		$(document).on({
			click : function() {
				var prev = $(this).attr("prev");
				var route = Folder.route.slice(0, prev);

				Folder.moveFolder(route);
			}
		}, ".path");
		$(".click-menu").on({
			mousedown : function(e) {
				var name = $(this).attr("name");

				delete Folder.nowChildren[name];

				Folder.update();
				Folder.viewFolder();
				Folder.tabRefresh();

				$(this).hide();

				e.stopPropagation();
			},
		});
		$(document).on({
			contextmenu : function(e) {
				e.preventDefault();
				var name = $(this).attr("name");

				$(".click-menu")
					.attr("name", name)
					.show()
					.css({
						left : e.pageX+"px",
						top : e.pageY+"px",
					});
			},
		}, ".append-li");
		$(document).on({
			mousedown : function(e) {
				$(".click-menu").hide();
			}
		})
		/* 탭 관련 이벤트 */
		$(document).on({
			click : function() {
				Folder.nowTab.active = false;

				var tab = Folder.tabs[$(this).attr("idx")];

				tab.active = true;

				$(".editor-tab > div").removeClass("this");
				$(this).addClass("this");

				$(".editor-input")
					.val(tab.tmpContent)
					.attr("readonly", false);

				Folder.update();
				Folder.nowTab = tab;
			},
		}, ".editor-tab > div");
		$(".editor-input").on({
			keydown : function(e) {
				if(e.keyCode == 9) {
					var start = this.selectionStart;
					var end = this.selectionEnd;
					var value = $(this).val();

					if(start != end) {
						var Z;
				        var end = Z = this.selectionEnd;
				        var line = this.value.slice(start, end);
				        line = line.split('\n');

			            for (var x in line) {
			                line[x] = '\t' + line[x];
			                Z++;
			            }
			            
				        line = line.join('\n');
				        this.value = this.value.slice(0, start) + line + this.value.slice(end);

				        this.selectionStart = start;
				        this.selectionEnd = Z;
					} else {
						$(this).val(value.substring(0, start)+"\t"+value.substring(end));
						this.selectionStart = this.selectionEnd = start + 1;
					}

					e.preventDefault();
				}
			},
			input : function() {
				Folder.nowTab.tmpContent = $(this).val();

				Folder.update();
			}
		});
		$(document).on({
			click : function(e) {
				e.stopPropagation();
				var tab = Folder.tabs[$(this).parent().attr("idx")];

				if(tab.content != tab.tmpContent) {
					if(confirm("편집중인 파일이 저장이 안되어 있습니다. 저장지 않을시 내용이 손실될 수 있습니다. 저장하시겠습니까?")) {
						tab.content = tab.tmpContent;
					} else {
						tab.tmpContent = tab.content;
					};
				}

				if(tab.active) {
					tab.active = false;
					$(".editor-input")
						.attr("readonly", true)
						.val("");

					Folder.nowTab = false;
				};

				Folder.getChildren(tab.route)[tab.name].tab = false;
				Folder.tabRefresh();
				Folder.update();
			},
		}, ".editor-close");
		$(".save").on({
			click : function() {
				Folder.tabSave();
			},
		});
		$(".view").on({
			click : function() {
				if(Folder.nowTab) {
					var nameCut = Folder.nowTab.name.split(".");
					var ext = nameCut[nameCut.length-1];

					if(ext == "html") {
						var wPopup = window.open("", "html", "test");
						wPopup.document.write($(".editor-input").val());
						wPopup.document.close();
					} else {
						alert("html 확장자만 미리보기가 가능합니다.");
					};
				};
			},
		});
		$(document).on({
			keydown : function(e) {
				if(e.ctrlKey) {
					if(e.keyCode == 83) {
						e.preventDefault();
						$(".save").click();
					};
					if(e.keyCode == 88) {
						e.preventDefault();
						$(".editor-tab .this .editor-close").trigger("click");
					}
				};
			},
		});
		$(window).bind("beforeunload", function (e){
			var chk = "";

			$.each(Folder.tabs, function(idx, tab) {
				if(tab.content != tab.tmpContent) {
					chk = true;
					return false;
				}
			});

			if(chk)
				return chk;
		});
	},
}

$(function() {
	$.when(
		Storage.open("ajonachuda", {
			folder : null,
			tab : null
		})
	).done(function() {
		Storage.table("folder").getAll().onsuccess = function(e) {
			var datas = e.target.result;
			var rootFolder = {
				"/" : {
					name : "/",
					type : "folder",
					children : {

					}
				}
			};

			if(datas.length == 0) {
				Storage.table("folder").put(rootFolder).onsuccess = function() {
					Storage.table("folder").getAll().onsuccess = function(e) {
						Folder.folder = e.target.result[0];
						Folder.init();
					};
				};
			} else {
				Folder.folder = datas[0];
				Folder.init();
			};
		};
	});
})
function onShowPopup ( id ) {
    $(".popup-background").fadeIn();
	$(id).find("input").val("");
	$(id).find(".path-input").val(Folder.getPath());
    $(id).fadeIn();
}

function onHidePopup ( id ) {
    $(".popup-background").fadeOut();
    $(id).fadeOut();
}