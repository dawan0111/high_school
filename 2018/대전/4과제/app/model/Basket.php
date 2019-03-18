<?php

	namespace Model;

	/**
	 * Basket
	 */
	class Basket extends _Base
	{
		public static function getAll($where = 1, $param = [], $etc = "")
		{
			return self::fetchAll(
				"
					basket
					LEFT JOIN food
					ON basket.food_idx = food.idx
					LEFT JOIN store
					ON basket.s_user_idx = store.user_idx
				",
				$where." GROUP BY basket.idx ".$etc,
				$param,
				"
					*,
					basket.user_idx as order_user,
					basket.lavel as order_state,
					basket.idx as bidx,
					basket.quantity * food.food_price as total_price
				"
			);
		}
	}