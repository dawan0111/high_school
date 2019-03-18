<?php

	namespace Controller;

	use Model\product;
	use Model\coupon;
	use Model\buy;
	use Model\view;

	class productController extends _PublicController {
		public function __construct() {
			parent::__construct();
		}
		/* 상품 상세보기  $idx = 상품의 고유번호 */
		public function view($idx) {
			if(!isset($this->login)) {
				return redirect("/", "회원만 접근 가능합니다.");
			};

			view::insert([
				"pidx" => $idx,
				"gender" => $this->login["gender"],
				"age" => $this->login["age"],
			]);

			$product = product::getProduct($idx);

			$this->result["product"] = $product;

			return view("view", $this->result);
		}

		/* 장바구니에 담기 및 구매 */
		public function buyAction($idx) {
			$product = product::getProduct($idx);

			$type = isset($_POST["cart"]) ? "cart" : "buy";
			$coupon = coupon::find("idx = ?", [$_POST["coupon"]])->fetch();
			$prt = $coupon ? $coupon["prt"] : 0;

			if($type == "buy") {
				$afterStock = $product["stock"] - $_POST["stock"];

				if($afterStock < 0)
					return redirect("/product/view/$idx", "재품 수량이 부족합니다.");

				product::update([
					"stock" => $afterStock,
				], $idx);
			};

			if($coupon) {
				coupon::update([
					"disabled" => true,
				], $coupon["idx"]);
			};

			buy::insert([
				"pidx" => $idx,
				"buyprice" => $product["salePrice"],
				"coupon" => $_POST["coupon"],
				"stock" => $_POST["stock"],
				"type" => $type,
				"cprt" => $prt,
				"id" => $this->login["id"],
			]);

			return redirect("/", "처리가 완료되었습니다.");
		}

		/* 물품추가 입력한 내용을 DB에 저장 */	
		public function addItem() {
			$file = $_FILES["file"];
			$required = [
				"name" => "상품명",
			];

			$this->requiredChk($required, $_POST);

			if($file["name"] == "") {
				$this->message[] = "파일을 선택해 주세요.";
			} else {
				if(!preg_match("/^image\/(jpeg|png|bmp)$/", $file["type"]))
					$this->message[] = "물품 이미지 첨부파일의 파입은 image/png, image/jpg, image/jpeg, image/bmp 만 가능합니다.";

				if($file["error"] != 0) {
					$this->message[] = "용량이 너무 큽니다.";
				};
			};

			$this->intChk($_POST["price"], "설정 가격");
			$this->intchk($_POST["stock"], "재고");

			if(!$this->message) {
				$ext = pathinfo($file["name"])["extension"];
				$filename = md5($file["name"]).date("YmdHis").rand(0, 9999).".$ext";

				move_uploaded_file($file["tmp_name"], ROOT."/img/$filename");

				product::insert([
					"name" => $_POST["name"],
					"type" => $_POST["type"],
					"price" => $_POST["price"],
					"stock" => $_POST["stock"],
					"file" => $filename,
				]);

				return redirect("/", "등록이 완료되었습니다.");
			} else {
				return redirect("/admin/item", $this->message);
			};
		}

		/* 할인율 설정 */
		public function setSale() {
			$message = [];
			$url = "/admin/discount";

			if(!isset($_POST["idx"]))
				$message[] = "상품을 선택해 주세요.";

			if($_POST["sale"] == "")
				$message[] = "할인율을 선택해 주세요.";

			if(!$message) {
				foreach($_POST["idx"] as $key => $idx) {
					product::update([
						"sale" => $_POST["sale"],
					], $idx);
				};

				return redirect($url, "할인율 변경이 완료되었습니다.");
			} else {
				return redirect($url, $message);
			};
		}

		public function addStock() {
			$url = "/admin/stock";

			if(!isset($_POST["idx"]))
				$this->message[] = "상품을 선택해 주세요.";

			if($this->intChk($_POST["count"], "보충할 재고 갯수"));

			if(!$this->message) {
				foreach($_POST["idx"] as $key => $idx) {
					$product = product::find("idx = ?", [$idx])->fetch();

					product::update([
						"stock" => $product["stock"] + $_POST["count"]
					], $idx);
				};

				return redirect($url, "재고 보충이 완료되었습니다.");
			} else {
				return redirect($url, $this->message);
			};
		}
	}