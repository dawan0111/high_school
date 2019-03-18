// common.js

window.dd = console.log.bind(console);
/*ARRAY PROTO TYPE*/
Array.prototype.get = function(match) {
	return this.filter((arr) => {
		var err = false;
		Object.keys(match).forEach((val, idx) => {
			if(match[val] != arr[val]) {
				err = true;
			}
		});
		if(!err)
			return arr;
	});
};
/*INDEXED DB*/
const Storage = {
	open (database) {
		var request = indexedDB.open(database, 5);
		var deferred = $.Deferred();

		request.onupgradeneeded = (e) => {
			var db = e.target.result;
			var option = { keyPath : "idx", autoIncrement : true };

			db.createObjectStore("member", option);
			db.createObjectStore("like", option);
			db.createObjectStore("comment", option);
			db.createObjectStore("gallery", option);
		}

		request.onsuccess = (e) => {
			this.db = e.target.result;
			deferred.resolve();
		};

		return deferred.promise();
	},

	table (table) {
		return this.db.transaction([table], "readwrite").objectStore(table);
	},

	getTable(table) {
		var $deferred = $.Deferred();
		this.table(table).getAll().onsuccess = (e) => {
			$deferred.resolve(e.target.result);
		};
		return $deferred.promise();
	}
};
/*APP MODEL*/
const App = {
	init () {
		this.$gallery = $(".gallery").eq(0).clone();
		this.autoTimer = null;

		this.loginState();
		this.reset();
		this.galleryReload();

		$(".profile, .admin").hide();
	},

	reset () {
		$(window).scrollTop(0);
		this.limit = true;
		this.scroll = false;
		this.user = false;
		this.sort = "date";
		this.category = false;
	},

	loginState () {
		var login = sessionStorage.getItem("login") || false;

		$(".state-view").hide();

		if(login) {
			this.login = Data.member.get({ idx : login })[0];
			this.viewUser();
			this.autoLogout();

			$(".login-view").show();
			$(".admin-view").toggle(this.login.id == "admin");
			$(".user-view").toggle(this.login.id != "admin");
		} else {
			clearTimeout(this.autoTimer);
			$(".no-login-view").show();
			this.login = false;
		};
		
		this.user = false;
	},

	autoLogout () {
		clearTimeout(this.autoTimer);

		this.autoTimer = setTimeout(() => {
			Member.logout();
			popupClose();
		}, 30000);
	},

	viewUser () {
		var login = this.login;

		$(".member_img").attr("src", image(login.file));
		$(".member_name").html(login.name);
	},

	galleryReload () {
		$(".profile, .admin").hide();
		$(".gallery").remove();

		this.limit = 1;
		this.scroll = false;

		var gallery = [...Data.gallery];

		if(this.category) {
			gallery = gallery.filter(arr => arr.type == this.category);
		};

		if(this.sort) {
			gallery = gallery.sort((a, b) => {
				if(this.sort == "date") {
					return a[this.sort] < b[this.sort];
				} else {
					var aLike = Data.like.get({ gidx : a.idx });
					var bLike = Data.like.get({ gidx : b.idx });

					return aLike < bLike;
				};
			});
		};

		if(this.user) {
			gallery = gallery.filter(arr => arr.user == this.user);
		};

		this.viewGallery = gallery;
		this.galleryView().done(() => {
			this.scroll = true;
		});
	},

	galleryView () {
		var viewGallery = this.viewGallery;
		var limitGallery = viewGallery.slice((this.limit - 1) * 5, this.limit * 5);
		var nextGallery = viewGallery.slice(this.limit * 5, (this.limit + 1) * 5 );
		var Deferred = $.Deferred();
		var count = 0;

		if(this.user && nextGallery.length == 0) {
			App.viewProfile(this.user);
		};

		limitGallery.forEach((data, idx) => {
			var $gallery = this.$gallery.clone();
			var user = Data.member.get({ idx : data.user })[0];
			var likes = Data.like.get({ gidx : data.idx });
			var myLike = Data.like.get({ gidx : data.idx, midx : this.login.idx })[0];

			$gallery.attr("data-idx", data.idx);
			$gallery.find(".gallery_img").attr({
				src : user.type == "공개" ? image(user.file) : "images/basic.jpg",
				"data-idx" : user.idx
			});
			$gallery.find(".gallery_name").html(user.name);
			$gallery.find(".gallery_text").html(data.info);
			$gallery.find(".gallery_main").attr("src", image(data.file));
			$gallery.find(".comment_ul").attr("data-gidx", data.idx);
			$gallery.find(".commentForm").attr("data-gidx", data.idx);
			$gallery.find(".gallery_like span").html(number(likes.length));

			if(this.login.idx != user.idx && this.login.id != "admin") {
				$gallery.find(".gallery_delete").remove();
			};
			if(myLike) {
				$gallery.find(".gallery_like").addClass("on");
			};
			if(!this.login) {
				$gallery.find(".commentForm").remove();
			} else {
				$gallery.find(".commentForm .comment_name").html(this.login.name);
			};

			$(".profile").before($gallery);
			this.commentLoad(data.idx);
			count++;

			if(count == limitGallery.length) {
				Deferred.resolve();
			};
		});

		return Deferred.promise();
	},

	commentLoad (gidx) {
		var comments = [...Data.comment.get({ gidx : gidx })];
		var $target = $(".comment_ul[data-gidx="+gidx+"]");

		$target.find("li").remove();

		comments = comments.sort((a, b) => {
			return a.date < b.date;
		});

		comments.forEach((val, idx) => {
			var user = Data.member.get({ idx : val.user })[0];

			$target.append(`
				<li>
					<span class="comment_name">${user.name}</span>
					<span class="comment_text">${val.content}</span>
				</li>
			`);
		});
	},

	viewProfile (user) {
		var member = Data.member.get({ idx : user })[0];

		$(".admin").hide();
		$(".phone-view").show();
		$(".profile").show();
		$(".my-view").toggle(member.idx == App.login.idx);

		$(".profile_name").html(member.name);
		$("#profileForm input[name=id]").val(member.id);
		$("#profileForm input[name=name]").val(member.name);
		$("#profileForm input[name=phone]").val(member.phone);
		$("#profileForm select option[value="+member.type+"]").prop("selected", true);

		if(member.idx != App.login.idx) {
			$("#profileForm input")
				.attr("readonly", true)
				.css({
					border : "none",
				});

			if(member.type == "비공개") {
				$(".profile_img").attr("src", "images/basic.jpg");
				$(".phone-view").hide();
			} else {
				$(".profile_img").attr("src", image(member.file));
			};
		} else {
			$("#profileForm input")
				.attr("readonly", false)
				.css({
					border : "1px solid #ccc",
				});

			$(".profile_img").attr("src", image(member.file));
		};
	},

	viewInfo () {
		$(".gallery").remove();
		$(".profile").hide();
		$(".admin").show();
		$(".admin > *").hide();
		$(".admin .site-info").show();

		var canvas = document.getElementById("canvas");
		var ctx = canvas.getContext("2d");

		var group = {
			"풍경" : 0,
			"인물" : 0,
			"기타" : 0,
		};
		var lastend = Math.PI * -.5;
		var count = 0;
		var colors = ['#2d7eff', '#5596fc', '#0548b2'];

		ctx.clearRect(0, 0, 999, 999);

		Data.gallery.forEach((val, idx) => {
			group[val.type]++;
		});

		$.each(group, (name, val) => {
			if(val == 0)
				return true;

			var prt = val / Data.gallery.length * 100;
			var color = colors[count];

			var prt = val / Data.gallery.length * 100;
			var piPrt = Math.PI * 2 / 100 * prt;

			ctx.moveTo(250, 250);
			ctx.arc(250, 250, 180, lastend, lastend += piPrt);
			ctx.fillStyle = color;
			ctx.fill();
			ctx.beginPath();

			ctx.fillRect(150 + count * 80, 450, 20, 20);
			ctx.font = "16px malgun gothic";
			ctx.fillText(name, 150 + count * 80 + 25, 465);

			count++;
		});
	},

	memberInfo () {
		$(".gallery").remove();
		$(".profile").hide();
		$(".admin").show();
		$(".admin > *").hide();
		$(".admin .site-member").show();

		$(".member-tbody tr").remove();

		var member = [...Data.member];

		member = member.sort((a, b) => {
			return a.date > b.date;
		});

		member.forEach((val, idx) => {
			if(val.id == "admin")
				return;

			$(".member-tbody").append(`
				<tr>
					<td>${val.id}</td>
					<td>${val.pw}</td>
					<td>${val.name}</td>
					<td>${val.phone}</td>
					<td><button class='admin_delete' data-idx="${val.idx}">삭제</button></td>
				</tr>
			`);
		});
	},
};
/*DATA MODAL*/
const Data = {
	member : [],
	gallery : [],
	comment : [],
	like : [],

	refresh () {
		var $deferred = $.Deferred();

		$.when(
			Storage.getTable("member"),
			Storage.getTable("gallery"),
			Storage.getTable("comment"),
			Storage.getTable("like")
		).done((members, gallerys, comments, likes) => {
			if(members.length == 0) {
				Storage.table("member").put({
					id : "admin",
					pw : "1234!",
					name : "관리자"
				});
			};

			this.member = members;
			this.gallery = gallerys;
			this.comment = comments;
			this.like = likes;

			$deferred.resolve();
		});

		return $deferred.promise();
	},
};

