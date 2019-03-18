/* document javascript */

const TS = "transaction";
const CI = "classification";
const WEEK = ["일", "월", "화", "수", "목", "금", "토"];

window.dd = console.log.bind(console);

/* 배열 컬럼 */
Array.prototype.col = function(col) {
	return this.map(x => x[col]);
};

/* 정보 가져오기 */
function getInfo(data) {
	var data = $.extend({
		idx : data.idx,
		filename : data.filename,
		filesize : data.filesize,
	}, data.content);

	data.datetime = data[TS].date+" "+data[TS].time;
	data.realDate = new Date(data.datetime);
	data.week = data.realDate.getDay();
	data.viewDate = data[TS].date+` (${WEEK[data.week]}) `+data[TS].time;
	data.viewPrice = data[TS].amount.toLocaleString();

	if(data.card.information == "MASTER") {
		data.listClass = data.cardClass = "fab fa-cc-mastercard";
		data.cardLabel = "마스터카드";
	} else {
		data.listClass = data.cardClass = "fab fa-cc-visa";
		data.cardLabel = "비자카드";
	};

	if(data[TS][CI] == "Payment") {
		data.payType = "결제";
		data.paySymbol = "-";
		data.payClass = "has-text-danger";
	} else {
		data.payType = "취소";
		data.paySymbol = "+";
		data.payClass = "has-text-link";
		data.listClass = "fas fa-undo";
	};

	if(data[TS].type == "Offline") {
		data.payPlace = "오프라인";
	} else {
		data.payPlace = "온라인";
	};

	return data;
};

/*검색목록 가져오기*/
function getSearch(item) {
	return {
		viewDate : item.viewDate,
		name : item.more.name,
		cardLabel : item.cardLabel,
		viewPrice : item.viewPrice,
		payType : item.payType,
		payPlace : item.payPlace,
		cardNum : item.card.number,
		cardApp : item.card.approval,
		address : item.more.address,
		phone : item.more.call,
	};
}

