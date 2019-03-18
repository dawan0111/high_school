<?php

	namespace Controller;

	use Model\member;
	use Model\faq;

	class _PublicController {
		public $result = [];
		public $message = [];
		/* 페이지 공용 기능 */
		public function __construct() {
			$login = "";

			if(isset($_COOKIE["login"]))
				$_SESSION["login"] = (array) json_decode(base64_decode($_COOKIE["login"]));

			if(isset($_SESSION["login"])) {
				$login = member::find("id = ?", [$_SESSION["login"]["id"]])->fetch();
				$faq = faq::find("toid = ? && view = ?", [$login["id"], false])->rowCount();

				$this->result["faq"] = $faq;
				$this->result["login"] = $login;
				$this->login = $login;
			};
		}
		/* 빈값 확인 */
		public function requiredChk($required, $value) {
			foreach($required as $key => $msg) {
				if($value[$key] == "")
					$this->message[] = $msg."은(는) 필수입력 사항입니다.";
			};
		}
	}