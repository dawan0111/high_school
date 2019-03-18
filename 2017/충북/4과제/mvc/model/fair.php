<?php

	namespace Model;

	class fair extends _Base
	{
		public static function prevres($idx)
		{
			return self::ma("SELECT * FROM `fair` WHERE `boothidx` = ?", [$idx]);
		}
		public static function add($value, $filename, $idx)
		{
			self::insert("fair", [
				"name" => $value['name'],
				"startdate" => $value['startdate'],
				"enddate" => $value['enddate'],
				"max_people" => $value['max_people'],
				"intro" => $value['intro'],
				"boothidx" => $idx,
				"image" => $filename,
			]);
		}
		public static function getFestival($idx)
		{
			return self::ma("SELECT * FROM `fair` WHERE `boothidx` = ?", [$idx]);
		}
		public static function loadFestival($idx)
		{
			return self::mf("SELECT * FROM `fair` WHERE `idx` = ?", [$idx]);
		}

		public static function dateFormat($fair)
		{
			$fair['startdate'] = self::dateFormat($fair['startdate']);
			$fair['enddate'] = self::dateFormat($fair['enddate']);

			return $fair;
		}
	}