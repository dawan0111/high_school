<?php

	namespace Model;

	class member extends _Base
	{
		public function register($id, $name, $password)
		{
			self::mq("INSERT INTO `member` SET `id` = ?, `name` = ?, `password` = ?", [
				$id, $name, $password
			]);
		}
		public function login($id, $password)
		{
			$login_user = self::mf("SELECT * FROM `member` WHERE `id` = ? && `password` = ?", [
				$id, $password
			]);

			return $login_user;
		}
	}