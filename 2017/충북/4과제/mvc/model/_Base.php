<?php

namespace Model;


use \PDO;

abstract class _Base 
{
	protected static function mq( $sql, $param = [] )
	{
		$db = new PDO("mysql:host=127.0.0.1;dbname=webd13;charset=utf8","root","", [
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		]);

		$q = $db->prepare($sql);
		$q->execute($param);

		return $q;
	} 
	protected static function mf( $sql, $param = [] )
	{
		return self::mq($sql, $param)->fetch();
	}
	protected static function ma( $sql, $param = [] )
	{
		return self::mq($sql, $param)->fetchAll();
	}
	protected static function mr( $sql, $param = [] )
	{
		return self::mq($sql, $param)->rowCount();
	}
	protected static function getClassName()
	{
		return strtolower(array_pop(explode("\\", get_called_class())));
	}
	protected static function insert( $tableName, $data )
	{
		$key = array_keys($data);
		$value = array_values($data);
		$sql = "`".implode("` = ?, `", $key)."` = ?";

		self::mq("INSERT INTO `{$tableName}` SET ".$sql, $value);
	}
	protected static function get( $tableName, $sql ) {
		return self::ma("SELECT * FROM `{$tableName}` WHERE ".$sql);
	}
}