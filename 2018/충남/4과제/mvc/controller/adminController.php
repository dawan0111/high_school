<?php

	namespace Controller;

	/**
	 * 	admin Controller
	 */
	class adminController extends _PublicController
	{
		public function __construct()
		{
			parent::__construct();

			if($this->login["id"] != "admin") {

			}
		}

		public function index()
		{
			$res_datas = $this->getResInfo("res.type = ? && res_info.state != ? order by res_info.state desc, res.e_time desc", 
				["buy", "예약취소"], 
				"fetchAll"
			);

			$res_datas = array_filter($res_datas, function($arr) {
				if($arr["state"] != "예약취소")
					return $arr;
			});

			$this->result["res_data"] = $res_datas;
			return view("admin", $this->result);
		}

		public function item()
		{
			$res_datas = $this->getResInfo("
				res.type = ? && (res_info.state = ? || res_info.state = ?) order by res_info.state asc, res.e_time desc",
				["buy", "대기중", "예약취소"],
				"fetchAll"
			);

			$this->result["res_datas"] = $res_datas;
			return view('item', $this->result);
		}

		public function material()
		{
			$month = $_GET["month"] ?? date("m");

			$month = $month > 12 ? 1 : $month;
			$month = $month < 1 ? 12 : $month;

			$result = $this->getMonthData($month);

			return view("material", array_merge($this->result, [
				"month" => $month,
				"result" => $result,
			]));
		}

		public function resOk($idx)
		{
			$this->db->table("res_info")->update([
				"state" => "결제완료",
			], $idx);

			return redirect("/admin/index", "결제가 완료되었습니다.");
		}

		public function cancle($info_idx)
		{
			$this->db->table("res_info")->update([
				"state" => "예약취소",
				"cancle" => "관리자의 의해 취소되었습니다.",
			], $info_idx);

			return redirect("/admin/item", "에약취소가 완료되었습니다.");
		}

		public function graph()
		{
			$month = $_GET["month"];
			$month_data = $this->getMonthData($month);

			$image = imagecreatetruecolor(1440, 500);
			$max = max(array_column($month_data, "count"));
			$max += ceil($max / 3);
			$font = ROOT."/font/malgun.ttf";

			$black = 0x000000;

			imagefill($image, 0, 0, 0xffffff);
			imagettftext($image, 20, 0, 100, 50, $black, $font, "기간별 매출관리 현황");

			for ($i=1; $i <= 6; $i++) { 
				/* 380 */
				$y = 63.33 * $i + 40;
				$label = $max / 5 * (5 - ($i - 1));

				imageline($image, 100, $y, 1340, $y, $black);
				imagettftext($image, 12, 0, 50, $y + 5, $black, $font, number_format($label, 1));
			};

			for ($i=1; $i <= count($month_data); $i++) { 
				$x = 1240 / count($month_data) * $i + 70;
				$data = $month_data[$i - 1];

				$label = str_replace(".", "/", $data["date"]);
				imagettftext($image, 8, 0, $x, 440, $black, $font, $label);

				if($max != 0) 
					$height = 3.16 * ($data["count"] / $max * 100);
				else
					$height = 0;

				imagefilledrectangle($image, $x+2, 420 - $height, $x + 22, 420, 0x00b2ff);
			};

			header("Content-type:image/png");
			imagepng($image);
		}

		public function getMonthData($month)
		{
			$result = [];
			$date = date("Y-{$month}-d");
			$end_date = date("Y-{$month}-t");

			$d_month = sprintf("%02d", $month);

			for ($i=date("d", strtotime($date)) * 1; $i <= explode("-", $end_date)[2]; $i++) { 

				$d_day = sprintf("%02d", $i);

				$data = $this->db->table("res")->mq("
					SELECT
						COUNT(res.idx) as count,
						SUM(res_info.price) as price
					FROM `res`
					INNER JOIN `res_info`
					ON res.idx = res_info.r_idx
					WHERE res.buy_date = ?
					GROUP BY res.buy_date
				", [date("Y-{$month}-{$i}")])->fetch();

				if(!isset($data["count"])) {
					$data["count"] = 0;
					$data["price"] = 0;
				};
				$data["date"] = $d_month.".".$d_day;

				$result[] = $data;
			};

			return $result;
		}
	}