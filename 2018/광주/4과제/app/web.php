<?php

	require "lib.php";

	use Model\_Base as DB;

	Route::get("main/index", function() {
		$ani = DB::fetch("ani");
		$ani_image = [];

		for ($i=1; $i <= 3; $i++) { 
			$ani_image[] = $ani["img".$i];
		};

		View::open("index", [
			"ani" => $ani,
			"ani_image" => $ani_image,
		]);
	});

	Route::get("member/logout", function() {
		session_destroy();
		redirect("/");
	});

	Route::get("admin/index", function() {
		if(!USER)
			redirect("/admin/login");

		View::admin("index");
	});

	Route::get("admin/login", function() {
		View::admin('login');
	});

	Route::post("admin/login", function() {
		$member = DB::fetch("member", "userid = ? && pw = ?", [$_POST["userid"], $_POST["pw"]]);

		if($member) {
			$_SESSION["login"] = $member;
			$dir = ["/admin/index", "로그인이 완료되었습니다."];
		} else {
			$dir = ["back", "로그인을 실패하셨습니다."];
		};

		redirect(...$dir);
	});

	Route::get("admin/menu", function() {
		DB::delete("menu", "ok = 0");
		View::admin("menu_set");
	});

	Route::post("menu/add", function() {
		$idx = DB::insert("menu", [
			"parent" => $_POST["parent"],
		]);

		echo $idx;
	});

	Route::post("menu/save", function() {
		foreach ($_POST["first_idx"] ?? [] as $key => $idx) {
			DB::update("menu", [
				"ok" => 1,
				"name" => $_POST["first_title"][$key],
				"active" => $_POST["first_switch"][$key],
				"sort" => $key,
			], "idx = ?", [$idx]);
		};

		foreach ($_POST["sub_idx"] ?? [] as $key => $idx) {
			DB::update("menu", [
				"ok" => 1,
				"name" => $_POST["sub_title"][$key],
				"active" => $_POST["sub_switch"][$key],
				"sort" => $key,
			], "idx = ?", [$idx]);
		};

		foreach ($_POST["remove"] ?? [] as $key => $idx) {
			DB::delete('menu', "idx = ? || parent = ?", [$idx, $idx]);
		};

		redirect("/admin/menu");
	});

	Route::get("admin/board", function() {
		View::admin("board-set");
	});

	Route::get('admin/boardadd', function() {
		View::admin("board-set-add");
	});

	Route::get("admin/boardmodify", function($idx) {
		View::admin("board-set-modify", [
			"board" => DB::fetch("board_set", "idx = ?", [$idx]),
		]);
	});

	Route::post("admin/boardAction", function() {
		if($_POST["name"] == "")
			redirect("back", "게시판 이름을 적어주세요.");

		$idx = $_POST['idx'] ?? "";
		$type = $_POST["board_type"];

		$page_cnt = $_POST["page_cnt".$type];
		$line_cnt = $type == 3 ? $_POST["line_cnt"] : 1;

		$insert = [
			'name' => $_POST["name"],
			"page_cnt" => $page_cnt,
			"line_cnt" => $line_cnt,
			"type" => $type,
			"upload_cnt" => $_POST["file_cnt"],
			"upload_size" => $_POST["f_size"]
		];

		if($idx == "") {
			DB::insert("board_set", $insert);
		} else {
			DB::update("board_set", $insert, "idx = ?", [$idx]);
		};

		redirect("/admin/board");
	});	

	Route::get("admin/boarddelete", function($idx) {
		DB::delete("board_set", "idx = ?", [$idx]);
		redirect("/admin/board");
	});

	Route::get("admin/ani", function() {
		View::admin("main-image-design", [
			"ani" => DB::fetch("ani"),
		]);
	});

	Route::post("admin/ani", function() {
		$ani = DB::fetch("ani");
		$update = $_POST;
		$files = $_FILES;

		for ($i=1; $i <= 3; $i++) { 
			$key = "img".$i;
			$file = $files[$key];

			if($file["name"] == "") {
				$update[$key] = $ani[$key];
			} else {
				$filename = fu($file);
				$update[$key] = $filename;
			};
		}

		DB::update('ani', $update);

		redirect("/admin/ani");
	});

	Route::post("admin/aniremove", function() {
		$update = [];
		$update[$_POST["col"]] = "";

		Db::update("ani", $update);
	});

	Route::get("admin/menucont", function() {
		View::admin("menu-contents");
	});

	Route::get("admin/menucontset", function($idx) {
		View::popup("menu-contents", [
			"idx" => $idx,
			"board" => DB::fetchAll("board_set"),
		]);
	});

	Route::get("admin/menuclear", function($idx) {
		DB::update("menu", [
			"type" => "",
		], "idx = ?", [$idx]);
	});

	Route::post("admin/menuset", function($idx) {
		DB::update("menu", [
			"board" => $_POST["board"] ?? "",
			"html" => $_POST["text"] ?? "",
			"type" => $_POST["type"],
		], "idx = ?", [$idx]);

		popupClose();
	});

	Route::get("admin/main", function() {
		View::admin("main-page");
	});

	Route::get("admin/makedan", function() {
		$sort = DB::fetch("dan", "1", [], "MAX(sort) as sort")["sort"] ?? 0;

		$idx = DB::insert("dan", [
			"sort" => ++$sort,
		]);

		echo $idx;
	});

	Route::post("admin/makedancont", function() {
		$idx = $_POST["idx"];

		$idx = DB::insert("dan_content", [
			"dan_idx" => $idx,
		]);

		echo $idx;
	});

	Route::post("admin/dansort", function() {
		DB::update("dan", [
			"sort" => $_POST["sort"],
		], "idx = ?", [$_POST["idx"]]);
	});

	Route::get("admin/maincolor", function($idx) {
		View::popup("main-page-color", [
			"dan" => DB::fetch("dan", "idx = ?", [$idx]),
			"idx" => $idx,
		]);
	});

	Route::post("admin/colorpicker", function() {
		View::popup("color-picker");
	});

	Route::post("admin/maincolor", function($idx) {
		DB::update("dan", $_POST, "idx = ?", [$idx]);
		popupClose();
	});

	Route::get("admin/maincont", function($idx) {
		View::popup("main-page-cont-set", [
			"cont" => DB::fetch("dan_content", "idx = ?", [$idx]),
			"idx" => $idx,
			"board" => DB::fetchAll("board_set"),
		]);
	});

	Route::get("admin/dancontclear", function($idx) {
		DB::update("dan_content", [
			"type" => "",
			"def_img" => "",
			"over_img" => "",
		], "idx = ?", [$idx]);
	});

	Route::post("admin/maincontset", function($idx) {
		$dan = DB::fetch("dan", "idx = ?", [$idx]);

		if($_POST["type"] == "banner") {
			$def_img = $_FILES["def_img"];
			$over_img = $_FILES["over_img"];

			$regex = '/^image\/(jpeg|png|gif)$/';

			if($def_img["name"] == "" && $dan["def_img"] == "")
				redirect("back", "기본 이미지를 선택해주세요.");

			if(
				($def_img["name"] != "" && !preg_match($regex, $def_img["type"])) ||
				($over_img["name"] != "" && !preg_match($regex, $over_img["type"]))
			) {
				redirect("back", "GIF, JPG, PNG 파일을 선택해주세요.");
			};

			$def_name = $def_img["name"] != "" ? fu($def_img) : $dan["def_img"];
			$over_name = $over_img["name"] != "" ? fu($over_img) : $dan["over_img"];

			DB::update("dan_content", [
				"type" => "banner",
				"def_img" => $def_name,
				"over_img" => $over_name,
				"link" => $_POST['link'],
				"link_type" => $_POST["link_type"],
			], "idx = ?", [$idx]);
		} else {
			if($_POST["board"] == "")
				redirect("back", "게시판을 선택하세요.");

			DB::update("dan_content", [
				"type" => "board",
				"board" => $_POST["board"],
			], "idx = ?", [$idx]);
		};

		popupClose();
	});

	Route::get("admin/danremove", function($idx) {
		DB::delete("dan", "idx = ?", [$idx]);
	});

	Route::get("admin/dancontremove", function($idx) {
		DB::delete("dan_content", "idx = ?", [$idx]);
	});

	Route::get("menu/cont", function($idx) {
		View::open("menu_content", [
			"idx" => $idx,
		]);
	});

	Route::get("board/write", function($idx) {
		View::open("bd-write", [
			"board_set" => DB::fetch("board_set", "idx = ?", [$idx]),
		]);
	});
	Route::post("board/write", function($idx) {
		$filename = [];
		$board_set = DB::fetch("board_set", "idx = ?", [$idx]);
		$files = $_FILES;

		$insert = $_POST;

		for ($i=0; $i < $board_set["upload_cnt"]; $i++) { 
			$file = $files["file".($i + 1)];
			$filename[$i] = "";

			if($file["name"] != "") {
				$filename[$i] = fu($file);
			};
		};

		$insert["file"] = join(">", $filename);
		$insert["bds_idx"] = $idx;
		$insert["memberIdx"] = 1;

		DB::insert("board", $insert);

		redirect("/menu/cont/".$_SESSION['menu']['idx']);
	});

	Route::get("board/view", function($idx) {
		View::open("bd-view", [
			"idx" => $idx,
		]);
	});

	Route::get("board/delete",  function($idx) {
		DB::delete("board", "idx = ?", [$idx]);
		redirect("/menu/cont/".$_SESSION["menu"]['idx']);
	});

	Route::get("board/modify", function($idx) {
		View::open("bd-modify", [
			"idx" => $idx,
		]);
	});

	Route::post("board/modify", function($idx) {
		$board = DB::fetch("board", "idx = ?", [$idx]);
		$board_set = DB::fetch("board_set", "idx = ?", [$board["bds_idx"]]);

		$filename = explode(">", $board["file"]);
		$files = $_FILES;

		$insert = $_POST;

		for ($i=0; $i < $board_set["upload_cnt"]; $i++) { 
			$file = $files["file".($i + 1)];

			if($file["name"] != "") {
				$filename[$i] = fu($file);
			};
		};

		$insert["file"] = join(">", $filename);

		DB::update("board", $insert, "idx = ?", [$idx]);

		redirect("/menu/cont/".$_SESSION['menu']['idx']);
	});

	Route::disPatch();