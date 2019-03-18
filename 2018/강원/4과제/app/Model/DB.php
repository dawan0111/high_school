<?php

	namespace Model;

	use \PDO;

	/**
	 * 	DB
	 */
	class DB
	{
		public static $pdo;

		public static function __callStatic($method, $arg) {
			return self::mq(...$arg)->$method();
		}

		public static function mq($query, $param = [])
		{
			if(!self::$pdo) {
				self::$pdo = new PDO("mysql:localhost=127.0.0.1;dbname=serverside;charset=utf8", "root", "", [
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
				]);
			};

			$q = self::$pdo->prepare($query);
			$q->execute($param);

			return $q;
		}

		public static function find($table, $where = 1, $param = [], $get = "*")
		{
			return self::mq("SELECT {$get} FROM `{$table}` WHERE {$where}", $param);
		}

		public static function delete($table, $where = 1, $param = [])
		{
			self::mq("DELETE FROM {$table} WHERE {$where}", $param);
		}
		
		public static function insert($table, $data)
		{
			$sql = "`".implode("` = ?, `", array_keys($data))."` = ?";
			self::mq("INSERT INTO `$table` SET {$sql}", array_values($data));
			return self::$pdo->lastInsertId();
		}
	}