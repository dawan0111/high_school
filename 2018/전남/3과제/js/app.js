/* document javascript */

window.dd = console.log.bind(console);

/* array prototype */
Array.prototype.get = function(col, val) {
	return this.filter(arr => arr[col] == val );
};
Array.prototype.no = function(col, val) {
	return this.filter(arr => arr[col] != val );
};


/* global function */
function changeFormData(data) {
	var result = {};
	$.each(data, function(idx, val) {
		result[val.name] = val.value;
	});
	return result;
}

function redirect(url, msg) {
	setTimeout(() => {
		alert(msg);
		location.href = url;
	}, 10);
};

function getHit(vidx) {
	var deferred = $.Deferred();

	Storage.getTable("hit").done(function(data) {
		data = data.get("vidx", vidx);
		deferred.resolve(data);
	});

	return deferred.promise();
};

function getFollow(userId) {
	var deferred = $.Deferred();

	Storage.getTable("follow").done(function(data) {
		data = data.get("target", userId);
		deferred.resolve(data);
	});

	return deferred.promise();
}

function zero(n) {
	return n < 10 ? "0"+n : n;
}

function getLike(videoId) {
	var deferred = $.Deferred();

	Storage.getTable("like").done(function(data) {
		data = data.get("vidx", videoId);

		var like = [...data].get("type", "like"),
			bad = [...data].get("type", "bad");

		deferred.resolve({
			like : like,
			bad : bad,
		});
	});

	return deferred.promise();	
};

function getVideoUser(videoIdx) {
	var deferred = $.Deferred();

	Storage.getTable("video").done(function(data) {
		data = data.get("idx", videoIdx)[0];

		Storage.getTable("member").done(function(member) {
			var user = member.get("id", data.id);
			data.user = data;

			deferred.resolve(data);
		});
	});

	return deferred.promise();
};

function shuffle(a) {
	var j, x, i;
	for(i = a.length; i; i -= 1) {
		j = Math.floor(Math.random() * i);
		x = a[i - 1];
		a[i - 1] = a[j];
		a[j] = x;
	};
}

function viewVideo(videos, $target) {
	$target.html("");
	$.each(videos, function(idx, video) {
		getHit(video.idx).done((hit) => {
			var temp = `
				<a href="./video.html?video=${video.idx}" class="video_box">
					<div class="video">
						<img src="${URL.createObjectURL(video.image)}" alt="img">
					</div>
					<div class="video_contents">
						<p class="title">${video.title} - ${video.name}</p>
						<p class="sub">${video.name}</p>
						<p class="sub">조회수 ${hit.length}회</p>
					</div>
				</a>
			`;

			$target.append(temp);
		});
	});
};

/* indexed db open */
const Storage = {
	open (database) {
		var request = indexedDB.open(database, 5),
			deferred = $.Deferred();

		request.onupgradeneeded = (e) => {
			var db = e.target.result,
				option = { keyPath : "idx", autoIncrement : true };

			db.createObjectStore("member", option);
			db.createObjectStore("video", option);
			db.createObjectStore("comment", option);
			db.createObjectStore("follow", option);
			db.createObjectStore("hit", option);
			db.createObjectStore("like", option);
		};

		request.onsuccess = (e) => {
			this.db = e.target.result;
			deferred.resolve();
		};

		return deferred.promise();
	},

	table (table) {
		$store = this.db.transaction([table], "readwrite").objectStore(table);
		return $store;
	},

	getMember () {
		var deferred = $.Deferred();

		this.table("member").getAll().onsuccess = (e) => {
			deferred.resolve(e.target.result);
		};

		return deferred.promise();
	},

	getTable (tablename) {
		var deferred = $.Deferred();

		this.table(tablename).getAll().onsuccess = (e) => {
			deferred.resolve(e.target.result);
		};

		return deferred.promise();
	}
};

/* now url and login state chk */
const url = new URL(location.href);
const login = sessionStorage.getItem("login") || false;

/* application event and global setting */
const App = {
	init() {
		$(".login-tag").hide();

		if(login) {
			$(".no-login").hide();
			$(".yes-login").show();

			$(".go-user").attr("href", "./user.html?id="+login);
		} else {
			$(".no-login").show();
			$(".yes-login").hide();
		};
	},
};

/* login */
const Login = {
	logout () {
		sessionStorage.removeItem("login");

		alert("로그아웃이 완료되었습니다.");
		location.href = "/";
	},
};

/* follow */
const Follow = {
	stateChange () {
		if(!login) {
			alert("로그인 후 이용해주세요.");
			return false;
		};

		var target = $(this).data("target");

		if(target == login) {
			alert("자기 자신은 팔로우 할수 없습니다.");
			return false;
		};

		getFollow(target).done((members) => {
			var followChk = members.get("id", login);

			if(followChk.length == 0) {
				Storage.table("follow").put({
					id : login,
					target : target,
				}).onsuccess = function() {
					setTimeout(() => {
						alert("팔로우가 완료되었습니다.");
						location.reload();
					}, 10);
				};
			} else {
				Storage.table("follow").delete(followChk[0].idx).onsuccess = function() {
					setTimeout(() => {
						alert("팔로우가 취소되었습니다.");
						location.reload();
					}, 10);
				};
			};
		});
	},
};

/* video modal */
const Video = {
	videoSet ($element) {

		this.target = $element[0];
		this.state = "pause";

		this.target.ontimeupdate = () => {
			var prt = this.target.currentTime / this.target.duration * 100;

			$(".now_time").html(zero(Math.floor(this.target.currentTime / 60))+":"+zero(Math.round(this.target.currentTime % 60)));
			$("#progress-bar").css("width", prt+"%");
		};
		
		this.target.onloadedmetadata = () => {
			$(".full_time").html(zero(Math.floor(this.target.duration / 60))+":"+zero(Math.round(this.target.duration % 60)));
		};

		this.target.volume = 0.5;
		this.click = false;
	},

	state () {
		var video = Video.target;

		$(".play_").hide();

		if(Video.state == "pause") {
			video.play();
			$(".pause").show();
		} else {
			video.pause();
			$(".play").show();
		};

		Video.state = Video.state == "pause" ? "play" : "pause";
	},

	volumeChange () {
		var video = Video.target;
		var val = $(this).val();

		video.volume = val / 100;
	},

	clickToggle (e) {
		var video = Video.target;

		if(e.type == "mousedown") {
			video.currentTime = video.duration / 100 * (e.offsetX / $(this).width() * 100);
			dd("test");
			Video.click = true;
		} else {
			Video.click =false;
		};
	},

	timeChange (e) {
		if(Video.click) {
			var video = Video.target;
			var x = e.pageX - $("#progress").offset().left;
			var time = video.duration / 100 * (x / $("#progress").width() * 100);

			if(time < -1)
				time = 0;

			if(time > video.duration)
				time = video.duration;

			video.currentTime = time;
		};
	},

	volumeState (e) {
		dd("test");
		$(".volume_").hide();
		if($(this).hasClass("volume_off")) {
			Video.target.muted = false;
			$(".volume").show();
		} else {
			Video.target.muted = true;
			$(".volume_off").show();
		};
	},
};
/* dom event */
$(() => {
	App.init();

	$(document)
		.on("click", ".logout", Login.logout)
		.on("click", ".follow-btn", Follow.stateChange)
		.on("click", ".play_", Video.state)
		.on("input", ".volume_change", Video.volumeChange)
		.on("click", ".volume_", Video.volumeState)
		.on("mousedown mouseup", "#progress", Video.clickToggle)
		.on("mousemove", Video.timeChange)
		.on("mouseleave mouseup", Video.clickToggle)
})
