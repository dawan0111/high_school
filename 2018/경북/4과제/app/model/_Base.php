<?php

	namespace Model;

	use \PDO;

	/**
	 * _Base
	 */
	class _Base
	{
		public static $pdo = null;

		public static function __callStatic($method, $arg)
		{
			return self::find(...$arg)->$method();
		}

		public static function mq($query, $param)
		{
			if(!self::$pdo) {
				self::$pdo = new PDO("mysql:host=127.0.0.1;dbname=serverside;charset=utf8", "root", "", [
					19 => 2,
					3 => 2,
				]);
			};

			$q = self::$pdo->prepare($query);
			$q->execute($param);

			return $q;
		}

		public static function find($table, $where = 1, $param = [], $get = "*")
		{
			return self::mq("SELECT $get FROM $table WHERE {$where}", $param);
		}

		public static function insert($table, $data)
		{
			$sql = "`".implode("` = ?, `", array_keys($data))."` = ?";
			self::mq("INSERT INTO $table SET {$sql}", array_values($data));
			return self::$pdo->lastInsertId();
		}

		public static function update($table, $data, $where = 1, $param = [])
		{
			$sql = "`".implode("` = ?, `", array_keys($data))."` = ?";
			self::mq("UPDATE $table SET {$sql} WHERE $where", array_merge(array_values($data), $param));
		}

		public static function delete($table, $where = 1, $param = [])
		{
			self::mq("DELETE FROM $table WHERE {$where}", $param);
		}
	}