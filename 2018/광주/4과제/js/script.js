window.dd = console.log.bind(console);

$(function() {
    $('body').on('click', '.admin #header .hd-bot > ul > li:nth-child(1) a', function(e) {
        e.preventDefault();
        $('.submenu').slideToggle(500);
        setTimeout(function() {
            if ($('.submenu').css('display') == 'block') {
                $("#contents").css({
                    "margin-top": "160px"
                });
            } else {
                $("#contents").css({
                    "margin-top": "0"
                });
            }
        }, 600);
    })
    $('body').on('mouseover', '.main-header #main-menu .menu li, .main-header .submenu', function(e) {
        $('.main-hd .submenu').stop().slideDown(500);
    })
    $('body').on('mouseout', '.main-header #main-menu .menu li, .main-header .submenu', function(e) {
        $('.main-hd .submenu').stop().slideUp(500);
    })
    for (var i = 0; i < $(".banner-img > ul > li").length; i++) {
        $(".banner-pos > ul").append("<li></li>");
    }
    $(".banner-pos > ul li").eq(0).css({
        "background-color": "#fff"
    });
    var b_len = $('.banner-img > ul > li').length;
    var all_wd = 100 * b_len;
    var one_wd = 100 / b_len;
    $('.banner-img > ul').css({
        "width": all_wd + "%"
    });
    $('.banner-img > ul > li').css({
        "width": one_wd + "%"
    });
    $('.banner-img > ul > li').eq(0).addClass('anishow');
    $('.banner-img > ul').attr('data-type', 'next');
    var btn = {
        on: function() {
            this.timer = setInterval(function() {
                animation('next');
            }, $(".banner").data("delay") * 1000);
        },
        off: function() {
            clearInterval(this.timer);
        }
    }
    btn.on();
    $('body').on('click', '.banner-img .banner-pos ul li', function(e) {
        var idx = $(this).index();
        btn.off();
        slide(idx);
        btn.on();
    })
})
function animation(arrow) {
    var idx = $('.banner-img > ul > li.anishow').index();
    var len = $('.banner-img > ul > li').length;
    var type = $('.banner-img > ul').attr('data-type');
    switch (arrow) {
    case 'next':
        idx + 1 == len ? slide(0) : slide(idx + 1);
        break;
    }
}
function slide(idx) {
    var len = $('.banner-img > ul > li').length;
    $('.banner-img > ul > li').removeClass('anishow');
    $('.banner-img > ul > li').eq(idx).addClass('anishow');
    $(".banner-pos > ul > li").css({
        "background-color": "#000"
    });
    $(".banner-pos > ul > li").eq(idx).css({
        "background-color": "#fff"
    });
    $('.banner-img > ul').stop().animate({
        "margin-left": "-" + 100 * idx + "%"
    }, 1000);
}
function sorTable() {
    $('.menu-set-list > ul').sortable();
    $('.two-menu-wrap').sortable();
}
function colorPicker(el) {
    $.ajax({
        type: "POST",
        url: "/admin/colorpicker",
        success: function(data) {
        	var $td = $(el).parents("td");

            if ($(el).parents("td").find(".color-picker").html() != '') {
                $(el).parents("td").find(".color-picker").html('');
                return false;
            }
            $(el).parents("td").find('.color-picker').html(data);

            $(".color-picker span").on("click", function(e) {
            	var color = $(this).css("background-color");
            	$td.find("input[type=text]").val(color);
            	viewColor();
            });
        }
    })
}

function viewColor() {
	$("input[type=text]").each((idx, el) => {
		var val = $(el).val();
		$(el).next().css("background-color", val);
	});
}

function mainVisual() {
    function v1() {
        $(this).parents("span").find('input').click();
    }
    ;function v2(e) {
        var files = e.target.files[0];
        $(this).parents('span').find('.f_name').text(files.name);
    }
    ;function v3() {
        var col = $(this).data("col");
        $.ajax({
            type: "POST",
            url: "/admin/aniremove",
            data: {
                col : col,
            },
            success: function(data) {
                location.reload();
            }
        });
    }
    ;function v4() {
        var arrow = $(this).attr("data-arrow");
        $.ajax({
            type: "POST",
            url: "/ajax/c-remove.php",
            data: {
                arrow: arrow
            },
            success: function(data) {
                location.reload();
            }
        });
    }

    $(".f_find").on("click", v1);
    $("input[type='file']").on("change", v2);
    $(".bc-remove").on("click", v3);
}
function tog() {
    $('body').on('click', '.f_upload .file-set', function(e) {
        $('.f_upload .file-set-area').toggle();
    })
}
function menuPos() {
    $('body').on('click', '.submenu .menu-pos1', function(e) {
        sessionStorage.setItem('menu', '1');
        $('.submenu .menu-pos1').hide();
        $('.submenu .menu-pos2').show();
    })
    $('body').on('click', '.submenu .menu-pos2', function(e) {
        sessionStorage.setItem('menu', '');
        $("#contents").css({
            "margin-top": "0"
        });
        $('.submenu').slideUp(500);
        $('.submenu .menu-pos1').show();
        $('.submenu .menu-pos2').hide();
    })
    if (sessionStorage.getItem('menu') == '1') {
        $('.submenu').show();
        $("#contents").css({
            "margin-top": "160px"
        });
        $('.submenu .menu-pos1').hide();
        $('.submenu .menu-pos2').show();
    }
}

