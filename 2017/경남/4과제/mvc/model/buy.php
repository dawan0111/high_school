<?php

	namespace Model;

	use Model\product;
	use Model\coupon;

	class buy extends _Base {
		protected static $table = "buy";

		public static function getList($id, $type = "cart") {
			$result = self::mq("
				SELECT 
					*,
					buy.idx as bidx,
					buy.stock as buyStock,
					p.price - p.price / 100 * p.sale as salePrice
				FROM `buy`
				LEFT JOIN `product` as p
				ON buy.pidx = p.idx
				WHERE buy.type = ? && buy.id = ?
				GROUP BY buy.idx
			", [$type, $id])->fetchAll();

			return $result;
		}

		public function getBuyTotal($sql = 1, $param = []) {
			$result = self::mq("
				SELECT *, FORMAT(SUM((buyprice - buyprice / 100 * cprt) * stock), 0) as total  FROM `buy` WHERE {$sql} && `type` = 'buy'
			", $param)->fetch()["total"];

			return $result;
		}

		public static function cancle($idx) {
			$list = self::find("idx = ?", [$idx])->fetch();
			$product = product::find("idx = ?", [$list['pidx']])->fetch();

			if($list["type"] == "buy") {
				product::update([
					"stock" => $product["stock"] + $list["stock"],
				], $product["idx"]);
			};

			if($list["coupon"] != 0) {
				coupon::update([
					"disabled" => false,
				], $list["coupon"]);
			};

			self::delete("idx = ?", [$idx]);
		}
	}