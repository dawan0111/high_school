<?php

	namespace Controller;

	use Model\faq;
	use Model\member;

	class faqController extends _PublicController {
		public function __construct() {
			parent::__construct();

			if(!isset($this->login)) {
				return redirect("/member/login?prevPage=/".$_GET["url"], "비회원은 접근 불가능합니다.");
			};
		}
		/* 문의하기 페이지 */
		public function index() {
			if($this->login["id"] == "admin" && !isset($_GET["toid"])) {
				return redirect("/admin/faq");
			};

			faq::mq("UPDATE `faq` SET `view` = ? WHERE `toid` = ?", [true, $this->login["id"]]);

			$toid = isset($_GET["toid"]) ? $_GET["toid"] : "admin"; 
			$faqList = faq::find("(fromid = ?) || (toid = ? && fromid = ?) order by date asc", [$this->login["id"], $this->login["id"], $toid])->fetchAll();

			if($this->login["id"] == "admin") {
				$faqList = array_filter($faqList, function($arr) use ($toid) {
					if($arr["fromid"] == $toid || ($arr["fromid"] == "admin" && $arr["toid"] == $toid))
						return $arr;
				});
			};


			$this->result["faqList"] = $faqList;
			$this->result["faq"] = 0;

			return view("faq", $this->result);
		}
		/* 문의 작성 */
		public function write() {
			$content = str_replace(["<", ">"], ["[", "]"], $_POST["content"]);
			$toid = isset($_POST["toid"]) ? $_POST["toid"] : "admin";

			$toid = member::find("id = ?", [$toid])->fetch();

			$textReg = [
				"/\[color rgb\=\"([0-9]{1,3}\,[0-9]{1,3}\,[0-9]{1,3})\"\](.+?)\[\/color\]/",
				"/\[color hex\=\"([0-9a-fA-F]{6})\"\](.+?)\[\/color\]/",
			];

			$aReg = "/\[a href\=\"(https?\:\/\/[a-zA-Z0-9 .]+)\"\](.+?)\[\/a\]/";

			$replace = [
				"<color style='color: rgb($1)'>$2</color>",
				"<color style='color: #$1'>$2</color>"
			];

			$content = preg_replace($textReg, $replace, $content);
			$content = preg_replace($aReg, "<a href='$1'>$2</a>", $content);
			$content = str_replace(["[", "]"], ["&lt;", "&gt;"], $content);

			faq::insert([
				"content" => nl2br($content),
				"fromid" => $this->login["id"],
				"toid" => $toid["id"],
				"fromname" => $this->login["name"],
				"toname" => $toid["name"]
			]);

			return redirect("/faq/index?toid={$toid['id']}");
		}
	}