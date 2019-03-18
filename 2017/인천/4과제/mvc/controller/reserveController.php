<?php

	namespace Controller;

	use Model\room;
	use Model\reserve;
	use Model\member;

	use \dateTime;

	class reserveController extends _PublicController {
		public function __construct() {
			parent::__construct();
			if(!isset($this->login)) {
				return redirect("/member/login?prevPage=/".$_GET["url"], "회원만 접근 가능합니다.");
			} else {
				if($this->login["id"] == "admin") {
					return redirect("/", "관리자는 접근 불가능합니다.");
				};
			};
		}
		/* 수동예약 */
		public function c() {
			$this->result["rooms"] = room::find()->fetchAll();

			return view("cReserve", $this->result);
		}
		/* 자동예약 */
		public function a() {
			if(isset($_GET["indate"])) {
				$rooms = room::find()->fetchAll();
				$reserve = reserve::getReserve($_GET["indate"], $_GET["outdate"]);
				$floorRoom = [
					"5" => [],
					"4" => [],
					"3" => [],
					"2" => [],
					"1" => []
				];
				$connectRoom = [];
				$cutRoom = [];
				$error = false;

				$rooms = array_filter($rooms, function($room) use ($reserve) {
					$side = $_GET["side"] == "sea" ? 0 : 1;
					$error = false;

					if(($room["number"] % 2 != $side) || (in_array($room["number"], $reserve)))
						$error = true;

					if(!$error)
						return $room;
				});

				foreach($rooms as $room) {
					$floorRoom[$room["floor"]][] = $room["number"];
				};

				foreach($floorRoom as $floor => $fRoom) {
					if($_GET["connectCount"] == 0 || count($fRoom) == 0)
						continue;

					$key = 0;
					$connectRoom = [$fRoom[$key]];

					for ($i=0; $i < count($fRoom); $i++) {
						if(count($connectRoom) == $_GET["connectCount"]) {
							break 2;
						}
						$key++;

						if($key == count($fRoom)) {
							break;
						};

						if($connectRoom[$key - 1] + 2 == $fRoom[$key]) {
							$connectRoom[] = $fRoom[$key];
						} else {
							$connectRoom = [];
							$connectRoom[$key] = $fRoom[$key];
						};
					};
				};

				foreach($floorRoom as $floor => $floorRoom) {
					foreach($floorRoom as $froom) {
						if(!in_array($froom, $connectRoom)) {
							if(count($cutRoom) == $_GET["roomCount"])
								break 2;

							$cutRoom[] = $froom;
						};
					};
				};

				if(!(count($connectRoom) == $_GET["connectCount"] && count($cutRoom) == $_GET["roomCount"])) {
					$error = true;
				};

				$resRoom = array_merge($cutRoom, $connectRoom);
				sort($resRoom);
				$floors = [];

				if($error)
					$resRoom = [];

				foreach($resRoom as $room) {
					$number = floor($room / 100);

					if(!in_array($number, $floors))
						$floors[] = $number;
				};

				$this->result["floors"] = $floors;
				$this->result["reserve"] = $reserve;
				$this->result["resRoom"] = $resRoom;
				$this->result["error"] = $error;
			};

			return view("aReserve", $this->result);
		}
		/* 예약 할 방 결제 페이지 */
		public function reserve() {
			if(!isset($_POST["indate"])) {
				return redirect("/", "잘못된 접근입니다.");
			};
			$floors = [];
			$roomPrice = 0;

			$_POST["number"] = gettype($_POST["number"]) == "array" ? $_POST["number"] : explode(",", $_POST["number"]);

			$sql = "number = ".implode(" || number = ", $_POST["number"]);

			$rooms = room::mq("
				SELECT * FROM `room` WHERE {$sql}
			")->fetchAll();

			foreach($rooms as $room) {
				$number = floor($room['number'] / 100);

				if(!in_array($number, $floors))
					$floors[] = $number;

				$roomPrice += $room["price"];
			};

			$indate = new dateTime($_POST["indate"]);
			$outdate = new dateTime($_POST["outdate"]);

			$diffDay = date_diff($indate, $outdate)->days+1;

			$this->result["totalPrice"] = $roomPrice * $diffDay;
			$this->result["floors"] = $floors;
			$this->result["reserve"] = reserve::getReserve($_POST["indate"], $_POST["outdate"]);

			return view("reserve", $this->result);
		}
		/* 예약한 방 DB에 넣기 */
		public function reserveRoom() {
			$afterPoint = $this->login["point"] - $_POST["price"];
			$url = "/";
			$message = "예약이 완료되었습니다.";

			if($afterPoint < 0) {
				$message = "포인트가 부족합니다.";
			} else {
				member::update([
					"point" => $afterPoint,
				], $this->login["idx"]);

				reserve::insert([
					"indate" => $_POST["indate"],
					"outdate" => $_POST["outdate"],
					"room" => $_POST["number"],
					"id" => $this->login["id"]
				]);
			};

			return redirect($url, $message);
		}

		public function getReserveRoom() {
			echo json_encode(reserve::getReserve($_POST["indate"], $_POST["outdate"]));
		}
	}