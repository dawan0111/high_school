<?php

	use Model\_Base as DB;

	/**
	 * View
	 */
	class View
	{
		public static function __callStatic($method, $arg)
		{
			$db = new DB;
			extract($arg[1] ?? []);

			switch($method) {
				case "open":
					require __dir__."/View/include/header.php";
					require __dir__."/View/{$arg[0]}.php";
					require __dir__."/View/include/footer.php";
					break;
				case "admin":
					if(!USER && $arg[0] != "login")
						redirect("/");
					
					require __dir__."/View/admin/include/header.php";
					require __dir__."/View/admin/{$arg[0]}.php";
					require __dir__."/View/admin/include/footer.php";
					break;
				case "popup":
					require __dir__."/View/popup/{$arg[0]}.php";
					break;
			};
		}
	}