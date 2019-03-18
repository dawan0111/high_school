<?php

	namespace Controller;

	use Model\product;
	use Model\buy;

	class adminController extends _PublicController {
		public function __construct() {
			parent::__construct();

			if(!$this->login || $this->login["id"] != "admin")
				return redirect("/", "관리자만 접근 가능합니다.");
		}

		public function item() {
			return view("item", $this->result);
		}

		public function discount() {
			$page = v($_GET["page"], 1);

			$productCount = product::find()->rowCount();
			$blockEnd = ceil($productCount / 10);

			$limitStart = ($page - 1) * 10;

			$products = product::find("1 order by sale asc limit $limitStart, 10")->fetchAll();

			$this->result["blockEnd"] = $blockEnd;
			$this->result["products"] = $products;
			$this->result["page"] = $page;

			return view("discount", $this->result);
		}

		public function stock() {
			$products = product::find("stock <= ?", [10])->fetchAll();

			$this->result["products"] = $products; 

			return view("stock", $this->result);
		}

		public function analysis() {
			$this->result["total"] = buy::getBuyTotal();

			return view("analysis", $this->result);
		}
	}