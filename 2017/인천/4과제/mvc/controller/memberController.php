<?php

	namespace Controller;

	use Model\member;

	class memberController extends _PublicController {
		public function __construct() {
			parent::__construct();
		}
		/* 회원가입 페이지 */
		public function join() {
			if(isset($this->login))
				return redirect("/", "비회원만 접근 가능합니다.");

			return view("join", $this->result);
		}
		/*로그인 페이지*/
		public function login() {
			if(isset($this->login))
				return redirect("/", "비회원만 접근 가능합니다.");
			
			return view("loginform", $this->result);
		}
		/*DB에 회원가입에서 넘겨준 값 넣기*/
		public function addUser() {
			$overlapId = member::find("id = ?", [$_POST["id"]])->fetch();

			$this->requiredChk([
				"id" => "아이디(이메일)",
				"name" => "이름",
				"pw" => "비밀번호"
			], $_POST);

			if(!filter_var($_POST["id"], FILTER_VALIDATE_EMAIL) && $_POST["id"] != "")
				$this->message[] = "아이디(이메일)은 이메일 형식이여야 합니다.";

			if($overlapId)
				$this->message[] = "중복되는 아이디 입니다.";

			if(!$this->message) {
				member::insert([
					"id" => $_POST["id"],
					"pw" => $_POST["pw"],
					"name" => $_POST["name"]
				]);

				return redirect("/main/index", "회원가입이 완료되었습니다.");
			} else {
				return redirect("/member/join", $this->message);
			};
		}
		/*로그인*/
		public function loginAction() {
			$auto = isset($_POST["auto"]);
			$login = member::find("id = ? && pw = ?", [$_POST["id"], $_POST["pw"]])->fetch();

			$url = $_GET["prevPage"];
			$message = "";

			if($login) {
				$message = "로그인이 완료되었습니다.";
				$_SESSION["login"] = $login;
				if($auto)
					setcookie("login", base64_encode(json_encode($login)), time() + 604800, "/");
			} else {
				$url = "/member/login?prevPage=$url";
				$message = "존재하지 않는 아이디 이거나 비밀번호를 잘못입력 하셨습니다.";
			};

			return redirect($url, $message);
		}
		/*로그아웃*/
		public function logout() {
			setcookie("login", true, time() - 3600, "/");
			session_destroy();
			return redirect("/", "로그아웃이 완료되었습니다.");
		}
	}