function menu() {
	$(".menu-add-btn").on('click', function() {
		$.ajax({
			url : "/menu/add",
			data : {
				parent : 0,
			},
			type : "POST",
			success : function(idx) {
				$(".menu-set-list > ul").append(`
	                <li class="parent-menu-list">
	                    <div class="box-area">
	                        <div class="menu-parent-area">
	                            <h4 class="menu-num">1차 메뉴</h4>
	                            <input type="hidden" name="first_idx[]" value="${idx}">
	                            <input type="text" name="first_ttle[]" value="" class="menu_parent_title">

	                            <select name="first_switch[]" id="menu_switch">
									<option value="1">사용</option>	
									<option value="0">사용 안함</option>
								</select>

	                            <button type="button" class="two_menu_add">+ 2차 메뉴 추가</button>

	                            <div class="parent-menu-remove">
	                                <input type="checkbox" name="remove[]" value="${idx}">
	                                <span>이 메뉴와 하위 메뉴를 삭제</span>
	                            </div>
	                        </div>

	                        <!-- 하위 메뉴 리스트 -->
	                        <div class="menu-child-box">
	                            <!-- 2차 메뉴 -->
	                            <ul class="two-menu-wrap">
	                            </ul>
	                        </div>

	                        <div class="menu-fot-control">
	                            <button type="button" class="menu-remove-btn">전체 삭제</button>
	                        </div>
	                    </div>
	                </li>
				`);

				sorTable();
			},
		})
	});

	$(document).on("click", ".two_menu_add", function() {
		var idx = $(this).parents("li").find("input[name='first_idx[]']").val();
		var $ul = $(this).parents("li").find(".two-menu-wrap");

		$.ajax({
			url : "/menu/add",
			data : {
				parent :idx,
			},
			type : "POST",
			success : function(idx) {
				$ul.append(`
					<li class="two-menu">
					    <h4 class="menu-num">2차 메뉴</h4>
					    <input type="hidden" name="sub_idx[]" value="${idx}">
					    <input type="text" name="sub_title[]" value="" class="two_menu_title">

					    <select name="sub_switch[]" id="menu_switch">
					        <option value="1">사용</option>
					        <option value="0">사용 안함</option>
					    </select>

					    <div class="parent-menu-remove">
					        <input type="checkbox" name="remove[]" value="${idx}" >
					        <span>이 메뉴와 하위 메뉴를 삭제</span>
					    </div>
					</li>
				`);
				sorTable();
			},
		})
	});
	sorTable();
}

function board() {
	$(".detail_set").on("click", function() {
		var $prev = $(this).prev();

		if($prev.is(":checked")) {
			$(".set_table").hide();
			$(".set_table").eq($prev.val() - 1).show();
		};
	});

	tog();
}

function popup (url) {
	window.open(url, "", "width=500;height=500");
}

function set() {
	$(".menu-type button").on("click", function() {
		var index = $(".menu-type button").index($(this));

		if(index == 0) {
			var url = $(this).data("loc");

			dd(url);
			$.ajax({
				url : url,
				success : function() {
					alert('처리되었습니다.');
					window.opener.location.reload();
					window.close();
				},
			});
		} else {
			$(".board-connect form").hide().removeClass("active");
			$(".board-connect form").eq(index - 1).show().addClass("active");
		};
	});

	$(".save-btn button").on("click", function() {
		$("form.active").submit();
	});
}

function mp() {
	$(".dan-add-btn button").on("click", function() {
		$.ajax({
			url : "/admin/makedan",
			success : function(idx) {
				$(".dan-list").append(`
					<div class="list dan-item" data-idx="${idx}">
					    <p>1단 : 상단 라인색 : 미설정 하단 라인색 : 미설정 배경색 : 미설정

					    <button type="button" class="main-page-set" >라인 및 배경색 설정</button>
					    <button type="button" class="cont-add" >+ 컨텐츠 추가</button>
					    <span>
					        <input type="checkbox" class="r_chk" name="dan_remove[]" value="${idx}" >
					        삭제
					    </span>

					    <ul class="m-cont">
					    </ul>
					</div>
				`);

				msort();
			},
		});
	});

	$(document)
		.on("click", ".cont-add", function() {
			var $li = $(this).parents(".dan-item");
			var idx = $li.data("idx");

			$.ajax({
				url : "/admin/makedancont",
				type : "POST",
				data : {
					idx : idx,
				},
				success : function(idx) {
					$li.find(".m-cont").append(`
						<li class="cont-item" data-idx="${idx}">
						    <p><span>↕</span> 컨텐츠 : 미설정</p>
						    <button type="button" class="cont-set" >컨텐츠 설정</button>
						    <input type="checkbox" class="r_chk" name="cont_remove[]" value="${idx}" > 삭제
						</li>
					`);
				},
			});
		})
		.on("click", ".main-page-set", function() {
			var idx = $(this).parents(".dan-item").data("idx");
			popup("/admin/maincolor/"+idx);
		})
		.on("click", ".cont-set", function() {
			var idx = $(this).parents(".cont-item").data("idx");
			popup("/admin/maincont/"+idx);
		})

	msort();

	function msort() {
		$(".dan-list").sortable({
			update : function() {
				$(".dan-item").each(function(key, el) {
					var idx = $(el).data("idx");

					$.ajax({
						url : "/admin/dansort",
						data : {
							sort : key + 1,
							idx : idx,
						},
						type : "POST"
					})
				});
			},
		})
	};

	$(".save-btn button").on("click", function() {
		$("input[name='dan_remove[]']:checked").each((idx, el) => {
			$.ajax({
				url : "/admin/danremove/"+$(el).val(),
				success : function() {
					$(el).parents(".dan-item").remove();
				},
			})
		});

		$("input[name='cont_remove[]']:checked").each((idx, el) => {
			$.ajax({
				url : "/admin/dancontremove/"+$(el).val(),
				success : function() {
					$(el).parents(".cont-item").remove();
				},
			})
		});
	});
}