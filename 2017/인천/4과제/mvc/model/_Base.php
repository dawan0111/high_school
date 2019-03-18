<?php

	namespace Model;

	use \PDO;

	class _Base {
		/* DB에 연결 */
		public static function mq($query = 1, $param = []) {
			$db = new PDO("mysql:host=127.0.0.1;dbname=in1000;charset=utf8", "root", "", [
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
			]);

			$q = $db->prepare($query);
			$q->execute($param);

			$idx = $db->lastInsertId();

			return $idx == 0 ? $q : $idx;
		}

		public static function find($query = 1, $param = []) {
			$table = static::$table;
			return self::mq("SELECT * FROM `$table` WHERE {$query}", $param);
		}

		public static function insert($data) {
			$table = static::$table;
			$sql = "`".implode("` = ?, `", array_keys($data))."` = ?";

			return self::mq("INSERT INTO `$table` SET {$sql}", array_values($data));
		}

		public static function update($data, $idx) {
			$table = static::$table;
			$sql = "`".implode("` = ?, `", array_keys($data))."` = ?";

			self::mq("UPDATE `$table` SET {$sql} WHERE `idx` = {$idx}", array_values($data));			
		}

		public static function delete($query = 1, $param = []) {
			$table = static::$table;
			self::mq("DELETE FROM `$table` WHERE {$query}", $param);
		}
	}