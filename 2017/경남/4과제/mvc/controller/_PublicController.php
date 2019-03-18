<?php

	namespace Controller;

	use Model\coupon;

	class _PublicController {
		public $result = [];
		public $message = [];

		public function __construct() {
			if(isset($_SESSION["login"])) {
				$login = $_SESSION["login"];

				$this->result["login"] = $login;
				$this->result["coupon"] = coupon::find("midx = ? && disabled = ?", [$login["idx"], false])->fetchAll();
				$this->login = $login;
			};
		}

		public function requiredChk($required, $value) {
			foreach($required as $key => $msg) {
				if($value[$key] == "")
					$this->message[] = $msg."을(를) 입력해 주세요.";
			};
		}

		public function intChk($val, $label) {
			if(!is_numeric($val) || $val < 0)
				$this->message[] = $label."은(는) 0이상의 숫자로 입력해 주세요.";
		}
	}