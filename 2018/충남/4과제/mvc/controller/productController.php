<?php

	namespace Controller;

	/**
	 *  product Controller
	 */
	class ProductController extends _PublicController
	{
		private $category = ["전기자전거", "미니전기자동차", "전기스쿠터", "전기자동차", "장거리전기자동차"];

		public function __construct()
		{
			parent::__construct();
		}

		public function index()
		{
			$category = $this->category[$_GET["type"]];
			$product_list = $this->db->table("info")->fetchAll("category = ?", [$category]);

			foreach($product_list as &$list) {
				$list = $this->getQuanity($list);
			};

			return view("list", array_merge($this->result, [
				"category" => $category,
				"product_list" => $product_list,
			]));
		}

		public function detail($idx)
		{
			$product = $this->db->table("info")->fetch("idx = ?", [$idx]);

			$this->result["type"] = array_search($product["category"], $this->category);
			$this->result["product"] = $product;
			return view("detail", $this->result);
		}

		public function search()
		{
			if(!$this->login)
				redirect("/member/login", "회원만 접근 가능합니다");

			$search = [
				"category" => $_GET["category"] ?? "",
				"start" => $_GET["start"] ?? "",
				"end" => $_GET["end"] ?? "",
				"s_time" => $_GET["s_time"] ?? "",
				"e_time" => $_GET["e_time"] ?? "",
				"s_date" => $_GET["s_date"] ?? "",
				"e_date" => $_GET["e_date"] ?? ""
			];

			$items = [];

			$products = $this->db->table("info")->fetchAll();

			if(isset($_GET["category"])) {
				$products = $this->db->table("info")->fetchAll("category = ?", [$_GET["category"]]);
				$s_d = "";
				$e_d = "";

				if(small($search["category"])) {
					$s_d = date("Y-m-d ".$search["s_time"].":00");
					$e_d = date("Y-m-d ".$search["e_time"].":00");
				} else {
					$s_d = date($_GET["s_date"]);
					$e_d = date($_GET["e_date"]);
				};

				foreach ($products as $key => &$product) {
					$info = $this->getResInfo("
						res.type = ? &&
						res.product = ? &&
						res_info.state != ? &&
						!(res.e_time < ? || res.s_time > ?)", 
						["buy", $product["idx"], "예약취소", $s_d, $e_d],
						"fetchAll"
					);

					$product["use_quantity"] = $product["quantity"] - count($info);
				};
			} else {
				foreach($products as &$product) {
					$product = $this->getQuanity($product);
				};
			};

			if(isset($_SESSION["items"])) {
				foreach ($_SESSION["items"] as $key => $item) {
					$item_product = $this->db->table("info")->fetch("idx = ?", [$item["product"]]);
					$item["product"] = $item_product;

					$items[] = $item;
				};
			};

			$_SESSION["search"] = $search;

			$this->result = array_merge($this->result, $search);
			$this->result["places"] = ["여수시", "순천시", "목포시", "담양군", "보성군", "완도군", "해남군", "구례군"];
			$this->result["products"] = $products;
			$this->result["items"] = $items;

			return view("rental", $this->result);
		}

		public function add($idx)
		{
			$_SESSION["items"] = $_SESSION["items"] ?? [];
			$search = $_SESSION["search"];

			$small = small($search["category"]);

			$_SESSION["items"][] = [
				"start" => $search["start"],
				"end" => $search["end"],
				"s_time" => $small ? date("Y-m-d ".$search["s_time"].":00") : date($search["s_date"]),
				"e_time" => $small ? date("Y-m-d ".$search["e_time"].":00") : date($search["e_date"]),
				"product" => $idx,
				"buy_date" => date("Y-m-d"),
				"type" => "res",
			];

			return redirect(urldecode($_GET["back"]), "추가가 완료되었습니다.");
		}

		public function delete($key)
		{
			unset($_SESSION["items"][$key]);
			return redirect(urldecode($_GET["back"]), "삭제가 완료되었습니다.");
		}

		public function multiple()
		{
			if(!isset($_POST["idx"]))
				redirect("/", "유효하지 않는 값 입니다.");

			$items = [];

			foreach ($_SESSION["items"] as $key => $item) {
				if(!in_array($key, $_POST["idx"]))
					continue;

				$item_product = $this->db->table("info")->fetch("idx = ?", [$item["product"]]);
				$item["product"] = $item_product;

				$items[] = $item;
			};

			$this->result["items"] = $items;
			return view("multiple", $this->result);
		}

		public function addImage($idx)
		{
			$file = $_FILES["file"];

			if($file["name"] == "")
				redirect("back", "파일을 선택해주세요.");

			$this->matchs([
				[!preg_match("/^image\/(jpeg|png|gif)$/", $file["type"]), "jpeg, jpg, png만 등록가능합니다."]
			]);

			if(!$this->msg) {
				$image = explode(",", $this->db->table("info")->fetch("idx = ?", [$idx])["detail"]);
				$filename = date("YmdHis")."_".rand(111, 999).".".pathinfo($file["name"])["extension"];

				move_uploaded_file($file["tmp_name"], ROOT."/images/".$filename);

				$image[] = $filename;

				$this->db->update([
					"detail" => join(",", $image)
				], $idx);

				redirect("/product/detail/{$idx}", "추가가 완료되었습니다.");
			} else {
				redirect("back", $this->msg);
			};
		}

		public function res($idx)
		{
			if(!$this->login)
				redirect("/member/login", "회원만 접근 가능합니다.");

			$product = $this->db->table("info")->fetch("idx = ?", [$idx]);
			$res = $this->getResInfo(
				"res.type = ? && res.product = ? && res_info.state != ? && res.e_time > ?",
				["buy", $product['idx'], "예약취소", date("Y-m-d H:i:s")],
				"fetchAll"
			);

			$s_time = array_column($res, "s_time");
			$e_time = array_column($res, "e_time");
			$use_list = [];

			if(small($product["category"])) {
				for ($i=0; $i < count($s_time); $i++) { 
					for ($j=stt($s_time[$i]); $j < stt($e_time[$i]); $j+=3600) { 
						$use_list[] = date("H:i", $j);
					};
				};
			} else {
				for ($i=0; $i < count($s_time); $i++) { 
					for ($j=stt($s_time[$i]); $j < stt($e_time[$i]); $j+=86400) { 
						$use_list[] = date("Y-m-d", $j);
					};
				};
			};

			return view("reservation", array_merge($this->result, [
				"product" => $product,
				"use_list" => $use_list,
			]));
		}

		public function postRes($idx)
		{
			$product = $this->db->table("info")->fetch("idx = ?", [$idx]);

			$s_date = date($_POST["s_time"]);
			$e_date = date($_POST["e_time"]);

			if (small($product["category"])) {
				$s_date = date("Y-m-d ".$_POST["s_time"].":00");
				$e_date = date("Y-m-d ".$_POST["e_time"].":00");
			};

			$this->matchs([
				[$_POST["s_time"] == "", "대여 시간(일)을 입력해주세요"],
				[$_POST["e_time"] == "", "반납 시간(일)을 입력해주세요"],
				[!isset($_POST["s_place"]), "대여지점을 선택해주세요."],
				[!isset($_POST["e_place"]), "반납지점을 선택해주세요."],
			]);

			if(!$this->msg) {
				$idx = $this->db->table("res")->insert([
					"start" => $_POST["s_place"],
					"end" => $_POST["e_place"],
					"s_time" => $s_date,
					"e_time" => $e_date,
					"product" => $idx,
					"user" => $this->login["idx"],
					"type" => "res",
					"buy_date" => date("Y-m-d"),
				]);

				return redirect("/product/cardPay/{$idx}");
			} else {
				return redirect("back", $this->msg);
			}
		}

		public function cardPay($idx)
		{
			$product = $this->getRes("res.idx = ?", [$idx], "fetch");

			$this->result["product"] = $product;

			return view("cardPay", $this->result);
		}

		public function buy($idx)
		{
			if($_POST["type"] == "card") {
				$this->matchs([
					[!isset($_POST["bank"]), "카드를 선택해주세요."],
					[mb_strlen($_POST["cardNum"]) != 16, "카드번호 16자리를 입력해주세요."]
				]);
			} else {
				$this->matchs([
					[!isset($_POST["no_bank"]), "카드를 선택해주세요."],
					[$_POST["send_name"] == "", "송금자명 입력해주세요."],
					[$_POST["phone"] == "", "전화번호를 입력해주세요."],
				]);
			};

			if(!$this->msg) {
				$insertData = [
					"type" => $_POST["type"],
					"r_idx" => $idx,
					"price" => $_POST["price"],
					"midx" => $this->login["idx"],
					"state" => "대기중",
				];

				if($_POST["type"] == "bank") {
					list($bank, $card) = explode(" : ", $_POST["no_bank"]);

					$insertData = array_merge($insertData, [
						"send_name" => $_POST["send_name"],
						"phone" => $_POST["phone"],
						"bank" => $bank,
						"card" => $card,
					]);
				} else {
					$insertData = array_merge($insertData, [
						"bank" => $_POST["bank"],
						"card" => $_POST["cardNum"]
					]);
				};

				$this->db->table("res")->update([
					"type" => "buy",
				], $idx);
				$this->db->table("res_info")->insert($insertData);

				redirect("/member/mypage", "결제가 완료되었습니다.");
			} else {
				redirect("back", $this->msg);
			};
		}

		public function multibuy()
		{
			if($_POST["type"] == "card") {
				$this->matchs([
					[!isset($_POST["bank"]), "카드를 선택해주세요."],
					[mb_strlen($_POST["cardNum"]) != 16, "카드번호 16자리를 입력해주세요."]
				]);
			} else {
				$this->matchs([
					[!isset($_POST["no_bank"]), "카드를 선택해주세요."],
					[$_POST["send_name"] == "", "송금자명 입력해주세요."],
					[$_POST["phone"] == "", "전화번호를 입력해주세요."],
				]);
			};

			if(!$this->msg) {
				foreach (explode(",", $_POST["check"]) as $key => $idx) {
					$item = $_SESSION["items"][$idx];
					$item["user"] = $this->login["idx"];
					$item["buy_date"] = date("Y-m-d");
					$item["type"] = "buy";

					$res_idx = $this->db->table("res")->insert($item);

					$insertData = [
						"type" => $_POST["type"],
						"r_idx" => $res_idx,
						"price" => $_POST["price"],
						"midx" => $this->login["idx"],
						"state" => "대기중",
					];

					if($_POST["type"] == "bank") {
						list($bank, $card) = explode(" : ", $_POST["no_bank"]);

						$insertData = array_merge($insertData, [
							"send_name" => $_POST["send_name"],
							"phone" => $_POST["phone"],
							"bank" => $bank,
							"card" => $card,
						]);
					} else {
						$insertData = array_merge($insertData, [
							"bank" => $_POST["bank"],
							"card" => $_POST["cardNum"]
						]);
					};

					$this->db->table("res_info")->insert($insertData);
				};

				redirect("/member/mypage", "결제가 완료되었습니다.");
				
				unset($_SESSION["items"]);
			} else {
				redirect("back", $this->msg);
			};
		}
	}