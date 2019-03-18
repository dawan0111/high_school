<?php

	namespace Controller;

	use Model\reserve;
	use Model\room;

	class mainController extends _PublicController {
		public function __construct() {
			parent::__construct();
		}

		/* 메인 페이지 보여주기 */
		public function index() {
			$date = v($_GET["date"], date("Y-m-d"));

			$this->result["reserve"] = reserve::getReserve($date, $date);

			return view("index", $this->result);
		}
	}