const Gallery = {
	upload (data) {
		var message = [];
		var file = $("#upload_file")[0].files[0];

		if(!file)
			message.push("사진을 선택해주세요.");

		if(file && imageError(file))
			message.push("이미지 파일을 업로드 해주세요.");

		if(message.length == 0) {
			data.file = file;
			data.date = new Date();
			data.user = App.login.idx;

			Storage.table("gallery").put(data).onsuccess = (e) => {
				alert("업로드가 완료되었습니다.");

				Data.refresh().done(() => {
					App.galleryReload();
					popupClose();
				});
			};
		} else {
			alert(message.join("\n"));
		};
	},

	delete(idx) {
		Storage.table("gallery").delete(idx).onsuccess = (e) => {
			Data.refresh().done(() => {
				App.galleryReload();
			});
		};
	}
};
/*MEMBER MODEL*/
const Member = {
	message : {
		id : "아이디를 입력해주세요.",
		pw : "비밀번호를 입력해주세요.",
		name : "닉네임을 입력해주세요.",
		overlap : "중복되는 아이디 입니다.",
		pwMatch : "비밀번호와 비밀번호 확인이 일치하지 않습니다.",
		pwReg : "비밀번호는 툭수문자가 한개 포함 되어야 합니다."
	},

	join (data) {
		var message = [];
		var file = $("#join_file")[0].files[0];

		if(data.id == "")
			message.push(this.message.id);

		if(data.pw == "")
			message.push(this.message.pw);

		if(data.name == "")
			message.push(this.message.name);

		if(data.pw != data.re_pw)
			message.push(this.message.pwMatch);

		if(data.pw.match(/[\!\@\#\$\%\^\&\*]/g) == null)
			message.push(this.message.pwReg);

		if(Data.member.get({ id : data.id }).length != 0)
			message.push(this.message.overlap);

		if(file && imageError(file))
			message.push("이미지를 업로드 해주세요.");

		if(message.length == 0) {
			data.date = new Date();
			if(file) {
				data.file = file;
			};

			Storage.table("member").put(data).onsuccess = (e) => {
				alert("회원가입이 완료되었습니다.");
				$("#joinForm")[0].reset();
				Data.refresh();
				popupClose();
			};
		} else {
			alert(message.join("\n"));
		};
	},

	login (data) {
		var member = Data.member.get({
			id : data.id,
			pw : data.pw			
		})[0];

		if(member) {
			sessionStorage.setItem("login", member.idx);
			alert("로그인이 완료되었습니다.");

			App.loginState();
			App.galleryReload();
			popupClose();
			$("#loginForm")[0].reset();
		} else {
			alert("존재하지 않는 아이디 이거나 비밀번호를 잘못입력 하셨습니다.");
		};
	},

	logout () {
		sessionStorage.removeItem("login");
		App.loginState();
		App.galleryReload();
	},

	modify (data) {
		var message = [];
		var file = $("#updateFile")[0].files[0];

		if(data.id == "")
			message.push(this.message.id);

		if(data.name == "")
			message.push(this.message.name);

		if(Data.member.get({ id : data.id }).length != 0 && data.id != App.login.id)
			message.push(this.message.overlap);

		if(file && imageError(file))
			message.push("이미지를 업로드 해주세요.");

		if(message.length == 0) {
			App.login.id = data.id;
			App.login.name = data.name;
			App.login.phone = data.phone;
			App.login.type = data.type;

			if(file) {
				App.login.file = file;
			};

			Storage.table("member").put(App.login).onsuccess = (e) => {
				alert("수정이 완료되었습니다.");

				Data.refresh().done(() => {
					App.viewUser();
					App.viewProfile(App.login.idx);
					App.galleryReload();
				});
			};
		} else {
			alert(message.join("\n"));
		};
	},

	delete (idx) {
		var deferred = $.Deferred();
		var deferred2 = $.Deferred();
		var deferred3 = $.Deferred();
		var deferred4 = $.Deferred();

		var gallery = Data.gallery.get({ user : idx });
		var comment = Data.comment.get({ user : idx });
		var like = Data.like.get({ midx : idx });

		Storage.table("member").delete(idx).onsuccess = () => {
			deferred.resolve();
		};
		gallery.forEach((val, key) => {
			Storage.table("gallery").delete(val.idx).onsuccess = () => {
				if(key + 1 == gallery.length) {
					deferred2.resolve();
				};
			};
		});
		comment.forEach((val, key) => {
			Storage.table("comment").delete(val.idx).onsuccess = () => {
				if(key + 1 == comment.length) {
					deferred3.resolve();
				};
			};
		});
		like.forEach((val, key) => {
			Storage.table("like").delete(val.idx).onsuccess = () => {
				if(key + 1 == like.length) {
					deferred4.resolve();
				};
			};
		});

		if(gallery.length == 0)
			deferred2.resolve();

		if(comment.length == 0)
			deferred3.resolve();

		if(like.length == 0)
			deferred4.resolve();

		$.when(
			deferred,
			deferred2,
			deferred3,
			deferred4
		).done(() => {
			Data.refresh().done(() => {
				App.memberInfo();
			});
		});
	}
};
/*COMMENT*/
const Comment = {
	write (data, gidx) {
		if(!App.login || App.login.id == "admin") {
			alert("회원만 이용 가능합니다.");
			return;
		}

		var insertData = {
			content : data.comment,
			user : App.login.idx,
			date : new Date(),
			gidx : gidx,
		};

		if(insertData.content == "") {
			alert("댓글 내용을 입력해주세요.");
			return;
		};

		Storage.table("comment").put(insertData).onsuccess = (e) => {
			$(".comment_input").val("");
			Data.refresh().done(() => {
				App.commentLoad(gidx);
			});
		};
	},
};
/* 좋아용 */
const Like = {
	changeState (gidx) {
		if(!App.login || App.login.id == "admin") {
			alert("회원만 이용 가능합니다.");
			return;
		};
		var liked = Data.like.get({ gidx : gidx, midx : App.login.idx })[0];

		if(liked) {
			Storage.table("like").delete(liked.idx).onsuccess = () => {
				Data.refresh().done(() => {
					App.galleryReload();
				});
			};
		} else {
			Storage.table("like").put({
				gidx : gidx,
				midx : App.login.idx
			}).onsuccess = () => {
				Data.refresh().done(() => {
					App.galleryReload();
				});
			};
		};
	},
};

/*  GLOBAL FUNCTION */
function popupClose () {
	$(".bg span").click();
}

function imageError(file) {
	return file.type.match(/^image\/.+$/) == null;
}

function changeFormData(data) {
	var result = {};
	$.each(data, (idx, val) => {
		result[val.name] = val.value;
	});
	return result;
}

function image(file) {
	return file ? URL.createObjectURL(file) : "images/basic.jpg";
}

function number(num) {
	if(num > 10000) {
		num = (num / 10000).toFixed(1)+"만";
	} else if(num > 1000) {
		num = (num / 1000).toFixed(1)+"천";
	};

	return num;
}

$(function(){
	// login
	$(".login_btn").click(function(e){
		$(".bg").css({'z-index':'1','opacity':'1'});
		$(".login").show();

		$(".bg span").click(function(e){
			$(".bg").css({'z-index':'-1','opacity':'0'});
			$(".login").hide();
		});
	});

	// join
	$(".join_btn").click(function(e){
		$(".bg").css({'z-index':'1','opacity':'1'});
		$(".join").show();

		$(".bg span").click(function(e){
			$(".bg").css({'z-index':'-1','opacity':'0'});
			$(".join").hide();
		});
	});

	// upload
	$(".upload_btn").click(function(e){
		$(".bg").css({'z-index':'1','opacity':'1'});
		$(".upload").show();

		$(".bg span").click(function(e){
			$(".bg").css({'z-index':'-1','opacity':'0'});
			$(".upload").hide();
		});
	});

	Storage.open("indexedDB").done(() => {
		Data.refresh().done(() => {
			App.init();
		});
	});
	/* EVENT */
	$(document)
		.on("keydown mousedown", function() {
			App.autoLogout();
		})
		.on("scroll", function() {
			if ($(window).scrollTop() + $(window).height() == $(document).height() && App.scroll) {
				App.limit++;
				App.galleryView();
			};
		})
		.on("submit", "#loginForm", function(e) {
			e.preventDefault();
			Member.login(changeFormData($(this).serializeArray()));
		})
		.on("submit", "#joinForm", function(e) {
			e.preventDefault();
			Member.join(changeFormData($(this).serializeArray()));
		})
		.on("submit", "#uploadForm", function(e) {
			e.preventDefault();
			Gallery.upload(changeFormData($(this).serializeArray()));
		})
		.on("submit", ".commentForm", function(e) {
			e.preventDefault();
			Comment.write(changeFormData($(this).serializeArray()), $(this).data("gidx"));
		})
		.on("submit", "#profileForm", function(e) {
			e.preventDefault();
			Member.modify(changeFormData($(this).serializeArray()));
		})
		.on("click", ".logout", function() {
			Member.logout();
		})
		.on("click", ".logo", function(e) {
			e.preventDefault();
			App.reset();
			App.galleryReload();
		})
		.on("click", ".categories li", function() {
			var type = $(this).data("type");
			var val = $(this).data("val");

			App[type] = val;
			App.galleryReload();
		})
		.on("click", ".gallery_img", function() {
			App.user = $(this).data("idx");
			App.galleryReload();
		})
		.on("click", ".profile-btn", function() {
			$(".gallery").remove();
			App.viewProfile(App.login.idx);
		})
		.on("change", "#updateFile", function() {
			var file = $(this)[0].files[0];

			if(imageError(file)) {
				alert("이미지만 올려줘요.");
				$(this).val("");
				return;
			};

			$(".update-image").attr("src", image(file));
		})
		.on("click", ".gallery_like", function() {
			var idx = $(this).parents(".gallery").data("idx");
			Like.changeState(idx);
		})
		.on("click", ".gallery_main", function() {
			var image = $(this).attr("src");
			var a = document.createElement("a");

			a.href = image;
			a.download = "gallery.png";

			a.click();
		})
		.on("click", ".gallery_delete", function() {
			var $gallery = $(this).parents("div.gallery");
			var idx = $gallery.data("idx");

			Gallery.delete(idx);
		})
		.on("click", ".info-btn", function() {
			App.viewInfo();
		})
		.on("click", ".member-btn", function() {
			App.memberInfo();
		})
		.on("click", ".admin_delete", function() {
			Member.delete($(this).data("idx"));
		})
});