<?php

	namespace Model;

	use \PDO;

	/**
	 * base
	 */
	class _Base
	{
		private $t = "";

		public function __call($method, $arg)
		{
			return $this->find(...$arg)->{$method}();
		}

		public function __construct()
		{
			$this->db = new PDO("mysql:host=127.0.0.1;dbname=serverside;charset=utf8", "root", "", [
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
			]);
		}

		public function mq($sql, $param = [])
		{
			$sql = str_replace("tablename", $this->t, $sql);

			$q = $this->db->prepare($sql);
			$q->execute($param);

			return $q;
		}

		public function find($where = 1, $param = [], $get = "*")
		{
			return $this->mq("SELECT $get FROM `tablename` WHERE {$where}", $param);
		}

		public function insert($data)
		{
			$sql = "`".implode('` = ?, `', array_keys($data))."` = ?";

			$this->mq("INSERT INTO `tablename` SET {$sql}", array_values($data));
			return $this->db->lastInsertId();
		}

		public function update($data, $idx)
		{
			$sql = "`".implode('` = ?, `', array_keys($data))."` = ?";
			$this->mq("UPDATE `tablename` SET {$sql} WHERE `idx` = {$idx}", array_values($data));
		}

		public function delete($idx)
		{
			$this->mq("DELETE FROM `tablename` WHERE `idx` = ?", [$idx]);
		}

		public function table($table)
		{
			$this->t = $table;
			return $this;
		}
	}