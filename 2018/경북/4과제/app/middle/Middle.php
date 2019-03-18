<?php

	namespace Middle;

	/**
	 * Middle
	 	최단거리 및 최적량 알고리즘
	 */
	class Middle
	{
		public static $find_list = [];
		public static $find_len = 0;

		public static $nice_weight = -1;

		public static $max_weight = 0;
		public static $weight_list = [];

		public static $map = [];
		public static $min = INF;
		public static $min_list = [];

		public static function getWeight($products)
		{
			self::$max_weight = USER["weight"];
			self::$find_list = $products;
			self::$find_len = count(self::$find_list);

			self::findGetWeight([], 0, -1);

			return [self::$nice_weight, self::$weight_list];
		}

		public static function findGetWeight($step, $weight, $start)
		{
			$nextStep = false;

			for ($i=$start + 1; $i < self::$find_len; $i++) { 
				$product = self::$find_list[$i];

				if(
					$weight + $product["weight"] <= self::$max_weight
				) {
					$nextStep = true;

					$now_step = $step;
					$now_step[] = $product['idx'];

					self::findGetWeight($now_step, $weight + $product["weight"], $i);
				};
			};

			if(!$nextStep) {
				if(self::$nice_weight <= $weight) {
					if(self::$nice_weight < $weight) {
						self::$nice_weight = $weight;
						self::$weight_list = [];
					};

					self::$weight_list[] = $step;
				};
			};
		}

		public static function getFast($weight_list, $map)
		{
			self::$map = $map;
			self::$min = INF;
			self::$min_list = [];

			$locations = array_unique(array_column($weight_list, "location"));

			self::$find_list = $locations;
			self::$find_len = count($locations);

			foreach (self::$find_list as $key => $data) {
				self::getFastList([$data], 1, 0, $data);
			};

			return [self::$min_list, self::$min];
		}

		public static function getFastList($step, $count, $spend, $start)
		{
			if(self::$min < $spend)
				return;

			if($count == self::$find_len && self::$min >= $spend) {
				if(self::$min > $spend) {
					self::$min = $spend;
					self::$min_list = [];
				};

				self::$min_list[] = $step;
				return;
			};

			foreach (self::$find_list as $key => $data) {
				if (!in_array($data, $step)) {
					$now_step = $step;
					$now_step[] = $data;

					self::getFastList($now_step, $count + 1, $spend + self::$map[$start][$data], $data);
				};
			};
		}
	}