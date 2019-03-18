<?php

	namespace Controller;

	use Model\member;
	use Model\coupon;

	class memberController extends _PublicController {
		public function __construct() {
			parent::__construct();
		}
		/* 회원가입 */
		public function join() {
			return view("join", $this->result);
		}
		/* 회원가입 - DB에 입력한 정보 넣기 */
		public function joinAction() {
			$message = [];
			$coupon = [10, 20, 40, 50];

			foreach($_POST as $key => $value) {
				if($value == "") {
					$message[] = "모든 항목을 입력해 주세요.";
					break;
				};
			};
			if(!filter_var($_POST["id"], FILTER_VALIDATE_EMAIL))
				$message[] = "아이디는 이메일 형식 이여야 합니다.";

			if(member::find("id = ?", [$_POST["id"]])->fetch())
				$message[] = "중복되는 아이디 입니다.";

			if($_POST["pw"] !== $_POST["repw"])
				$message[] = "비밀번호와 확인 비밀번호가 일치하지 않습니다.";

			if(!$message) {
				$idx = member::insert([
					"id" => $_POST["id"],
					"name" => $_POST["name"],
					"age" => $_POST["age"],
					"gender" => $_POST["gender"],
					"pw" => $_POST["pw"],
				]);

				foreach($coupon as $key => $prt) {
					coupon::insert([
						"midx" => $idx,
						"prt" => $prt,
					]);
				};

				return redirect("/", "회원가입이 완료되었습니다.");
			} else {
				return redirect("/member/join", $message);
			};
		}

		/*로그인*/
		public function login() {
			return view("login", $this->result);
		}
		/* 로그인 - 아이디 비밀번호 확인 및 회원에게 세션 발급 */
		public function loginAction() {
			$member = member::find("id = ? && pw = ?", array_values($_POST))->fetch();

			if($member) {
				$_SESSION["login"] = $member;
				return redirect("/", "로그인이 완료되었습니다.");
			} else {
				return redirect("/member/login", "존재하지 않는 아이디 이거나 비밀번호를 잘못입력 하셨습니다.");
			};
		}

		/* 로그아웃 */
		public function logout() {
			session_destroy();

			return redirect("/", "로그아웃이 완료되었습니다.");
		}
	}