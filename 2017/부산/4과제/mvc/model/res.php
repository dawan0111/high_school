<?php

	namespace Model;

	class res extends _Base {
		public static function getAll($sql = 1) {
			return self::ma("SELECT * FROM `res` WHERE {$sql}");
		}
		public static function change($type, $idx) {
			self::mq("UPDATE `res` SET `money` = ? WHERE `idx` = ?", [$type, $idx]);
		}
	}