<?php

	namespace Model;

	class product extends _Base {
		protected static $table = "product";

		public static function firstPage() {
			$datas = json_decode(file_get_contents(ROOT."/data/goods.json"));

			foreach($datas as $key => $data) {
				self::insert((array) $data);
			};
		}

		public static function getMainProduct($sql = 1, $param = []) {
			$result = self::mq("
				SELECT 
					*,
					p.idx as pidx,
					SUM(buy.stock) as totalBuy,
					FORMAT(p.price - p.price / 100 * p.sale, 0) as salePrice 
				FROM `product` as p
				LEFT JOIN `buy`
				ON p.idx = buy.pidx && buy.type = 'buy'
				WHERE {$sql}
				GROUP BY p.idx
				ORDER BY totalBuy desc
			", $param)->fetchAll();

			return $result;
		}

		public static function getProduct($idx) {
			return self::mq("
				SELECT 
					*,
					price - price / 100 * sale as salePrice
				FROM `product`
				WHERE `idx` = ?
			", [$idx])->fetch();
		}
	}