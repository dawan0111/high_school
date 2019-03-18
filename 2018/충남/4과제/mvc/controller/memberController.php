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

		public function login()
		{
			if ($this->login) {
				return redirect("/", "비회원만 접근 가능합니다.");
			};
			return view("member", $this->result);
		}

		public function mypage()
		{
			$success_list = $this->getResInfo("
				res.user = ? && res.type = ? && (res_info.state = ? || res_info.state = ?) && res.e_time > ?",
				[$this->login["idx"], "buy", "대기중", "결제완료", date("Y-m-d H:i:s")], 
				"fetchAll"
			);

			$cancle_list = $this->getResInfo(
				"res.user = ? && res.type = ? && (res_info.state = ? || res.e_time < ?)",
				[$this->login["idx"], "buy", "예약취소", date("Y-m-d H:i:s")],
				"fetchAll"
			);

			$this->result["cancle_list"] = $cancle_list;
			$this->result["success_list"] = $success_list;

			return view("mypage", $this->result);
		}

		public function promise($idx)
		{
			$res = $this->getResInfo("res.idx = ?", [$idx], "fetch");

			$this->result["res"] = $res;
			return view("contract", $this->result);
		}

		public function down()
		{
			$filename = "계약서.xls";

			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=\"$filename\"");

			echo "<meta content=\"application/vnd.ms-excel; charset=UTF-8\" name=\"Content-type\"> ";
			echo $_GET["table"];
		}

		public function cancle($idx)
		{
			$this->db->table("res_info")->update([
				"state" => "예약취소",
				"cancle" => "[".$this->login["name"]."]님의 의해 취소되었습니다.",
			], $idx);

			return redirect("/member/mypage", "취소가 완료되었습니다.");
		}

		public function postLogin()
		{
			$member = $this->db->table("member")->fetch("id = ? && pw = ?", [$_POST["id"], $_POST["pw"]]);
			$dir = ["/", "로그인이 완료되었습니다."];

			if($member) {
				$_SESSION["login"] = $member;
			} else {
				$dir = ["/member/login", "존재하지 않는 아이디 이거나 비밀번호를 잘못입력 하셨습니다."];
			}

			return redirect(...$dir);
		}

		public function logout()
		{
			session_destroy();
			return redirect("/", "로그아웃이 완료되었습니다.");
		}
	}