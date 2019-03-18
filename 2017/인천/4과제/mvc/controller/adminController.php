<?php

	namespace Controller;

	use Model\room;
	use Model\faq;
	use Model\member;

	class adminController extends _PublicController {
		public function __construct() {
			parent::__construct();

			if(!isset($this->login) || $this->login["id"] != "admin")
				return redirect("/", "관리자만 접근 가능합니다.");
		}
		/* 어드민 페이지 */
		public function index() {
			$this->result["rooms"] = room::find()->fetchAll();

			return view("admin", $this->result);
		}
		/* 어드민 faq 관리 */
		public function faq() {
			$sql = "toid = 'admin' order by date desc";
			$page = v($_GET["page"], 1);

			$faqCount = faq::find($sql)->rowCount();
			$blockend = ceil($faqCount / 10);
			$limitStart = ($page - 1) * 10;

			$faqs = faq::find("{$sql} limit $limitStart, 10")->fetchAll();

			$this->result = array_merge($this->result, [
				"blockend" => $blockend,
				"page" => $page,
				"faqs" => $faqs,
			]);

			return view("adminfaq", $this->result);
		}

		/* 어드민 포인트 지급 */
		public function givePoint() {
			$member = member::find("id = ?", [$_POST["id"]])->fetch();
			$url = "/admin/index";

			if(!$member)
				return redirect($url, "없는 아이디(이메일) 입니다.");

			if($_POST["point"] < 0)
				return redirect($url, "지급할 포인트 금액은 0 이상이여야 합니다.");

			member::update([
				"point" => $member["point"] + $_POST["point"],
			], $member["idx"]);

			return redirect($url, "포인트 지급이 완료되었습니다.");
		}
		/* 방 가격 변경 */
		public function roomPriceChange() {
			$url = "/admin/index";
			$sql = 1;

			if($_POST["price"] < 0)
				return redirect($url, "방 가격은 0 이상으로 입력해 주세요.");

			if(isset($_POST['idx']))
				$sql = "number = ".implode(" || number = ", $_POST["idx"]);

			room::priceChange($sql, $_POST["price"]);

			return redirect($url, "방 가격이 변경되었습니다.");
		}
	}