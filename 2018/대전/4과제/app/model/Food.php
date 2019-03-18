<?php

	namespace Model;

	/**
	 * Food
	 */
	class Food extends _Base
	{
		public static function getAll($where = 1, $param = [], $etc = "")
		{
			return self::fetchAll("food", $where." && del = 0 ".$etc, $param, "*, IFNULL((SELECT SUM(quantity) FROM basket WHERE food_idx = food.idx && lavel > 0), 0) as quantity");
		}
	}