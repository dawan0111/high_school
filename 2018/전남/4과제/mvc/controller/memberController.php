<?php

	namespace Controller;

	/**
	 * 	memberController
	 */
	class memberController extends _PublicController
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function join()
		{
			if ($this->login) {
				redirect("/", "비회원만 접근 가능합니다.");
			}
			return view('join', $this->result);
		}

		public function login()
		{
			if ($this->login) {
				redirect("/", "비회원만 접근 가능합니다.");
			}
			return view("login", $this->result);
		}

		public function postJoin()
		{
			$dir = ['/', "회원가입이 완료되었습니다."];

			$this->match([
				[$_POST["name"] == "", "이름을 입력해주세요."],
				[$_POST["id"] == "", "아이디을 입력해주세요."],
				[$_POST["pw"] == "", "비밀번호 입력해주세요."],
				[$_POST["re_pw"] == "", "비밀번호 확인을 입력해주세요."],
				[$_POST["re_pw"] != $_POST["pw"], "비밀번호와 비밀번호 확인 값이 다릅니다."],
				[$_POST["name"] != "" && !preg_match('/^[가-힣]+$/u', $_POST["name"]), "이름은 한글로 입력해주세요."],
				[$_POST["id"] != "" && !filter_var($_POST["id"], FILTER_VALIDATE_EMAIL), "아이디는 이메일 형식만 가능합니다."],
				[$this->db->table("member")->fetch("id = ?", [$_POST['id']]), "중복되는 아이디 입니다."]
			]);

			if(!$this->msg) {
				$idx = $this->db->table("member")->insert([
					"id" => $_POST["id"],
					"name" => $_POST['name'],
					"pw" => $_POST["pw"],
					"phone" => $_POST["phone"],
					"address" => $_POST["address"],
				]);

				$_SESSION['login'] = $this->db->fetch("idx = ?", [$idx]);
			} else {
				$dir = ["/member/join", $this->msg];
			};

			return redirect(...$dir);
		}

		public function postLogin()
		{
			$member = $this->db->table("member")->fetch('id = ? && pw = ?', [$_POST["id"], $_POST["pw"]]);

			if($member) {
				$_SESSION["login"] = $member;
				$dir = ["/", "로그인이 완료되었습니다."];
			} else {
				$dir = ["/member/login", "존재하지 않는 아이디 이거나 비밀번호를 잘못입력 하셨습니다."];
			};

			redirect(...$dir);
		}

		public function logout()
		{
			session_destroy();
			redirect("/", "로그아웃이 완료되었습니다.");
		}
	}