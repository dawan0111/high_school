<?php

	namespace Controller;

	/**
	 * 	memverController
	 */
	class memberController extends _PublicController
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function join()
		{
			return view("join", $this->result);
		}

		public function postJoin()
		{
			$this->match([
				[
					$this->db->table("member")->fetch("email = ?", [$_POST["email"]]),
					"중복되는 이메일 입니다.",
				],
				[
					$_POST["pw"] != $_POST["re_pw"],
					"비밀번호와 비밀번호 확인이 일치하지 않습니다."
				]
			]);

			if(!$this->msg) {
				$this->db->insert([
					"email" => $_POST['email'],
					"name" => $_POST["name"],
					"pw" => $_POST["pw"]
				]);

				return redirect("/", "회원가입이 완료되었습니다.");
			} else {
				return redirect("/member/join", $this->msg);
			};
		}

		public function postLogin()
		{
			$member = $this->db->table("member")->fetch("email = ? && pw = ?", [$_POST["email"], $_POST["pw"]]);
			$dir = ["/", "로그인이 완료되었습니다."];

			if($member) {
				$_SESSION["login"] = $member;
			} else {
				$dir[1] = "존재하지 않는 아이디 이거나 비밀번호를 잘못입력 하셨습니다.";
			};

			return redirect(...$dir);
		}

		public function logout()
		{
			session_destroy();
			redirect("/", "로그아웃이 완료되었습니다.");
		}
	}