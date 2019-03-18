<?php

	namespace Model;

	class house extends _Base {
		public static function getAll($sql = 1) {
			$houseList = self::ma("SELECT * FROM `house` WHERE {$sql}");

			return $houseList;
		}
	}