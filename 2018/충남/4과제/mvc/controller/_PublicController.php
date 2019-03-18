<?php

	namespace Controller;

	use Model\_Base;

	/**
	 *  PublicController
	 */
	class _PublicController
	{
		public $result = [];
		public $msg = [];

		public function __construct()
		{
			$this->login = 
			$this->result["login"] = $_SESSION["login"] ?? false;
			
			$this->db = new _Base;
		}

		public function matchs($match)
		{
			foreach ($match as $key => $req) {
				if ($req[0])
					$this->msg[] = $req[1];
			};
		}

		public function init()
		{
			$this->db->table("member")->delete();
			$this->db->table("info")->delete();

			$members = json_decode(file_get_contents(ROOT."/data/member.json"), true);

			foreach ($members as $key => $m) {
				$this->db->table("member")->insert([
					"name" => $m["name"],
					"id" => $m["id"],
					"pw" => $m["pw"],
					"level" => $m["level"],
				]);
			};

			$infos = json_decode(file_get_contents(ROOT."/data/info.json"), true);

			foreach ($infos as $key => $info) {
				$this->db->table("info")->insert($info);
			};
		}

		public function getRes($where = 1, $param = [], $fetching = "fetch")
		{
			return $this->db->mq("
				SELECT *, res.idx as idx FROM res
				LEFT JOIN `info`
				ON info.idx = res.product
				WHERE {$where}
			", $param)->$fetching();
		}

		public function getResInfo($where = 1, $param = [], $fetching = "fetch")
		{
			$data = $this->db->mq("
				SELECT 
					res.*, 
					res.idx as ridx,
					info.*,
					info.name as product_name,
					res_info.price as buyprice,
					res_info.state as state,
					res_info.idx as i_idx,
					res_info.cancle as cancle,
					res_info.type as info_type,
					res_info.bank as info_bank,
					res_info.card as info_card,
					member.*,
					member.idx as midx,
					member.name as username
				FROM `res`
				INNER JOIN `res_info`
				ON res.idx = res_info.r_idx
				LEFT JOIN `info`
				ON info.idx = res.product
				LEFT JOIN `member`
				ON member.idx = res.user
				WHERE {$where}
			", $param)->$fetching();

			if($fetching == "fetch") {
				$data = $this->getState($data);
			} else {
				foreach ($data as $key => &$value) {
					$value = $this->getState($value);
				};
			};

			return $data;
		}

		public function getState($res)
		{
			if(stt($res["e_time"]) < stt("now")) {
				if($res["state"] == "대기중") {
					$res["state"] = "예약취소";

					if($res["cancle"] == "")
						$res["cancle"] = "관리자의 의해 취소되었습니다.";

				} else if($res["state"] == "결제완료") {
					$res["state"] = "반납완료";
					$res["cancle"] = "반납되었습니다.";
				};
			};

			return $res;
		}

		public function getQuanity($product)
		{
			$info = $this->getResInfo("
				res.type = ? && res.product = ? && res_info.state != ? && res.e_time > ?", 
				["buy", $product["idx"], "예약취소", date("Y-m-d H:i:s")],
				"fetchAll"
			);

			$product["use_quantity"] = $product["quantity"] - count($info);

			return $product;
		}
	}