<?php

	namespace Controller;

	/**
	 * 	notebook Controller
	 */
	class notebookController extends _PublicController
	{
		public function __construct($method)
		{
			parent::__construct();

			if( 
				@$this->login["type"] != "판매자" && 
				($method == "add" || $method == "modify")
			) {
				redirect("/", "접근 불가!");
			};
		}

		public function add()
		{
			return view("item_reg", $this->result);
		}

		public function modify()
		{
			array_ref($this->result, [
				"notebooks" => $this->db->table("notebook")->fetchAll("user_id = ?", [$this->login['id']]),
			]);
			return view("item_mod", $this->result);
		}

		public function list()
		{
			$all_product = $this->db->table("notebook")->fetchAll("
				1 
				GROUP BY code, company
				order by real_price desc
			", [], "*, MIN(real_price) as min_price, count(code) as count");

			$tags = [];
			$companys = [];
			
			foreach ($all_product as $key => &$product) {
				$this->getTags($product);
				array_ref($tags, $product["tag_list"]);

				if (!in_array($product["company"], $companys)) {
					$companys[] = $product["company"];
				};
			};

			$tags = array_unique($tags);

			array_ref($this->result, [
				"tags" => $tags,
				"companys" => $companys,
				"all_product" => $all_product,
			]);

			return view("item_list", $this->result);
		}

		public function compare()
		{
			return view("price_list", $this->result);
		}

		public function getList()
		{
			array_shift($_POST["tag"]);
			array_shift($_POST["company"]);

			$min_price = str_replace(",", "", $_POST["min_price"]);
			$max_price = str_replace(",", "", $_POST["max_price"]);

			$all_product = $this->db->table("notebook")->fetchAll("
				real_price BETWEEN ? AND ? 
				GROUP BY code, company
				order by real_price desc
			", [$min_price, $max_price], "*, MIN(real_price) as min_price, count(code) as count");

			foreach ($all_product as $key => &$product)
				$this->getTags($product);


			$all_product = array_filter($all_product, function($arr) {
				$error = false;
				if(
					( $_POST["tag"] && !array_intersect($arr["tag_list"], $_POST["tag"]) ) ||
					( $_POST["company"] && !in_array($arr["company"], $_POST["company"]) )
				) {
					$error = true;
				};

				if(!$error)
					return $arr;
			});

			echo json_encode($all_product);
		}

		public function detail($idx)
		{
			$product = $this->getNote("notebook.idx = ?", [$idx]);
			$this->getTags($product);

			$this->result["product"] = $product;

			return view("product", $this->result);
		}

		public function postAdd()
		{
			$dir = $this->addAndModify("add");
			redirect(...$dir);
		}

		public function postModify()
		{
			$type = isset($_POST["modify"]) ? "modify" : "delete";

			if(!isset($_POST["idx"]))
				redirect("/notebook/modify", "상품을 선택해주세요");

			if($type == "modify") {
				$dir = $this->addAndModify("modify");
			} else {
				$this->db->table("notebook")->delete("idx = ?", [$_POST['idx']]);
				$dir = ["/notebook/modify", "선택한 상품이 삭제되었습니다"];
			};

			redirect(...$dir);
		}

		private function addAndModify($action_type)
		{
			$file = $_FILES["file"];

			$this->match([
				[ $_POST["name"] == "", "상품명을 입력해주세요." ],
				[ $_POST["code"] == "", "상품코드을 입력해주세요." ],
				[ $_POST["price"] == "", "판매가을 입력해주세요." ],
				[ $_POST["point"] == "", "포인트를 입력해주세요." ],
				[ $_POST["carry"] == "", "배송비를 입력해주세요." ],
				[ $_POST["tag"] == "", "태그를 입력해주세요." ],
				[ $_POST["company"] == "", "제조사를 입력해주세요." ],
			]);

			if($action_type == "add" && $file["name"] == "")  {
				$this->msg[] = "파일을 선택해주세요.";
			};

			if($file["name"] != "" && !preg_match('/^image\/.+$/', $file["type"])) {
				$this->msg[] = "이미지를 업로드 해주세요.";
			};

			if(!$this->msg) {
				if($file["name"] != "") {
					$filename = date("YmdHis")."_".rand(111, 999).".".pathinfo($file["name"])["extension"];
					move_uploaded_file($file["tmp_name"], ROOT."/data/$filename");
				} else {
					$filename = $this->db->table("notebook")->fetch("idx = ?", [$_POST['idx']])["image"];
				};

				$post_data =  [
					"name" => $_POST["name"],
					"price" => number_format($_POST["price"]),
					"tag" => $_POST["tag"],
					"image" => $filename,
					"point" => $_POST["point"],
					"code" => $_POST["code"],
					"company" => $_POST["company"],
					"carry" => $_POST["carry"],
				];

				if($action_type == "add") {
					$post_data["user_name"] = $this->login["name"];
					$post_data["user_id"] = $this->login["id"];

					$idx = $this->db->table("notebook")->insert($post_data);
				} else {
					$idx = $_POST["idx"];
					$this->db->table("notebook")->update($post_data, $idx);
				};

				$dir = [
					"/notebook/detail/{$idx}", 
					$action_type == "add" ? "상품이 등록되었습니다" : "선택한 상품이 수정되었습니다"
				];
			} else {
				$dir = [$action_type == "add" ? "/notebook/add" : "back", $this->msg];
			};

			return $dir;
		}

		public function buy($idx)
		{
			if(!$this->login)
				redirect("/member/login", "로그인 후 이용 가능합니다");

			$product = $this->getNote("notebook.idx = ?", [$idx], "fetch");

			$this->db->table("buy")->insert([
				"p_name" => $product['name'],
				"pidx" => $product['idx'],
				"count" => $_POST["count"],
				"p_phone" => $product["phone"],
				"midx" => $this->login["idx"],
			]);

			redirect("/member/order", "구매가 완료되었습니다");
		}

		public function getData()
		{
			echo json_encode($this->db->table("notebook")->fetch("idx = ?", [$_POST['idx']]));
		}

		public function compareList()
		{
			if($_POST["point"] == 0 && $_POST["carry"] == 0) {
				$order = "ORDER BY real_price asc, name ASC";
			};

			if($_POST["point"] == 1 && $_POST["carry"] == 0) {
				$order = "ORDER BY point_price DESC";
			};

			if($_POST["point"] == 0 && $_POST["carry"] == 1) {
				$order = "ORDER BY carry_price DESC";
			};

			if($_POST["point"] == 1 && $_POST["carry"] == 1) {
				$order = "ORDER BY total_price DESC";
			};

			$products = $this->db->table("notebook")->fetchAll("
				code = ? {$order}
			", 
			[$_POST["code"]],
			"
				*,
				real_price - point as point_price,
				real_price + carry as carry_price,
				real_price - point + carry as total_price
			");

			foreach ($products as $key => &$product) {
				$this->getTags($product);
			};

			echo json_encode($products);
		}
	}