/*하이라이트*/
function highright(data, keyword) {
	var result = {};
	var regex = new RegExp(/[\!\@\#\$\%\^\&\*\(\)\_\:\.]/, "g");

	search_keyword = keyword.replace(regex, "\\$&");

	$.each(data, (key, val) => {
		result[key] = val.replace(new RegExp(search_keyword, "g"), `<span style="background:#00d1b1; color:#ffffff;">${keyword}</span>`)
	});

	return result;
}

/*로컬 데이터 가져오기*/
const Local = {
	set (data) {
		localStorage.setItem("goooood", JSON.stringify(data));
	},
	get () {
		return JSON.parse(localStorage.getItem("goooood"));
	},
	def () {
		if(!localStorage.getItem("goooood")) {
			Local.set({
				idx : 0,
				list : [],
			});
		};
	},
};

/*메인 에플리케이션*/
const App = {
	init () {
		this.active = false;
		this.detail = false;
		this.keyword = "";

		$("#radio-png, #radio-png2").val("png");
		$("#radio-jpg, #radio-jpg2").val("jpg");

		this.refresh();
	},

	/*검색키워드 추가*/
	search () {
		this.keyword = $("body > section > div > div > nav > div.level-left > div:nth-child(2) > div > p:nth-child(1) > input").val();
		this.refresh();
	},

	/*리스트 새로고침*/
	refresh () {
		var {list} = Local.get();
		var $panel = $(".main .list .panel");
		var prevDate = "";

		$panel.html("");

		list = list
			.map(getInfo)
			.sort((a, b) => {
				return b.realDate - a.realDate;
			})
			.filter(arr => {
				var matching;

				if(this.keyword != "") {
					matching = false;
					var search = getSearch(arr);

					$.each(search, (idx, val) => {
						if(val.indexOf(this.keyword) !== -1) {
							matching = true;
							return false;
						};
					});
				} else {
					matching = true;
				};

				return matching;
			});


		list.forEach((data, idx) => {
			if(prevDate != data[TS].date) {
				$panel.append(`
					<a class="panel-block panel-date">
					    <span class="panel-icon">
					      <i class="far fa-calendar-alt" aria-hidden="true"></i>
					    </span>
					    <small>${data[TS].date.substr(2)} (${WEEK[data.week]})</small>
					</a>
				`);
			};

			$panel.append(`
				<a class="panel-block data-item" data-idx="${data.idx}">
				    <span class="panel-icon">
				      <i class="${data.listClass}" aria-hidden="true"></i>
				    </span>
				    <small>${data.more.name} [${data.filename}]</small>
				    <span class="panel-price is-pulled-right ${data.payClass}">
				        ${data.paySymbol}${data.viewPrice}<small>원</small>
				    </span>
				</a>
			`);

			prevDate = data[TS].date;
		});

		if(list.length == 0) {
			$(".detail-content").html(this.keyword == "" ? "영수증을 추가해 주세요." : "검색결과에 맞는 영수증이 없습니다.");
			$("body > section > div > div > div > div.detail > div.field.is-grouped.is-pulled-right").hide();
		} else {
			if(this.active === false || !list.col("idx").includes(this.active)) {
				this.active = $(".data-item").eq(0).data("idx");
			};

			$("body > section > div > div > div > div.detail > div.field.is-grouped.is-pulled-right").show();
			this.activeChange(this.active);
		};
	},

	/*active change*/
	activeChange (idx) {
		this.active = idx;

		$(".data-item").removeClass("is-active");
		$(".data-item[data-idx="+idx+"]").addClass("is-active");

		this.viewDetail();
	},

	/*디테일한 영수증 정보 보기*/
	viewDetail () {
		var {list} = Local.get();
		var item = list.filter(x => x.idx == this.active)[0];

		this.activeItem = item;
		item = getInfo(item);

		var button = this.detail ? "일반보기" : "상세보기";
		var type = item.cardLabel == "마스터카드" ? "card-master" : "card-visa";
		var v = getSearch(item);

		if(this.keyword != "")
			v = highright(v, this.keyword);


		$(".detail-content").html(`
			<h1>
				${item.payType}
			    <a class="button is-pulled-right is-rounded">${button}</a>
			</h1>
			<p>${v.viewDate}</p>
			<h3>
				${v.name}
			    <span class="is-pulled-right ${type}">
			        <i class="${item.cardClass}"></i>&nbsp;${v.cardLabel}
			    </span>
			</h3>
			<hr>
			<h1 class="is-marginless has-text-right">
			    <span class="is-pulled-left">거래금액</span>
			    <span class="has-text-danger">${v.viewPrice}<small>원</small></span>
			</h1>
		`);

		if(!this.detail)
			return;

		$(".detail-content").append(`
			<p class="is-marginless has-text-right">
			    <span class="is-pulled-left">거래시각</span>
			    <span>${v.viewDate}</span>
			</p>
			<p class="is-marginless has-text-right">
			    <span class="is-pulled-left">거래구분</span>
			    <span>${v.payType}</span>
			</p>
			<p class="has-text-right">
			    <span class="is-pulled-left">거래형태</span>
			    <span>${v.payPlace}</span>
			</p>
			<p class="is-marginless has-text-right">
			    <span class="is-pulled-left">카드정보</span>
			    <span>${v.cardLabel}</span>
			</p>
			<p class="is-marginless has-text-right">
			    <span class="is-pulled-left">카드번호</span>
			    <span>${v.cardNum}</span>
			</p>
			<p class="has-text-right">
			    <span class="is-pulled-left">승인번호</span>
			    <span>${v.cardApp}</span>
			</p>
			<p class="is-marginless has-text-right">
			    <span class="is-pulled-left">사용처</span>
			    <span>${v.name}</span>
			</p>
			<p class="is-marginless has-text-right">
			    <span class="is-pulled-left">주소</span>
			    <span>${v.address}</span>
			</p>
			<p class="is-marginless has-text-right">
			    <span class="is-pulled-left">전화번호</span>
			    <span>${v.phone}</span>
			</p>
		`);
	},
};

/*팝업창 */
const Popup = {
	/*팝업창 기본 설정*/
	init () {
		this.receiptNone = `
			<tr>
	            <td class="has-text-centered">
	                <span>파일을 선택하면 여기에 추가됩니다.</span>
	            </td>
	        </tr>
		`;

		$(".modal-card").css({
			position : "absolute",
			left : "50%",
			top : "50%",
			transform : "translate(-50%, -50%)",
		});

		$("body").append(`<input type='file' id='addFile' multiple hidden />`);
		$(".button").css("cursor", "default");
	},

	/*팝업창 오픈*/
	open (target) {
		var {list} = Local.get();

		$("#"+target).show();
		this.target = target;
		this.choiceList = [];

		$(".is-focused").each((idx, el) => {
			var item = list.filter(x => x.idx == $(el).data("idx"))[0];
			this.choiceList.push(item);
		});

		$("#radio-png").prop("checked", true);
		$("#radio-png2").prop("checked", true);

		if(typeof this[target+"Init"] == "function") {
			this[target+"Init"]();
		};
	},

	/*팝업창 닫기*/
	close (refresh = true) {
		$("#"+this.target).hide();

		if(refresh)
			App.refresh();
	},

	/* 영수증 추가 */
	ReceiptInit () {
		this.receiptList = [];
		this.receiptRefresh();
	},
	receiptRefresh () {
		$("#Receipt table tbody").html(this.receiptList.length == 0 ? this.receiptNone : "");
		$("#Receipt .is-success").attr("disabled", this.receiptList.length == 0);

		this.receiptList.forEach((file, idx) => {
			$("#Receipt table tbody").append(`
				<tr>
				    <td>
				        <a>${file.name} <span class="tag is-info">${Math.ceil(file.size / 1024)}Kb</span></a>
				        <button class="delete receipt-delete is-pulled-right" data-idx="${idx}" aria-label="close"></button>
				    </td>
				</tr>
			`);
		});
	},
	fileUpload (files) {
		var error = false;
		var fileList = Object.values(files).filter(x => {
			return x.name.substr(-5).toLowerCase() == ".json";
		});

		if(fileList.length != Object.keys(files).length) {
			alert("json 파일만 선택 할 수 있습니다.");
			return false;
		};

		this.receiptList = [...this.receiptList, ...fileList];
		this.receiptRefresh();
	},
	saveFile () {
		var data = Local.get();
		var success = 0;

		this.receiptList.forEach((file, idx) => {
			var fileReader = new FileReader();

			fileReader.onload = (e) => {
				data.list.push({
					idx : ++data.idx,
					filename : file.name,
					filesize : file.size,
					content : JSON.parse(e.target.result),
				});

				success++;

				if(this.receiptList.length == success) {
					Local.set(data);

					alert("추가가 완료되었습니다.");
					Popup.close();
				};
			};

			fileReader.readAsText(file);
		});
	},

	/*영수증 초기화*/
	InitializationInit () {
		var {list} = Local.get();
		$("#Initialization span strong").html(list.length);
	},
	clearData () {
		Local.set({
			idx : 0,
			list : [],
		});

		Popup.close();
	},

	choiceRefresh () {
		var $table = $("#"+this.target).find("table tbody");
		var $button = $("#"+this.target).find(".is-success");

		$table.html(
			this.choiceList.length == 0 ? 
			`
				<tr>
	                <td class="has-text-centered">
	                    <strong class="has-text-danger">1개 이상 선택하세요.</strong>
	                </td>
	            </tr>
			` :
			`
				<tr>
	                <td class="has-text-centered">
	                    <span>총 <strong>${this.choiceList.length}</strong>개의 영수증이 선택되었습니다.</span>
	                </td>
	            </tr>
			`
		);
		$button.attr("disabled", this.choiceList.length == 0);

		this.choiceList.forEach((data, idx) => {
			$table.append(`
				<tr>
                    <td>
                        <a>${data.filename} <span class="tag is-info">${Math.ceil(data.filesize / 1024)}Kb</span></a>
                        <button data-idx='${idx}' class="delete choice-delete is-pulled-right" aria-label="close"></button>
                    </td>
                </tr>
			`);
		});
	},

	/*삭제*/
	DeleteInit () {
		this.choiceRefresh();
	},
	delete () {
		var local = Local.get();
		var idxs = this.choiceList.col("idx");

		local.list = local.list.filter(x => !idxs.includes(x.idx));

		Local.set(local);
		Popup.close();
	},
	/*내보내기*/
	ExportInit () {
		this.choiceRefresh();
	},
	exportList () {
		this.choiceList.forEach((file, idx) => {
			this.exportFile(file);
		});
	},
	/*영수증 json 파일 내보내기*/
	exportFile (file) {
		var jsonData = JSON.stringify(file.content, null, "\t");
		var jsonBlob = new Blob([jsonData], {type : "application/json"});
		var a = document.createElement("a");

		a.href = URL.createObjectURL(jsonBlob);
		a.download = file.filename;

		a.click();
	},

	DownloadInit () {
		this.choiceRefresh();
	},

	/*선택된 리스트 다운로드*/
	downloadAction () {
		var ext = $("input[name=radio-download]:checked").val();

		this.choiceList.forEach((file, idx) => {
			this.download(file, ext);
		});
	},

	/*파일 영수증 다운로드*/
	download (file, ext) {
		var data = getInfo(file);
		var canvas = document.createElement("canvas");
		var ctx = canvas.getContext("2d");
		var ct = 0;
		var address = data.more.address;
		var line = "--------------------------------------------------";

		canvas.width = 330;
		canvas.height = 420;

		ctx.fillStyle = "#fff";
		ctx.fillRect(0, 0, 999, 999);

		ctx.fillStyle = "#000";
		ctx.font = "24px malgun gothic";
		ctx.textAlign = "center";
		ctx.fillText("스마트 영수증", 165, ct += 40);

		ctx.font = "14px malgun gothic";
		ctx.textAlign = "left";

		while(ctx.measureText(address).width > 254) {
			address = address.substr(0, address.length - 1);
		};

		ctx.fillText("사용처 : "+data.more.name, 20, ct += 30);
		ctx.fillText("가맹점번호 : "+data.more.number, 20, ct += 20);
		ctx.fillText("전화번호 : "+data.more.call, 20, ct += 20);
		ctx.fillText("주소 : "+address, 20, ct += 20);

		ctx.fillText(line, 20, ct += 25);

		ctx.font = "20px malgun gothic";
		ctx.textAlign = "center";
		ctx.fillText(`[ ${data.payPlace} ${data.payType} ]`, 165, ct += 30);

		ctx.font = "14px malgun gothic";
		ctx.textAlign = "left";

		ctx.fillText("카드종류 : "+data.cardLabel, 20, ct += 30);
		ctx.fillText("카드번호 : "+data.card.number, 20, ct += 20);
		ctx.fillText("거래승인 : "+data.card.approval, 20, ct += 20);
		ctx.fillText("거래일시 : "+data.datetime, 20, ct += 20);

		ctx.fillText(line, 20, ct += 25);

		ctx.textAlign = "left";
		ctx.fillText("거래금액 : ", 20, ct += 20);
		ctx.textAlign = "right";
		ctx.fillText((data[TS].amount * 0.95).toLocaleString()+"원", 310, ct);

		ctx.textAlign = "left";
		ctx.fillText("부가 : ", 20, ct += 20);
		ctx.textAlign = "right";
		ctx.fillText((data[TS].amount * 0.05).toLocaleString()+"원", 310, ct);

		ctx.textAlign = "left";
		ctx.fillText("합계 : ", 20, ct += 20);
		ctx.textAlign = "right";
		ctx.fillText((data[TS].amount).toLocaleString()+"원", 310, ct);

		ctx.textAlign = "left";
		ctx.fillText(line, 20, ct += 20);
		ctx.fillText("감사합니다!", 20, ct += 20);

		var a = document.createElement("a");

		a.href = canvas.toDataURL(ext == "jpg" ? "image/jpeg" : "image/png");
		a.download = "영수증."+ext;
		a.click();
	},

	DetailDownloadInit () {
		$("#DetailDownload table tbody").html(`
			<tr>
                <td>
                    <a>${App.activeItem.filename} <span class="tag is-info">${Math.ceil(App.activeItem.filesize / 1024)}Kb</span></a>
                </td>
            </tr>
		`);
	},
};

$(function () {
	var timer;

	Local.def();

	App.init();
	Popup.init();

	/*메인 이벤트*/
	$(document)
		.on("click", "a[data-target]", function(e) {
			var target = $(this).data("target");
			Popup.open(target);
		})
		.on("click", "#Receipt > div.modal-card > footer > button:nth-child(1)", function() {
			$("#addFile").val("").click();
		})
		.on("click", "#Receipt > div.modal-card > footer > button.button.is-success.is-pulled-right", function() {
			Popup.saveFile();
		})
		.on("click", "body > section > div > div > div > div.detail > div.detail-content.content > h1:nth-child(1) > a", function() {
			App.detail = !App.detail;
			App.viewDetail();
		})
		.on("click mouseup mousedown mouseleave", ".data-item", function(e) {
			switch(e.type) {
				case "mousedown":
					$(this).addClass("loading");
					timer = setTimeout(() => {
						$(this)
							.removeClass("loading")
							.toggleClass("is-focused");
					}, 2000);
					break;
				case "mouseup":
				case "mouseleave":
					clearTimeout(timer);
					setTimeout(() => {
						$(this).removeClass("loading");
					}, 10);
					break;
				case "click":
					if($(this).hasClass('loading')) {
						App.activeChange($(this).data("idx"));
					};
					break;
			};
		})
		.on("click", ".search-button", function() {
			App.search();
		})
		.on("click", "#Initialization .is-danger", function() {
			Popup.clearData();
		})
		.on("click", "#Export .is-success", function() {
			Popup.exportList();	
		})
		.on("click", ".receipt-delete", function() {
			var idx = $(this).data("idx");
			Popup.receiptList.splice(idx, 1);
			Popup.receiptRefresh();
		})
		.on("click", ".modal-close", function() {
			Popup.close(false);
		})
		.on("click", ".choice-delete", function() {
			var item = Popup.choiceList.splice($(this).data("idx"), 1)[0];
			$(".data-item[data-idx="+item.idx+"]").removeClass("is-focused");

			Popup.choiceRefresh();
		})
		.on("click", "#Delete .is-success", function() {
			Popup.delete();
		})
		.on("click", "body > section > div > div > div > div.detail > div.field.is-grouped.is-pulled-right > p:nth-child(1) > a", function() {
			var item = App.activeItem;
			Popup.exportFile(item);
		})
		.on("click", "#Download .is-success", function() {
			Popup.downloadAction();
		})
		.on("click", "#DetailDownload .is-success", function() {
			Popup.download(App.activeItem, $("input[name=radio-download2]:checked").val());
		})
		.on("click", "body > section > div > div > div > div.detail > div.field.is-grouped.is-pulled-right > p:nth-child(3) > a", function() {
			var local = Local.get();
			local.list = local.list.filter(x => x.idx != App.activeItem.idx);
			Local.set(local);

			App.refresh();
		})
		.on("keydown", "body > section > div > div > nav > div.level-left > div:nth-child(2) > div > p:nth-child(1) > input",  function(e) {
			if(e.keyCode == 13)
				App.search();
		})
		.on("change", "#addFile", function() {
			var files = this.files;
			Popup.fileUpload(files);
		})
});