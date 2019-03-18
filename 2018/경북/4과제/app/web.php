<?php

	require "lib.php";

	use Model\_Base as DB;
	use Model\{Map};
	use Middle\{Vail, Middle};

	/* 메인 페이지 */
	Route::get("main/index", function() {
		if(!DB::fetch("member", "id = ?", ['admin'])) {
			DB::insert("member", [
				"id" => "admin",
				"pw" => "1234",
				"name" => "관리자",
				"type" => "관리자",
			]);
		};
		View::open("index");
	});

	/*로그인 페이지*/
	Route::get("member/login", function() {
		View::open("login");
	});

	Route::post("member/login", function () {
		$member = DB::fetch("member", "id = ? && pw = ?", [$_POST['id'], $_POST['pw']]);

		if($member) {
			$_SESSION["login"] = $member;
			$dir = ["/", "로그인이 완료되었습니다."];
		} else {
			$dir = ["back", "존재하지 않는 아이디 이거나 비밀번호를 잘못입력 하셨습니다."];
		};

		redirect(...$dir);
	});

	/*로그아웃*/
	Route::get("member/logout", function() {
		session_destroy();
		redirect("/", "로그아웃이 완료되었습니다.");
	});

	/*회원가입 페이지*/
	Route::get("member/join", function() {
		View::open("join");
	});

	Route::post("member/join", function() {
		$label = $_POST["type"] == "고객사" ? "회사명" : "차량주명";

		Vail::required([
			"id" => "아이디는",
			"pw" => "비밀번호는",
			"name" => $label."는",
			"phone" => "전화번호는",
			"weight" => "차량적재량은",
		]);

		if($_POST["id"] != "" && !filter_var($_POST["id"], FILTER_VALIDATE_EMAIL)) {
			Vail::$message[] = "아이디는 이메일 형식 이여야 합니다.";
		};

		if($_POST["pw"] != "" && (!preg_match('/^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]{8,}$/', $_POST['pw']) || preg_match('/(.)\1\1\1+/', $_POST['pw']) )) {
			Vail::$message[] = "비밀번호 형식을 맞춰주세요.";
		};

		if($_POST["name"] != "" && !preg_match('/^[a-zA-Z가-힣]+$/u', $_POST["name"])) {
			Vail::$message[] = $label." 형식을 맞춰주세요.";
		};

		if($_POST["phone"] != "" && !preg_match('/^\d{2,3}\-\d{3,4}\-\d{4}$/', $_POST["phone"])) {
			Vail::$message[] = "전화번호 형식을 맞춰주세요.";
		};

		if(DB::fetch("member", "id = ?", [$_POST["id"]]))
			Vail::$message[] = "중복되는 아이디 입니다.";

		if(!Vail::$message) {
			DB::insert("member", $_POST);
			$dir = ["/", "회원가입이 완료되었습니다."];
		} else {
			$dir = ['back', Vail::$message];
		};

		redirect(...$dir);
	});

	/*관리자 페이지 */
	Route::get("admin/index", function() {
		$map = json_decode(file_get_contents(ROOT."/storage/distance.json"), true);
		DB::mq("TRUNCATE `map`", []);

		foreach ($map as $start => $ways) {
			foreach ($ways as $end => $spend) {
				DB::insert("map", [
					"start" => $start,
					"end" => $end,
					"spend" => $spend,
				]);
			};
		};

		$maps = Map::getAll();

		View::open("adminpos", [
			"maps" => $maps,
		]);
	});

	/* 물류배송신청 페이지 */
	Route::get("product/contract", function() {
		View::open("contract");
	});
	Route::post("product/contract", function() {
		Vail::required([
			"weight" => "배송중량은",
			"location" => "배송지역은",
			"order_date" => "배송일은"
		]);

		$order_date = changeDate($_POST["order_date"]);

		if(!Vail::$message) {
			$_POST["order_date"] = $order_date;
			$insert = $_POST;
			$insert["state"] = "접수대기";
			$idx = DB::insert("product", $insert);

			$code = date("Ymd")."-".(date("a") == "am" ? "A" : "B").date("his")."-".sprintf("%04d", $idx);

			DB::update('product', [
				"code" => $code,
			], "idx = ?", [$idx]);

			$dir = ["/product/delivery", "물류배송신청이 완료되었습니다."];
		} else {
			$dir = ["back", Vail::$message];
		};

		redirect(...$dir);
	});

	/* 물류배송추척 페이지 */
	Route::get("product/delivery", function() {
		$code = $_GET["code"] ?? "";
		$search_list = [];

		if($code == "") {
			if(USER) {
				$search_list = DB::fetchAll("product", "user_id = ? order by create_date desc", [USER['id']]);
			};
		} else {
			$search_list = DB::fetchAll("product", "code = ?", [$code]);
		};

		foreach ($search_list as $key => &$data) {
			if($data["truck"] != 0) {
				$truck = DB::fetch("truck", "idx = ?", [$data["truck"]]);
				$locations = explode("-", $truck["location"]);

				$now = array_find($truck["now_location"], $locations);
				$user_key = array_find($data["location"], $locations);

				if($user_key > $now) {
					$user_key = $now;
				};

				$data["user_loc"] = join("-", array_slice($locations, 0, $user_key + 1));
				$data["user_now"] = $locations[$user_key];

				$data["truck"] = $truck;
			};
		};	

		View::open("delivery", [
			"search_list" => $search_list,
		]);
	});

	/* 지입차량주POS 페이지 */
	Route::get("product/manager", function() {
		$trucks = DB::fetchAll("truck", "user_id = ?", [USER["id"]]);
		$now = strtotime(date("Y-m-d"));

		foreach ($trucks as $key => &$truck) {
			$products = DB::fetchAll("product", "idx IN(".$truck["product_idx"].")");
			$truck["products"] = $products;
		};

		usort($trucks, function($a, $b) use ($now) {
			return abs(strtotime($a["order_date"]) - $now) <=> abs(strtotime($b["order_date"]) - $now);
		});

		View::open("manager", [
			"trucks" => $trucks,
		]);
	});

	/* 검색결과 가져오기 */
	Route::post("ajax/getData", function() {
		$date = changeDate($_POST['date']);
		$product_list = DB::fetchAll("product", "order_date = ? && state = ? order by idx asc", [$date, "접수대기"]);
		$map = Map::getAll();

		$search = Middle::getWeight($product_list);

		$nice_weight = $search[0];
		$weight_list = $search[1];

		$weight_list = array_map(function($arr) {
			return array_map(function($idx) {
				return DB::fetch("product", "idx = ?", [$idx]);
			}, $arr);
		}, $weight_list);

		foreach ($weight_list as $key => &$weight) {
			$fast = Middle::getFast($weight, $map);

			$weight["fast_list"] = $fast[0];
			$weight["fast_spend"] = $fast[1];
		};

		View::get("search_table", [
			"nice_weight" => $nice_weight,
			"weight_list" => $weight_list,
			"date" => $_POST["date"],
		]);
	});

	Route::post("product/ok", function() {
		$key = $_POST["point"];
		$product_idx = $_POST["product_idx"][$key];
		$order_date = $_POST['order_date'][$key];
		$weight = $_POST["weight"][$key];
		$spend = $_POST['spend'][$key];
		$way = $_POST["way".$key];

		$overlap = DB::rowCount("product", "idx IN(".$product_idx.") && state != ?", ["접수대기"]);

		if($overlap != 0) {
			redirect("back", "이미 다른 지입차량주가 인수한 물품이 존재합니다.");
		};

		$idx = DB::insert("truck", [
			"user_id" => USER["id"],
			"product_idx" => $product_idx,
			"order_date" => $order_date,
			"weight" => $weight,
			"spend" => $spend,
			"location" => $way,
			"state" => "배송대기",
		]);

		DB::update("product", [
			"state" => "배송대기",
			"truck" => $idx,
		], "idx IN(".$product_idx.")");

		redirect("/product/manager", "인수가 완료되었습니다.");
	});

	Route::get("truck/start", function($idx) {
		DB::update("truck", [
			"state" => "배송중",
		], "idx = ?", [$idx]);

		DB::update('product', [
			"state" => "배송중",
		], "truck = ?", [$idx]);

		redirect("/product/manager", "배송이 시작되었습니다.");
	});

	Route::get("truck/move", function() {
		$truck_idx = $_GET["truck"];
		$location = $_GET["location"];

		$truck = DB::fetch('truck', "idx = ?", [$truck_idx]);
		$locations = explode("-", $truck["location"]);

		$now = array_find($truck["now_location"], $locations);
		$move = array_find($location, $locations);

		if($now != $move - 1) {
			redirect("/product/manager", "배송경로 순으로 버튼을 클릭해주세요.");
		};

		DB::update("truck", [
			"now_location" => $location,
			"state" => end($locations) == $location ? "배송완료" : "배송중",
		], "idx = ?", [$truck['idx']]);

		DB::update("product", [
			"state" => "배송완료",
		], "truck = ? && location = ?", [$truck['idx'], $location]);

		redirect("/product/manager", $location."지역 배송이 완료되었습니다.");
	});

	/* 트럭정보 페이지 */
	Route::get("truck/info", function($idx) {
		$product = DB::fetch("product", "idx = ?", [$idx]);
		if($product["state"] == "배송완료") {
			redirect("/", "잘못된 접근 입니다.");
		};

		$truck = DB::fetch("truck", "idx = ?", [$product["truck"]]);
		$user = DB::fetch("member", "id = ?", [$truck["user_id"]]);

		View::open('truck-info', [
			"truck" => $truck,
			"user" => $user,
		]);
	});

	Route::disPatch();