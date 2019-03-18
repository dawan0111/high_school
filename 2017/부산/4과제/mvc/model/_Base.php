<?php

	namespace Model;

	use \PDO;

	class _Base {
		protected static function dbCon() {
			$db = new PDO("mysql:host=127.0.0.1;dbname=serverside;charset=utf8", "root", "", [
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
			]);

			return $db;
		}

		public static function mq($query, $param = []) {
			$q = self::dbCon()->prepare($query);
			$q->execute($param);

			return $q;
		}

		public static function mf($query, $param = []) {
			return self::mq($query, $param)->fetch();
		}

		public static function ma($query, $param = []) {
			return self::mq($query, $param)->fetchAll();
		}

		public static function mr($query, $param = []) {
			return self::mq($query, $param)->rowCount();
		}

		public static function insert($table, $data) {
			$key = array_keys($data);
			$value = array_values($data);

			$sql = "`".implode("` = ?, `", $key)."` = ?";

			self::mq("INSERT INTO `{$table}` SET ".$sql, $value);
		}
	}