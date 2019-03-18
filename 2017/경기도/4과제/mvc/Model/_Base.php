<?php

	namespace Model;

	abstract class _Base
	{

		protected static function dbCon ()
		{
			static $pdo = null;
			if (null === $pdo)
			{
				try {
					$pdo = new \PDO("mysql:host=localhost; 
						dbname=homepage; charset=utf8;", 'root', '');
				} catch (\PDOException $e) {
					echo "<pre>".var_dump($e)."</pre>";
				}
			}
			return $pdo;
		}

		protected static function mq($sql, $param = []) {
			$q = self::dbCon()->prepare($sql);
			$q->execute($param);

			return $q;
		}
		protected static function mf($sql, $param = []) {
			return self::mq($sql, $param)->fetch();
		}
		protected static function ma($sql, $param = []) {
			return self::mq($sql, $param)->fetchAll();
		}
		protected static function mn($sql, $param = []) {
			return self::mq($sql, $param)->rowcount();
		}

		protected static function mqReturnId ($q, array $arr = null)
		{
			// 찾아보길
			$query = self::dbCon()->prepare($q);
			$query->execute($arr);
			return self::dbCon()->lastInsertId();
		}
	}