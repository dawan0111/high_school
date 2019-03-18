<?php

	namespace Controller;

	use Model\_Base;
	use Model\res;

	class resController {
		public function addres () {
			$startDate = date("Y-m-d", strtotime($_POST['resdate']));
			$endDate = date("Y-m-d", strtotime($startDate."+".$_POST['resday']."day"));

			res::insert("res", [
				"housename" => $_POST['housename'],
				"startdate" => $startDate,
				"enddate" => $endDate,
				"price" => $_POST['price'],
				"resname" => $_POST['resname'],
				"phone" => $_POST['phone'],
				"id" => $_SESSION['id']['email'],
				"money" => "입금확인",
			]);

			return redirect("/", "펜션 예약이 완료되었습니다.");
		}

		public function change($idx) {
			$type = $_GET['type'];
			res::change($type, $idx);

			return redirect("/admin/admin_house_reservation", "변경 완료되었습니다.");
		}

		public function memberChange() {
			$type = $_GET['type'];
			res::change($type, $idx);

			return redirect("/member/mypage", "변경 완료되었습니다.");
		}
	}