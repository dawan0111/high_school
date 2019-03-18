<?php

	namespace Model;

	use Model\Board;

	class Website extends _Base
	{
		public static function findwebSite()
		{
			$website = self::mn("SELECT * FROM `page`");

			return $website;
		}
		public static function makeSite()
		{

			self::mq("INSERT INTO `page` SET 
				`siteName` = ?,
				`mysqlPass` = ?,
				`dbName` = ?,
				`dbPass` = ?,
				`admin_email` = ?,
				`adminPass` = ?,
				`slideImage` = ?,
				`normal_board` = ?,
				`photo_board` = ?,
				`description` = ?,
				`theme` = ?
				", [
					$_SESSION['install']['siteName'],
					$_SESSION['install']['mysqlPass'],
					$_SESSION['install']['dbName'],
					$_SESSION['install']['dbpass'],
					$_SESSION['install']['email'],
					$_SESSION['install']['admin_pw'],
					$_SESSION['install']['slide_image'],
					$_SESSION['install']['normalBoard'],
					$_SESSION['install']['photoBoard'],
					$_SESSION['install']['description'],
					$_SESSION['install']['theme']
				]
			);

			self::mq("INSERT INTO `member` SET `id` = ?, `password` = ?, `name` = ?", [
				$_SESSION['install']['email'],
				$_SESSION['install']['admin_pw'],
				"관리자"
			]);


			return redirect("/page/main");
		}

		public static function getWebSite()
		{
			$webSite = self::mf("SELECT * FROM `page`");
			$theme = ["/css/theme1.min.css", "/css/theme2.min.css", "/css/theme3.min.css"];

			$nboard = Board::getBoard(explode(", ", $webSite['normal_board']));
			$pboard = Board::getBoard(explode(", ", $webSite['photo_board']));
			$slideImage = explode(", ", $webSite['slideImage']);

			$webSite['normal_board'] = $nboard;
			$webSite['photo_board'] = $pboard;
			$webSite['slideImage'] = $slideImage;
			$webSite['theme'] = $theme[$webSite['theme']-1];

			return $webSite;
		}

		public static function findSite()
		{
			return self::mf("SELECT * FROM `page`");
		}

		public static function boardUpdate($board, $type)
		{
			self::mq("UPDATE `page` SET `{$type}` = ?", [$board]);
		}
		public static function tagUpdate($tag)
		{
			self::mq("UPDATE `page` SET `tag` = ?", [$tag]);
		}
	}