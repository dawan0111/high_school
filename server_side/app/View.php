<?php

	/**
	 * View
	 */
	class View
	{
		public static function __callStatic($method, $arg)
		{
			extract($arg[1] ?? []);

			switch($method) {
				case "open":
					require __dir__."/View/include/header.php";
					require __dir__."/View/$arg[0].php";
					require __dir__."/View/include/footer.php";
					break;
			};
		}
	}