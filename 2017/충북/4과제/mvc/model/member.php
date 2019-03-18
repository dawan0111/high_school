<?php

	namespace Model;

	class member extends _Base
	{
		public static function join($data)
		{
			self::insert("member", $data);
		}
		public static function id_load($id)
		{
			return self::mf("SELECT * FROM `member` WHERE `id` = ?", [$id]);
		}
		public static function login($id, $pw)
		{
			return self::mf("SELECT * FROM `member` WHERE `id` = ? && `pw` = ? ", [$id, $pw]);
		}
		public static function findCompany()
		{
			return self::ma("SELECT * FROM `member` WHERE `type` = ?", ["기업회원"]);
		}
	}