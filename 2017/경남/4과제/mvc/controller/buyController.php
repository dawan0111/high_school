<?php

	namespace Controller;

	use Model\buy;
	use Model\product;

	class buyController extends _PublicController {
		public function __construct() {
			parent::__construct();

			if(!isset($this->login)) {
				return redirect("/", "회원만 접근 가능합니다.");
			};
		}

		public function cart() {
			$lists = buy::getList($this->login["id"]);

			$this->result["lists"] = $lists;

			return view("cart", $this->result);
		}

		public function cartAction() {
			if(!isset($_POST["idx"])) {
				return redirect("/buy/cart", "상품을 선택해 주세요.");
			};

			$type = isset($_POST["buy"]) ? "buy" : "delete";
			$url = "/buy/cart";

			if($type == "delete") {
				foreach($_POST["idx"] as $key => $idx) {
					buy::cancle($idx);
				};	
				return redirect($url, "선택 제거가 완료되었습니다.");
			} else {
				$message = [];

				foreach($_POST["idx"] as $key => $idx) {
					$list = buy::find("idx = ?", [$idx])->fetch();
					$product = product::getProduct($list["pidx"]);

					$afterStock = $product["stock"] - $list["stock"];

					if($afterStock < 0) {
						$message[] = $product["name"];
						continue;
					};

					buy::update([
						"buyprice" => $product["salePrice"],
						"type" => "buy",
					], $idx);

					product::update([
						"stock" => $afterStock,
					], $product["idx"]);
				};

				$alert = count($message) == 0 ? "모두 구매가 완료되었습니다." : "재고가 부족한 상품 빼고 구매가 완료되었습니다.\\r부족한 목록 : ".join(", ", $message);

				return redirect($url, $alert);
			};
		}

		public function list() {
			$buyTotal = buy::getBuyTotal("id = ?", [$this->login["id"]]);
			$lists = buy::getList($this->login["id"], "buy");

			$this->result["total"] = $buyTotal;
			$this->result["lists"] = $lists;

			return view("list", $this->result);
		}

		public function buyReturn($idx) {
			buy::cancle($idx);
			
			return redirect("/buy/list", "환불이 완료되었습니다.");
		}

		public function getGraph() {
			$sql = [];
			$result = [];

			if($_POST["sex"] != "all") {
				$sql[] = "gender = '{$_POST['sex']}'";
			};
			if($_POST["age"] != "all") {
				$sql[] = "age = '{$_POST['age']}'";
			};

			$sql = count($sql) == 0 ? 1 : join(" && ", $sql);

			$view = product::mq("
				SELECT *, COUNT(view.pidx) as view FROM `product`
				LEFT JOIN `view`
				ON product.idx = view.pidx
				WHERE {$sql}
				GROUP BY product.idx
				ORDER BY view desc
			")->fetchAll();

			$maxView = isset($view[0]) ? $view[0]["view"] : 0;

			foreach($view as $key => $value) {
				$prt = $value["view"] / $maxView * 100;
				$fontsize = 40 / 100 * $prt;
				$opacity = 0.01 * $prt;

				$result[] = [
					"left" => rand(0, 750),
					"top" => rand(0, 300),
					"fontsize" => $fontsize,
					"opacity" => $opacity,
					"text" => $value["name"],
				];
			};

			echo json_encode($result);
		}
	}