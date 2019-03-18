<?php

	namespace Controller;

	use Model\house;

	class mainController {
		public function index() {
			$houses = house::getAll();

			return view("index", [
				"houses" => $houses,
				"title" => "제주펜션목록",
			]);
		}
	} 