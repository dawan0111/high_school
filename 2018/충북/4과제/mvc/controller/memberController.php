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
			return view('join', $this->result);
		}

		public function login($value='')
		{
			return view("login", $this->result);
		}

		public function mypage()
		{
			return view("mod", $this->result);
		}

		public function postJoin()
		{
			$dir = ["/", "회원가입이 완료되었습니다"];

			$this->match([
				[
					!preg_match('/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/', $_POST["id"]),
					"아이디는 영문 + 숫자로 입력해주세요."
				],
				[
					!preg_match('/^.{8,}$/', $_POST["pw"]),
					"비밀번호는 8글자 이상으로 입력해주세요."
				],
				[
					!preg_match('/^([가-힣a-zA-Z]+$/u', $_POST["name"]),
					"이름은 영문 또는 한글로 입력해주세요."
				],
				[
					!preg_match('/^[0-9]+$/', $_POST["phone"]),
					"전화번호를 입력해주세요."
				],
				[
					$this->db->table("member")->fetch("id = ?", [$_POST["id"]]),
					"중복되는 아이디 입니다."
				]
			]);

			if(!$this->msg) {
				$this->db->table("member")->insert($_POST);
			} else {
				$dir = ["/member/join", $this->msg];
			}

			redirect(...$dir);
		}

		public function modify()
		{
			$_POST["pw"] = $_POST["pw"] == "" ? $this->login["pw"] : $_POST["pw"];
			$dir = ["/member/mypage"];

			$this->match([
				[
					!preg_match('/^.{8,}$/', $_POST["pw"]),
					"비밀번호는 8글자 이상으로 입력해주세요."
				],
				[
					!preg_match('/^[가-힣a-zA-Z]+$/u', $_POST["name"]),
					"이름은 영문 또는 한글로 입력해주세요."
				],
				[
					!preg_match('/^[0-9]+$/', $_POST["phone"]),
					"전화번호를 입력해주세요."
				]
			]);

			if (!$this->msg) {
				$dir[1] = "수정되었습니다.";
				$this->db->table("member")->update($_POST, $this->login["idx"]);
			} else {
				$dir[1] = $this->msg;
			};

			redirect(...$dir);
		}

		public function postLogin()
		{
			$dir = ["/member/login", "존재하지 않는 아이디 이거나 비밀번호를 잘못입력 하셨습니다."];
			$member = $this->db->table("member")->fetch("id = ? && pw = ?", [$_POST["id"], $_POST['pw']]);

			if($member) {
				$_SESSION["login"] = $member;
				$dir = ["/", "{$member['name']}님 환영합니다."];
			};

			redirect(...$dir);
		}

		public function logout()
		{
			session_destroy();
			return redirect('/', "로그아웃이 완료되었습니다.");
		}

		public function order()
		{
			$orders = $this->db->table("buy")->fetchAll("midx = ? order by date desc", [$this->login["idx"]]);

			$this->result["orders"] = $orders;
			return view("order_list", $this->result);
		}
	}