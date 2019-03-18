<?php

	namespace Controller;

	/**
	 * 	graphController
	 */
	class graphController extends _PublicController
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function product()
		{
			$image = imagecreatetruecolor(500, 350);

			$product_list = $this->db->mq("
				SELECT
					SUM(buy.count) as count,
					notebook.code as name
				FROM `buy`
				INNER JOIN `notebook`
				ON notebook.idx = buy.pidx
				GROUP BY notebook.code
			")->fetchAll();

			$this->drawImage("가장 많이 팔린 상품",$image, $product_list);

			header("Content-type:image/png");
			imagepng($image);
		}

		public function saler()
		{
			$image = imagecreatetruecolor(500, 350);

			$product_list = $this->db->mq("
				SELECT
					SUM(buy.count) as count,
					notebook.user_id as name
				FROM `buy`
				INNER JOIN `notebook`
				ON notebook.idx = buy.pidx
				GROUP BY notebook.user_id
			")->fetchAll();

			$this->drawImage("가장 많이 판 판매자",$image, $product_list);

			header("Content-type:image/png");
			imagepng($image);
		}

		public function company()
		{
			$image = imagecreatetruecolor(500, 350);
			
			$product_list = $this->db->mq("
				SELECT
					SUM(buy.count) as count,
					notebook.company as name
				FROM `buy`
				INNER JOIN `notebook`
				ON notebook.idx = buy.pidx
				GROUP BY notebook.company
			")->fetchAll();

			$this->drawImage("가장 많이 팔린 제조사",$image, $product_list);

			header("Content-type:image/png");
			imagepng($image);
		}

		public function drawImage($title, $image, $data)
		{
			$color = [0xfe0000, 0x00ff01, 0x0000fe, 0xffff01, 0x01ffff];
			$font = ROOT."/font/malgun.ttf";
			$black = 0x000000;
			imagefill($image, 0, 0, 0xffffff);
			imagettftext($image, 16, 0, 160, 40, $black, $font, $title);

			for ($i=0; $i < count($data) - count($color); $i++) { 
				$color[] = mt_rand(0x000000, 0xFFFFFF);
			};

			$lastEnd = -90;
			$labelY = 100;
			$total = array_sum(array_column($data, "count"));

			foreach ($data as $key => $val) {
				$prt = $val["count"] / $total * 100;
				imagefilledarc($image, 120, 175, 200, 200, $lastEnd, $lastEnd += 3.6 * $prt, $color[$key], IMG_ARC_PIE);

				imagefilledrectangle($image, 250, $labelY, 270, $labelY + 20, $color[$key]);
				imagettftext($image, 10, 0, 280, $labelY + 15, $black, $font, $val["name"]);

				$labelY += 30;
			};
		}
	}