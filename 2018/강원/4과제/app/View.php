<?php

	/**
	 * 	View
	 */
	
	use Model\DB;

	class View
	{
		public static function viewSet(&$data)
		{
			if(isset($_SESSION["login"])) {
				$login = $_SESSION["login"];
				$data['login'] = $login;
				$data["login"]["msg"] = DB::fetchAll("SELECT * FROM `message` WHERE `target` = ? && `view` = ?", [$login["idx"], false]);
			};
		}

		public static function open($url, $data = [])
		{
			self::viewSet($data);
			extract($data);

			require __dir__."/View/include/header.php";
			require __dir__."/View/{$url}.php";
		}

		public static function popup($url, $data = [])
		{
			self::viewSet($data);
			extract($data);

			require __dir__."/View/{$url}.php";
		}
	}