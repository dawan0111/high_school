<?php

	namespace Controller;

	use Model\Website;
	use Model\board;
	use Model\post;

	class page
	{
		public $result = [];
		public function __construct() {
			$webSite = Website::getWebSite("normal");

			$this->result['webSite'] = $webSite;
		}
		public function main()
		{
			$normalBoard = board::getMainBoard('normal');
			$main_post = array_slice(post::getPost($normalBoard['id']), 0, 5);

			$imageBoard = board::getMainBoard('photo');
			$image_post = array_slice(post::getPost($imageBoard['id']), 0, 5);

			$this->result['normalBoard'] = $normalBoard;
			$this->result['main_post'] = $main_post;
			$this->result['imageBoard'] = $imageBoard;
			$this->result['image_post'] = $image_post;

			return layoutView("/page/main", $this->result);
		}

		public function register()
		{
			return layoutview("/page/register", $this->result);
		}
		public function normalboard($url)
		{
			$board = board::getBoard([$url])[0];
			$all_post = post::getPost($url);

			$this->result['pageing'] = $this->pageing($all_post);
			$this->result['all_post'] = $this->result['pageing']['total_post'];
			$this->result['idx'] = $url;

			return layoutview("/page/normalboard", $this->result);
		}
		public function normalboardWrite($url)
		{
			if(!isset($_SESSION['id'])) {
				return redirect('/page/normalboard', "회원만 글쓰기가 가능합니다.");
			};

			$this->result['idx'] = $url;

			return layoutView("/page/normalboardWrite", $this->result);
		}
		public function pictureboard($url)
		{
			$board = board::getBoard([$url])[0];
			$all_post = post::getPost($url);

			$this->result['pageing'] = $this->pageing($all_post);
			$this->result['all_post'] = $this->result['pageing']['total_post'];
			$this->result['idx'] = $url;

			return layoutView("/page/pictureboard", $this->result);
		}

		public function pictureboardWrite($url)
		{
			if(!isset($_SESSION['id'])) {
				return redirect('/page/normalboard', "회원만 글쓰기가 가능합니다.");
			};

			$this->result['idx'] = $url;

			return layoutView("/page/pcitureboardWrite", $this->result);
		}

		public function normalboardView($url)
		{
			$post = post::loadPost($url);

			$this->result['post'] = $post;

			return layoutView("/page/normalboardView", $this->result);
		}

		public function pictureboardView($url)
		{
			$post = post::loadPost($url);
			$this->result['post'] = $post;

			return layoutView("/page/pictureboardView", $this->result);
		}

		public function pageing($total)
		{
			$page = isset($_GET['page']) ? $_GET['page'] : 1;
			$page_limit = 10;
			$block_limit = 10;

			$total_num = count($total);
			$total_page = ceil($total_num / $page_limit);
			$total_block = ceil($total_page / $block_limit);
			$block = ceil($page / $block_limit);
			$block_start = ($page - 1) * $block + 1;
			$block_end = $block_limit * $block;

			$limit_start = ($page - 1) * $page_limit;
			$limit_end = $page * $page_limit;

			$view_post = array_slice($total, $limit_start, $limit_end);

			return [
				"total_post" => $view_post,
				"block_end" => $block_end,
				"page" => $page,
				"block_start" => $block_start,
				"total_page" => $total_page,
			];
		}

		public function boardModify($url)
		{
			$this->result['idx'] = $url;
			$this->result['post'] = post::loadPost($url);

			return layoutView("/page/boardModify", $this->result);
		}

		public function admin()
		{
			$board = board::allGet();
			$image = "";

			if(isset($_GET['bid'])) {
				$nowtime = strtotime("now");
				switch ($_GET['term']) {
					case 'min':
						$prevTime = $nowtime - 600;
						$unit = 60;
						break;
					case 'hour':
						$prevTime = $nowtime - 36000;
						$unit = 3600;
						break;
					case 'day':
						$prevTime = $nowtime - 864000;
						$unit = 86400;
						break;
				};

				$startdate = date('Y-m-d H:i:s', $prevTime);
				$enddate = date('Y-m-d H:i:s', $nowtime);

				$time_post = post::timePostGet($startdate, $enddate, $_GET['bid']);
				$time_post_count = [];

				for ($i=0; $i <= 9; $i++) { 
					foreach($time_post as $key => $value) {
						$posttime = strtotime($value['date']);

						if($prevTime < $posttime && $posttime < $prevTime + $unit) {
							@$time_post_count[$i]++;
						};
					};

					if(!isset($time_post_count[$i])) {
						$time_post_count[$i] = 0;
					}
					$prevTime += $unit;
				};

				$image = imagecreatetruecolor(650, 300);
				$yTop = 20;
				$xLeft = 60;
				$betweenX = (650 - 60) / 10;
				$maxCount = max($time_post_count);
				$maxCount == 0 ? $maxCount = 1 : "";  
				$lineYbetween = floor(240 / $maxCount);

				imagefill($image, 0, 0, "0xffffff");
				imageline($image, $xLeft, $yTop, $xLeft, 300, "0x000000");
				imageline($image, $xLeft-30, 260, 650, 260, "0x000000");

				for ($i=1; $i <= 10; $i++) { 
					imagefilledellipse ($image, $xLeft + $betweenX * ($i-1), 260-$time_post_count[$i-1]*$lineYbetween, 5, 5, "0x1e00ff");
					imagettftext($image, 10, 0, $xLeft + $betweenX * ($i-1) + 5, 260-$time_post_count[$i-1]*$lineYbetween - 5, "0x000000", $_SERVER['DOCUMENT_ROOT']."/font/malgun.ttf", $time_post_count[$i-1]);

					if($i != 1) {
						imageline($image, $xLeft + $betweenX * ($i-2), 260-$time_post_count[$i-2]*$lineYbetween, $xLeft + $betweenX * ($i-1), 260-$time_post_count[$i-1]*$lineYbetween, "0x000000");
					};
					$string = "-".(10-$i);
					if($i == 10) {
						$string = "-현재";
					}

					imagettftext($image, 10, 0, $xLeft + $betweenX * ($i-1), 280, "0x000000", $_SERVER['DOCUMENT_ROOT']."/font/malgun.ttf", $string);
				};

				ob_start();
				imagepng($image);
				$image = ob_get_clean();

				$image = "<img src='data:image/png;base64,".base64_encode( $image )."' />";
			};

			$this->result['image'] = $image;
			$this->result['unit'] = isset($_GET['term']) ? $_GET['term'] : "";
			$this->result['bid'] = isset($_GET['bid']) ? $_GET['bid'] : "";
			$this->result['board'] = $board;

			return layoutView("/page/admin", $this->result);
		}

		public function admintag()
		{
			$tag = $this->result['webSite']['tag'];

			$this->result['tag'] = explode(", ", $tag);
			return layoutView("page/admin-tag", $this->result);
		}

		public function boardsetting()
		{
			$normalBoard = board::typeGet('normal');
			$photoBoard = board::typeGet('photo');

			$this->result['nboard'] = $normalBoard;
			$this->result['pboard'] = $photoBoard;

			return layoutView("page/boardsetting", $this->result);
		}
	}