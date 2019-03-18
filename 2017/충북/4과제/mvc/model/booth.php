<?php

	namespace Model;

	class booth extends _Base
	{
		public static function addBooth($value)
		{
			booth::insert('booth', [
				'id' => $value['name'],
				'booth' => $value['booth'],
				'startdate' => $value['startdate'],
				'enddate' => $value['enddate'],
			]);
		}
		public static function prevRes($booth) {
			return self::ma("SELECT * FROM `booth` WHERE `booth` = ?", [$booth]);
		}

		public static function my_booth($name)
		{
			return self::ma("SELECT * FROM `booth` WHERE `id` = ? ", [$name]);
		}
		public static function getBooth($idx)
		{
			return self::mf("SELECT * FROM `booth` WHERE `idx` = ? ", [$idx]);
		}
		public static function activeBooth()
		{
			return self::ma("SELECT * FROM `booth` WHERE `enddate` > ?", [strtotime('now')]);
		}
		public static function allBooth()
		{
			return self::ma("SELECT * FROM `booth` WHERE 1");
		}
		public static function loadFestival($booth)
		{
			$booth = array_map(function($value) {
				$value['startdate'] = self::dateFormat($value['startdate']);
				$value['enddate'] =  self::dateFormat($value['enddate']);
				$value['festival'] = fair::getFestival($value['idx']);

				$value['festival'] = array_map(function($val) {
					$val['startdate'] = self::dateFormat($val['startdate']);
					$val['enddate'] =  self::dateFormat($val['enddate']);

					return $val;
				}, $value['festival']);
				return $value;
			}, $booth);

			return $booth;
		}
		public static function dateFormat($date)
		{
			return date("Y년 n월d일", strtotime($date));
		}
	}