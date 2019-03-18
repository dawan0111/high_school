<?php

	namespace Controller;

	use Model\product;

	class mainController extends _PublicController {
		public function __construct() {
			parent::__construct();
			/*$productCount = product::find()->rowCount();

			if(!$productCount)
				product::firstPage();*/
		}

		public function index() {
			$sql = [];
			$param = [];

			$category = v($_GET["category"], "전체보기");
			$search = v($_GET["search"], "");

			if($category != "전체보기") {
				$sql[] = "p.type = ?";
				$param[] = $category;
			};

			if($search != "") {
				$sql[] = "p.name LIKE ?";
				$param[] = "%$search%";
			};

			$sql = count($sql) == 0 ? 1 : join(" && ", $sql);

			$products = product::getMainProduct($sql, $param);

			$this->result = array_merge($this->result, [
				"products" => $products,
				"category" => $category,
				"search" => $search,
				"main" => true,
			]);
			
			return view("main", $this->result);
		}
	}