<?php

	namespace Model;

	class userres extends _Base
	{
		public static function res($value, $idx)
		{
			self::insert("userres", [
				"day" => $value["day"],
				"people" => $value["number"],
				"fairidx" => $idx,
				"id" => $_SESSION['id'],
			]);
		}

		public static function getprevRes($idx, $day)
		{
			return self::ma("SELECT * FROM `userres` WHERE `fairidx` = ? && `day` = ?", [$idx, date("Y-m-d H:i:s", strtotime($day))]);
		}

		public static function getRemnant($data, $max)
		{
			foreach($data as $key => $value) {
				$max -= $value['people'];
			};

			return $max;
		}

		public static function memberRes($id)
		{
			return self::ma("SELECT * FROM `userres` WHERE `id` = ? ", [$id]);
		}
		public static function cancle($idx)
		{
			self::mq("DELETE FROM `userres` WHERE `idx` = ?", [$idx]);
		}
	}