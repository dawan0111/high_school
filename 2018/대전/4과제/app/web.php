<?php

	require "lib.php";

	use Model\_Base as DB;
	use Middle\{Vail};

	use Model\{Food, Basket};

	Route::get("main/index", function() {
		if(!DB::fetch("member", "id = ?", ["master"])) {
			DB::insert("member", [
				"type" => 3,
				"id" => "master",
				"pw" => "1234",
				"name" => "관리자",
			]);
		};

		View::open("index");
	});

	Route::get("member/login", function() {
		View::open('login');
	});

	Route::get("member/join", function() {
		View::open("join");
	});

	Route::post("member/join", function() {
		Vail::required([
			"id" => "아이디는",
			"name" => "성명은",
			"pw" => "비밀번호는",
			"type" => "회원구분은",
			"phone" => "전화번호는",
			"offset" => "위치좌표는",
		]);

		Vail::regex([
			"id" => ['/^[a-zA-Z]{4,12}$/', "아이디 형식을 맞춰주세요."],
			"name" => ['/^[가-힣]{2,4}$/u', "이름 형식을 맞춰주세요."],
			"pw" => ['/^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]{4,8}$/', "비밀번호 형식을 맞춰주세요."],
			"phone" => ['/^\d{4}\-\d{4}\-\d{4}$/', "전화번호 형식을 맞춰주세요."],
		]);

		if(DB::fetch("member", "id = ?", [$_POST["id"]])) {
			Vail::$message[] = "중복되는 아이디 입니다.";
		};

		if(!Vail::$message) {
			$_POST['offset'] = str_replace(" ", "", $_POST["offset"]);
			DB::insert("member", $_POST);

			$dir = ["/member/login", "회원가입이 완료되었습니다."];
		} else {
			$dir = ["back", Vail::$message];
		};

		redirect(...$dir);
	});

	Route::post("member/login", function() {
		$member = DB::fetch("member", "id = ? && pw = ?", [$_POST["id"], $_POST["pw"]]);

		if($member) {
			$_SESSION["login"] = $member;
			$dir = ["/", "로그인이 완료되었습니다."];
		} else {
			$dir = ["back", "존재하지 않는 아이디 이거나 비밀번호를 잘못입력 하셨습니다."];
		};

		redirect(...$dir);
	});

	Route::get("member/logout", function() {
		session_destroy();
		redirect("/", "로그아웃이 완료되었습니다.");
	});

	Route::get("member/modify", function() {
		View::open("myinfomodify");
	});

	Route::post("member/modify", function() {
		$_POST["pw"] = $_POST["pw"] == "" ? USER["pw"] : $_POST['pw'];
		$update = [
			"offset" => str_replace(" ", "", $_POST["offset"]),
		];

		if(preg_match('/^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]{4,8}$/', $_POST["pw"])) {
			$update["pw"] = $_POST["pw"];
		};

		if(preg_match('/^\d{4}\-\d{4}\-\d{4}$/', $_POST["phone"])) {
			$update["phone"] = $_POST["phone"];
		};

		DB::update("member", $update, "idx = ?", [USER['idx']]);
		$_SESSION["login"] = DB::fetch('member', "idx = ?", [USER['idx']]);

		redirect("/member/modify", "올바르게 입력한 정보만 수정되었습니다.");
	});

	Route::get("store/index", function() {
		$extend = [];

		if(USER["type"] != 3) {
			$store = DB::fetch("store", "user_idx = ?", [USER["idx"]]);
			$foods = Food::getAll("user_idx = ?", [USER['idx']], "order by create_date desc");
			$order_list = Basket::getAll("s_user_idx = ?", [USER['idx']], "order by basket.buy_date desc");

			$prev = "";

			foreach ($order_list as $key => &$data) {
				if($prev != $data["buy_date"]."|".$data["order_user"]) {
					$row = array_filter($order_list, function($arr) use ($data) {
						return $arr["buy_date"]."|".$arr["order_user"] == $data["buy_date"]."|".$data["order_user"];
					});

					$data["row"] = count($row);
					$data["row_sum"] = sum($row);
					$data["member"] = DB::fetch("member", "idx = ?", [$data["order_user"]]);
				};

				$prev = $data["buy_date"]."|".$data["order_user"];
			};

			$extend["order_list"] = $order_list;
			$extend["store"] = $store;
			$extend["foods"] = $foods;
		} else {
			$user = $_GET["user"] ?? "";
			$foods = Food::getAll("user_idx = ?", [$user], "order by create_date desc");
			$ranking = Food::getAll(1, [], "order by quantity desc limit 0, 5");

			foreach ($ranking as $key => &$data) {
				$data["store_name"] = DB::fetch("store", "user_idx = ?", [$data["user_idx"]])["store_name"];
			};

			$extend["ranking"] = $ranking;
			$extend["foods"] = $foods;
			$extend["user"] = $user;
			$extend["store"] = DB::fetchAll("store");
		};

		View::open("affiliation", $extend);
	});

	Route::post("store/action", function() {
		$file = $_FILES["file"];

		Vail::required([
			"kind" => "가맹점분류는",
			"store_name" => "가맹점명은",
		]);

		if($file["name"] == "" && !isset($_POST["idx"])) {
			Vail::$message[] = "파일을 선택해주세요.";
		};

		if($file["name"] != "" && !preg_match('/^image\/.+$/', $file["type"])) {
			Vail::$message[] = "이미지 파일을 선택해주세요.";
		};

		if(!Vail::$message) {
			$store = DB::fetch("store", "idx = ?", [$_POST["idx"] ?? 0]);
			$filename = $store["logo"] ?? "";

			if($file["name"] != "") {
				$filename = date("YmdHis").rand(11, 9999)."_".$file["name"];
				move_uploaded_file($file["tmp_name"], ROOT."/upload/".$filename);
			};	
			$_POST["logo"] = $filename;

			if($store) {
				$idx = $_POST["idx"]; 
				unset($_POST["idx"]);

				DB::update("store", $_POST, "idx = ?", [$idx]);
			} else {
				$_POST["user_idx"] = USER['idx'];
				DB::insert("store", $_POST);
			};

			$dir = ["/store/index", "처리되었습니다."];
		} else {
			$dir = ["back", Vail::$message];
		};

		redirect(...$dir);
	});

	Route::post("food/add", function() {
		Vail::required([
			"food_name" => "메뉴이름은",
			"food_price" => "가격은",
		]);

		Vail::regex([
			"food_price" => ['/^[0-9]+$/', "가격은 0이상의 정수로 입력해주세요."],
		]);

		if(!Vail::$message) {
			$_POST["user_idx"] = USER['idx'];
			DB::insert("food", $_POST);
			$dir = ["/store/index", "추가되었습니다."];
		} else {
			$dir = ["back", Vail::$message];
		};

		redirect(...$dir);
	});

	Route::get("food/delete", function($idx) {
		if(DB::rowCount("basket", "food_idx = ? && lavel = 1", [$idx])) {
			redirect("back", "배송중인 음식은 삭제가 불가능 합니다.");
		};

		Food::update("food", ["del" => 1], "idx = ?", [$idx]);
		DB::delete("basket", "food_idx = ? && lavel = 0", [$idx]);

		redirect("/store/index", "삭제되었습니다.");
	});
	
	Route::get("order/index", function() {
		$kind = $_GET['kind'] ?? "";
		$keyword = $_GET["keyword"] ?? "";
		$sort = $_GET["sort"] ?? "";

		$where = [];
		$param = [];
		$sort_sql = "";

		if($kind != "") {
			$where[] = "store.kind = ?";
			$param[] = $kind;
		};

		if($keyword != "") {
			$where[] = "store.store_name LIKE ?";
			$param[] = "%".$keyword."%";
		};

		if($sort == "review") {
			$sort_sql = "ORDER BY review desc, star desc";
		};
		if($sort == "star") {
			$sort_sql = "ORDER BY star desc, review desc";
		};

		if($where) {
			$where_sql = join(" && ", $where);
		} else {
			$where_sql = 1;
		};

		$user = explode(",", USER["offset"]);
		$store_list = DB::fetchAll(
			"
				store
				LEFT JOIN review
				ON store.user_idx = review.s_user_idx
				LEFT JOIN food
				ON store.user_idx = food.user_idx && food.del = 0
			",
			$where_sql." GROUP BY store.user_idx HAVING COUNT(DISTINCT food.idx) > 0 ".$sort_sql,
			$param,
			"
				store.*,
				ROUND(IFNULL(AVG(review.star), 0)) as star,
				COUNT(DISTINCT review.idx) as review,
				(SELECT offset FROM member WHERE idx = store.user_idx) as offset
			"
		);

		foreach ($store_list as $key => &$data) {
			$s = explode(",", $data["offset"]);

			$x = ($user[0] - $s[0]) ** 2;
			$y = ($user[1] - $s[1]) ** 2;

			$data["dir"] = sqrt($x + $y);
		};

		if($sort == "dir") {
			usort($store_list, function($a, $b) {
				return $a["dir"] <=> $b["dir"];
			});
		};

		View::open("order", [
			"kind" => $kind,
			"keyword" => $keyword,
			"sort" => $sort,
			"store_list" => $store_list
		]);
	});

	Route::get("order/map", function() {
		$user_idx = explode(",", $_GET["user_idx"] ?? "");
		$chk = $_GET["chk"] ?? -1;
		$user = explode(",", USER["offset"]);

		$canvas = imagecreatetruecolor(717, 350);
		$map = imagecreatefromjpeg(ROOT."/assets/images/map.jpg");

		$red = imagecreatefrompng(ROOT."/assets/images/red_map_marker.png");
		$blue = imagecreatefrompng(ROOT."/assets/images/blue_map_marker.png");
		$pink = imagecreatefrompng(ROOT."/assets/images/pink_map_marker.png");

		imagecopy($canvas, $map, 0, 0, 0, 0, 717, 350);
		imagecopy($canvas, $red, $user[0] - 10, $user[1] - 31, 0, 0, 20, 31);

		foreach ($user_idx as $key => $idx) {
			if($idx == "")
				continue;

			$user = DB::fetch("member", "idx = ?", [$idx]);
			$offset = explode(",", $user["offset"]);

			$image = $chk == $idx ? $pink : $blue;
			imagecopy($canvas, $image, $offset[0] - 10, $offset[1] - 31, 0, 0, 20, 31);
		};

		header("Content-type:image/png");
		imagepng($canvas);
	});

	Route::get("order/menu", function($idx) {
		$store = DB::fetch('store', "user_idx = ?", [$idx]);
		$foods = Food::getAll("user_idx = ?", [$idx]);
		$review = DB::rowCount('review', "s_user_idx = ?", [$idx]);
		$baskets = Basket::getAll("basket.lavel = 0 && basket.user_idx = ?", [USER['idx']]);

		View::open("order-menu", [
			'store' => $store,
			"foods" => $foods,
			"baskets" => $baskets,
			"review" => $review,
		]);
	});

	Route::post("basket/add", function() {
		$food = DB::fetch("food", "idx = ?", [$_POST["food_idx"]]);

		DB::insert("basket", [
			"food_idx" => $food["idx"],
			"s_user_idx" => $food["user_idx"],
			"quantity" => $_POST["quantity"],
			"user_idx" => USER['idx'],
		]);
	});

	Route::get("basket/delete", function($idx) {
		DB::delete("basket", "idx = ?", [$idx]);
		redirect("back");
	});

	Route::get("basket/clear", function() {
		DB::delete("basket", "user_idx = ? && lavel = 0", [USER['idx']]);
		redirect("back");
	});

	Route::get("order/success", function() {
		$basket = DB::rowCount("basket", "user_idx = ? && lavel = 0", [USER['idx']]);

		if($basket == 0) {
			redirect("back", "주문함에 한개 이상의 음식을 넣어주세요.");
		};

		DB::update("basket", [
			"lavel" => 1,
			"buy_date" => date("Y-m-d H:i:s"),
			"date" => date("Y-m-d"),
		], "user_idx = ? && lavel = 0", [USER['idx']]);

		redirect("/order/list", "결제가 완료되었습니다.");
	});

	Route::get("order/list", function() {
		$user = $_GET["user"] ?? USER['idx'];
		$user = $user == "" ? 0 : $user;

		$user_sql = "basket.lavel > 0 && basket.user_idx = ".$user;

		$baskets = Basket::getAll($user_sql, [], "order by basket.buy_date desc, basket.s_user_idx desc");

		$prev_date = "";
		$prev_order = "";
		$prev_store = "";

		foreach ($baskets as $key => &$data) {
			if($prev_date != $data["date"]) {
				$data["ymd_count"] = DB::rowCount("basket", $user_sql." && date = ?", [$data["date"]]);

				$prev_order = "";
				$prev_store = "";
			};

			if($prev_order != $data["buy_date"]) {
				$order = Basket::getAll($user_sql." && buy_date = ?", [$data["buy_date"]]);

				$data["order_count"] = count($order);
				$data["order_sum"] = sum($order);

				$prev_store = "";
			};

			if($prev_store != $data["s_user_idx"]) {
				$store = DB::rowCount("basket", $user_sql." && buy_date = ? && s_user_idx = ?", [$data["buy_date"], $data["s_user_idx"]]);
				$data["store_count"] = $store;
			};

			$prev_date = $data["date"];
			$prev_order = $data["buy_date"];
			$prev_store = $data["s_user_idx"];
		};

		View::open("details", [
			"baskets" => $baskets,
			"members" => DB::fetchAll("member", "type = 1"),
			"user" => $user,
		]);
	});

	Route::get("order/ok", function() {
		DB::update("basket", [
			"lavel" => 2,
		], "user_idx = ? && buy_date = ? && s_user_idx = ?", [$_GET["user"], $_GET["buy_date"], USER['idx']]);

		redirect("/store/index", "배송이 완료되었습니다.");
	});

	Route::get("review/write", function() {
		$review = DB::fetch("review", "s_user_idx = ? && user_idx = ? && buy_date = ?", [$_GET['s_user_idx'], USER['idx'], $_GET['buy_date']]);
		$store = DB::fetch("store", "user_idx = ?", [$_GET['s_user_idx']]);

		if($review) {
			redirect("/order/list", "이미 리뷰를 작성하셨습니다.");
		};

		View::open("details-review", [
			"store" => $store,
		]);
	});

	Route::post("review/write", function() {
		Vail::required([
			"star" => "평점은",
			"content" => "내용은",
		]);

		$_POST["user_id"] = USER['id'];
		$_POST["user_name"] = USER['name'];
		$_POST["user_idx"] = USER['idx'];

		DB::insert("review", $_POST);

		redirect("/order/list", "리뷰작성이 완료되었습니다.");
	});

	Route::get("review/index", function($idx) {
		$reviews = DB::fetchAll("review", "s_user_idx = ? order by create_date desc", [$idx]);

		View::open("order-review", [
			"reviews" => $reviews,
			"store" => DB::fetch("store", "user_idx = ?", [$idx]),
		]);
	});


	Route::disPatch();