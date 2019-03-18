<?php

	namespace Controller;

	use Model\house;
	use Model\res;

	use \dateTime;

	class houseController {
		public function house_reservation($idx) {
			$house = house::getAll("idx = {$idx}")[0];

			$nowDate = date("Y-m-d");
			$moveMonth = v($_GET['moveMonth'], 0);

			$datepicker = date("Y-m-d", strtotime($nowDate.$moveMonth."month"));
			$strDate = strtotime($datepicker);

			$firstDate = date("Y-m", $strDate)."-01";
			$lastDate = date("Y-m", $strDate).date("t", $strDate);

			$resDay = res::getAll("housename = '{$house['name']}'");

			$resList = [];

			foreach($resDay as $key => $day) {
				$startDate = new DateTime($day['startdate']);
				$endDate = new DateTime($day['enddate']);

				$diffday = $startDate->diff($endDate)->d - 1;

				for ($i=0; $i <= $diffday; $i++) { 
					$resList[] = date("Y-m-d", strtotime($day['startdate']."+{$i}day"));
				};
			};

			return view("res/house_reservation", [
				"moveMonth" => $moveMonth,
				"datepicker" => $datepicker,
				"houseidx" => $idx,
				"strDate" => $strDate,
				"resDate" => $resList,
				"title" => "예약하기",
			]);
		}

		public function house_reservation2($idx) {
			$house = house::getAll("idx = {$idx}")[0];

			$applyCount = 7;

			$selectDay = $_GET['day'];
			$nextRes = res::mf("SELECT * FROM `res` WHERE `housename` = ? && `startdate` > ?", [$house['name'], $selectDay]);

			if($nextRes) {
				$selectDay = new DateTime($selectDay);
				$nextDay = new DateTime($nextRes['startdate']);

				$diffday = $selectDay->diff($nextDay)->d;

				if($diffday < 7) {
					$applyCount = $diffday;
				};
			};

			return view("res/house_reservation2", [
				"idx" => $idx,
				"house" => $house,
				"applyCount" => $applyCount,
				"title" => "예약하기",
			]);
		}

		public function addHouse() {
			if($_POST['price'] < 0) {
				return redirect("/admin/admin_house_insert", 
					"가격에는 0 이상의 숫자를 입력해 주세요."
				);
			};

			$file = $_FILES['file'];

			$realname = date("YmdHis").".".pathinfo($file['name'])['extension'];

			move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/upload/".$realname);

			house::insert("house", [
				"name" => $_POST['name'],
				"price" => $_POST['price'],
				"phone" => $_POST['phone'],
				"image" => $realname
			]);

			return redirect("/", "펜션 등록이 완료되었습니다.");
		}

		public function delete($idx) {
			house::mq("DELETE FROM `house` WHERE `idx` = ?", [$idx]);

			return redirect("/admin/admin_house_delete", "펜션 삭제가 완료되었습니다.");
		}

	}