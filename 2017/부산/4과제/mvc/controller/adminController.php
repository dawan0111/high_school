<?php

	namespace Controller;

	use Model\house;
	use Model\res;

	class adminController {
		public function __construct() {
			if(!isset($_SESSION['id']) || $_SESSION['id']['email'] != "admin") {
				return redirect("/", "관리자만 접근 가능합니다.");
			};
		}

		public function admin_house_insert() {
			return view("admin/admin_house_insert", [
				"title" => "펜션등록",
			]);
		}

		public function admin_house_delete() {
			$houses = house::getAll();

			return view("admin/admin_house_delete", [
				"houses" => $houses,
				"title" => "펜션삭제",
			]);
		}

		public function admin_house_reservation() {
			$place = v($_GET['place'], "");

			if($place != "") {
				$sql = "housename = '{$place}'";
			} else {
				$sql = 1;
			};

			$resList = res::getAll($sql);
			$houseList = house::getAll();

			return view("admin/admin_house_reservation", [
				"title" => "펜션 예약 목록",
				"resList" => $resList,
				"houseList" => $houseList,
				"place" => $place,
			]);
		}
	}