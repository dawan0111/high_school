<?php

	namespace Controller;

	use Model\member;
	use Model\res;

	class memberController {
		public function join() {
			if(isset($_SESSION['id'])) {
				return redirect("/", "비회원만 접근 가능합니다.");
			};

			return view("member/join", [
				"title" => "회원가입",
			]);
		}

		public function login() {
			if(isset($_SESSION['id'])) {
				return redirect("/", "비회원만 접근 가능합니다.");
			};

			return view("member/login", [
				"title" => "로그인",
			]);
		}

		public function mypage() {
			if(!isset($_SESSION['id'])) {
				return redirect("/", "회원만 접근 가능합니다.");
			};

			$nowDate = date("Y-m-d");

			$resList = res::getAll("`id` = '{$_SESSION['id']['email']}' && `startdate` >= '{$nowDate}'");

			return view("member/mypage", [
				"title" => "Mypage",
				"resList" => $resList,
			]);
		}

		public function joinAction() {
			member::insert("member", $_POST);

			return redirect("/", "회원가입이 완료되었습니다.");
		}

		public function loginAction() {
			$memberChk = member::mf("SELECT * FROM `member` WHERE `email` = ? && `pw` = ?", [$_POST['email'], $_POST['pw']]);

			if($memberChk) {
				$_SESSION['id'] = $memberChk;
				return redirect("/", "로그인이 완료되었습니다.");
			} else {
				return redirect("/member/login", "존재하지 않는 아이디 이거나 비밀번호를 잘못입력 하셨습니다.");
			};
		}

		public function logout() {
			session_destroy();

			return redirect("/index.php", "로그아웃이 완료되었습니다.");
		}
	}