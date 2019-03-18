<?php

	require "lib.php";

	use Model\{DB, Event};

	Route::get("main/index", function() {
		if(DB::rowCount("SELECT * FROM `event`") == 0) {
			DB::insert("event", [
				"kind" => "독거노인돕기",
				"count" => 1,
				"time" => 1,
			]);
			DB::insert("event", [
				"kind" => "불우아동돕기",
				"count" => 1,
				"time" => 1,
			]);
		};


		$event_time = Event::getNow();
		$event_list = Event::getList("time = ? ORDER BY `count` ASC, `kind` ASC", [$event_time]);
		$numbers = [];

		if($event_time > 1) {
			$numbers = Event::getJoin("e.time = ?", [$event_time - 1]);
			$numbers = Event::sortSuccess($numbers);

			$numbers = array_reduce($numbers, "array_merge", []);

			foreach ($numbers as $key => &$number) {
				$number["point"] = Event::getSuccessPoint($number["eidx"]);
			};
		};

		View::open("index", [
			"event_time" => $event_time,
			"event_list" => $event_list,
			"notices" => DB::find("notice", "1 ORDER BY `date` DESC limit 0, 5")->fetchAll(),
			"numbers" => $numbers,
			"give" => [
				"old" => DB::find("give", "kind = ?", ["독거노인돕기"], "SUM(price) as price")->fetch()["price"],
				"child" => DB::find("give", "kind = ?", ["불우아동돕기"], "SUM(price) as price")->fetch()["price"],
			]
		]);
	});

	Route::get("notice/index", function() {
		View::open("sub3", [
			"notices" => DB::find("notice", "1 order by date desc")->fetchAll(),
			"title" => "공지사항",
		]);
	});

	Route::get("notice/view", function($idx) {
		View::open("sub3_view", [
			"notice" => DB::find("notice", "idx = ?", [$idx])->fetch(),
		]);
	});

	Route::get("event/success", function() {
		$time = $_GET["time"] ?? Event::getNow() - 1;
		$kind = $_GET["kind"] ?? "독거노인돕기-1";

		$kind = explode("-", $kind);

		$numbers = Event::getJoin("e.time = ? && e.kind = ? && e.count = ?", [$time, $kind[0], $kind[1]]);
		$numbers = Event::sortSuccess($numbers, "all");

		$numbers = array_reduce($numbers, "array_merge", []);

		foreach ($numbers as $key => &$number) {
			$number["point"] = Event::getSuccessPoint($number["eidx"]);
		};

		usort($numbers, function($a, $b) {
			return count($b["success"]) - $b["diff"] / 10000 <=> count($a["success"]) - $a["diff"] / 10000;
		});

		View::open("sub2", [
			"numbers" => $numbers,
			"time" => $time,
			"kind" => $kind[0],
			"count" => $kind[1],
			"rooms" => DB::find("event", "time = ? ORDER BY `count` ASC, `kind` ASC", [$time])->fetchAll(),
			"max" => Event::getNow() - 1,
			"title" => "당첨자 보기",
		]);
	});

	/* member */
	if(!isset($_SESSION["login"])) {
		Route::get("member/login", function() {
			View::open("login");
		});

		Route::get("member/join", function() {
			View::open("join");
		});

		Route::post("member/join", function() {
			$msg = [];

			required([
				[$_POST['id'], "아이디는"],
				[$_POST['pw'], "비밀번호는"],
				[$_POST['name'], '이름은']
			], $msg);

			if( DB::fetch("SELECT * FROM `member` WHERE `id` = ?", [$_POST["id"]]) ) {
				$msg[] =  "중복되는 아이디 입니다.";
			};

			if(!$msg) {
				$_POST["point"] = 1000000;
				$midx = DB::insert("member", $_POST);

				DB::insert("message", [
					"target" => $midx,
					"title" => "회원가입을 축하합니다.",
					"content" => "회원가입을 축하합니다.",
				]);

				$dir = ["/", "회원가입이 완료되었습니다."];
			} else {
				$dir = ["back", $msg];
			};

			redirect(...$dir);
		});

		Route::post("member/login", function() {
			$member = DB::fetch("SELECT * FROM `member` WHERE `id` = ? && pw = ?", [$_POST['id'], $_POST['pw']]);

			if($member) {
				$dir = ["/", "로그인이 완료되었습니다."];
				$_SESSION["login"] = $member;
			} else {
				$dir = ["/member/login", "존재하지 않는 아이디 이거나 비밀번호를 잘못입력 하셨습니다."];
			}

			redirect(...$dir);
		});
	};

	if(isset($_SESSION["login"])) {
		Route::get("member/logout", function() {
			session_destroy();
			redirect("/", "로그아웃이 완료되었습니다.");
		});

		/* message */
		Route::get("message/index", function() {
			$messages = DB::find("message", "target = ? ORDER BY date DESC", [$_SESSION["login"]["idx"]])->fetchAll();

			View::popup("message", [
				"messages" => $messages,
			]);
		});

		Route::get("message/view", function($idx) {
			DB::mq("UPDATE `message` SET `view` = ? WHERE `idx` = ?", [true, $idx]);

			View::popup("message_view", [
				"message" => DB::find("message", "idx = ?", [$idx])->fetch(),
			]);
		});

		Route::get("message/delete", function($idx) {
			DB::delete("message", "idx = ?", [$idx]);
			redirect("/message/index", "삭제가 완료되었습니다.");
		});

	};

	/* admin */
	if(isset($_SESSION["login"]) && $_SESSION["login"]["id"] == "admin") {
		Route::get("admin/index", function() {
			View::open("admin", [
				"now" => Event::getNow(),
				"title" => "관리자페이지",
				"members" => DB::find("member", "id != ? ORDER BY id ASC", ["admin"])->fetchAll(),
			]);
		});

		Route::post("message/write", function() {
			$insertData = [
				"title" => $_POST["title"],
				"content" => $_POST["content"],
			];

			if($_POST["target"] == "전체") {
				foreach(DB::find("member", "id != ?", ["admin"])->fetchAll() as $member) {
					DB::insert("message", array_merge([
						"target" => $member["idx"],
					], $insertData));
				};
			} else {
				$insertData["target"] = $_POST["target"];
				DB::insert("message", $insertData);
			};

			redirect("/admin/index", "작성이 완료되었습니다.");
		});

		Route::get("notice/write", function() {
			View::open("sub3_write");
		});

		Route::post("notice/write", function() {
			DB::insert("notice", [
				"title" => $_POST["title"],
				"content" => nl2br($_POST["content"]),
			]);

			redirect("/notice/index", "글 작성이 완료되었습니다.");
		});

		Route::post("event/result", function() {
			$number = array_values($_POST);

			foreach ($number as $key => $num) {
				if($num == "")
					redirect("/admin/index", "번호를 모두 선택해주세요.");
			};

			if(count($number) != count(array_unique($number))) {
				redirect("/admin/index", "중복되는 숫자가 존재합니다.");
			};

			DB::mq("UPDATE `event` SET `end` = ?, `ok_number` = ? WHERE `end` = ?", [
				true, join(",", $number), false
			]);

			$now = Event::getNow();

			$numbers = Event::getJoin("e.time = ?", [$now - 1]);
			$numbers = Event::sortSuccess($numbers);
			$numbers = array_reduce($numbers, "array_merge", []);

			foreach($numbers as $number) {
				$total_point = Event::getSuccessPoint($number["eidx"]);
				$member = DB::find("member", "id = ?", [$number["id"]])->fetch();
				$get_point = $total_point / 100 * 80;

				DB::mq("UPDATE member SET `point` = ? WHERE `idx` = ?", [
					$member["point"] + $get_point,
					$member['idx']
				]);

				DB::insert("give", [
					"kind" => $number["kind"],
					"price" => $total_point / 100 * 20,
				]);

				DB::insert("message", [
					"target" => $member["idx"],
					"content" => number_format($get_point)."포인트가 회원 포인트로 지급되었습니다.",
					"title" => "당첨축하",
				]);
			};

			DB::insert("event", [
				"kind" => "독거노인돕기",
				"count" => 1,
				"time" => $now,
			]);
			DB::insert("event", [
				"kind" => "불우아동돕기",
				"count" => 1,
				"time" => $now,
			]);

			redirect("/admin/index", "완료되었습니다.");
		});
	};

	Route::get("point/change", function() {
		$login = $_SESSION["login"];

		if(!isset($login) || $login["id"] == "admin") {
			redirect("/", "회원만 기부 가능합니다.");
		};

		if($login["point"] < 100000) {
			redirect("/", "기부 가능한 포인트가 없습니다.");
		};

		DB::mq("UPDATE `member` SET `point` = ?, `give_point` = ? WHERE `idx` = ?", [
			$login["point"] - 100000,
			$login["give_point"] + 100000,
			$login['idx'],
		]);

		DB::insert("give", [
			"kind" => $_GET["kind"],
			"price" => 100000,
		]);

		$_SESSION["login"] = DB::fetch("SELECT * FROM `member` WHERE `idx` = ?", [$login['idx']]);

		redirect("/", "기부가 완료되었습니다.");
	});

	/* event */
	Route::get("event/join", function() {
		$login = $_SESSION["login"];

		if(!isset($login) || $login["id"] == "admin") {
			redirect("/", "회원만 가능합니다.");
		};

		View::open("sub1", [
			"join_list" => Event::getJoin("ej.id = ?", [$login["id"]]),
			"title" => "참가내역",
		]);
	});

	Route::get("event/attend", function($idx) {
		$login = $_SESSION["login"];
		$event = DB::find("event", "idx = ?", [$idx])->fetch();
		$join_list = Event::getJoin("e.idx = ?", [$idx]);

		Event::getInfo($event);

		if(!isset($login) || $login["id"] == "admin") {
			redirect("/", "회원만 참여 가능합니다.");
		};

		if($event["people"] >= $event["max_people"]) {
			if(!DB::find("event", "count = ? && time = ? && kind = ?", [$event["count"] + 1, Event::getNow(), $event["kind"]])->fetch()) {
				DB::insert("event", [
					"kind" => $event["kind"],
					"count" => $event["count"] + 1,
					"time" => $event["time"],
				]);
			};
		};

		View::open("lotto", [
			"event" => $event,
			"join_list" => $join_list,
			"title" => "참가하기",
		]);
	});

	Route::post("event/attend", function($idx) {
		$login = $_SESSION['login'];
		$number = explode(",", $_POST["number"]);
		$sort_number = $number;

		$event = DB::find("event", "idx = ?",  [$idx])->fetch();

		$join_list =  DB::find("event_join", "eventIdx = ?", [$idx])->fetchAll();

		foreach ($join_list as $key => $join) {
			$join_number = explode(",", $join["number"]);

			if(count(array_intersect($join_number, $sort_number)) == count($join_number)) {
				redirect("back", "중복되는 번호입니다.");
			};
		};

		Event::getInfo($event);

		if($_SESSION["login"]["give_point"] < $event["use_point"]) {
			redirect("/", "나눔 포인트가 부족합니다.");
		};

		if(count($number) != 6) {
			redirect("/", "로또번호 6가지를 선택해주세요.");
		};

		if($event["people"] >= $event["max_people"]) {
			redirect("/", "정원이 다 찬 방입니다.");
		};

		$point = $login['give_point'] - $event["use_point"];

		DB::mq("UPDATE `event` SET `people` = ? WHERE `idx` = ?", [++$event["people"], $idx]);
		DB::mq('UPDATE `member` SET `give_point` = ? WHERE `idx` = ?', [$point, $login['idx']]);

		DB::insert("event_join", [
			"eventIdx" => $idx,
			"id" => $_SESSION["login"]["id"],
			"number" => $_POST["number"],
		]);

		$_SESSION["login"]["give_point"] = $point;

		redirect("/event/attend/{$idx}", "참여가 완료되었습니다.");
	});


	Route::disPatch();