<?php

	namespace Model;

	class Board extends _Base
	{
		public static function makeBoard($name, $type, $main) {
			return self::mqReturnId(
				"INSERT INTO `board` SET `boardname` = ?, `type` = ?, `main` = ?",
				[$name, $type, $main]
			);
		}
		public static function getBoard($idx)
		{
			$boards = [];

			foreach($idx as $key => $value) {
				$board = self::mf("SELECT * FROM `board` WHERE `id` = ?", [$value]);
				$boards[] = $board;
			};

			return $boards;
		}

		public static function getMainBoard($type) {

			$mainBoard = self::mf("SELECT * FROM `board` WHERE `type` = ? && `main` = ?", [$type, true]);
			return $mainBoard;
		}

		public static function allGet() {
			return self::ma("SELECT * FROM `board`");
		}

		public static function typeGet($type)
		{
			return self::ma("SELECT * FROM `board` WHERE `type` = ?", [$type]);
		}

		public static function delete($idx)
		{
			self::mq("DELETE FROM `board` WHERE `id` = ?", [$idx]);
		}
	}