<?php

	/**
	 * 	Route
	 */
	class Route
	{
		static $setUp = ["post" => [], "get" => []];

		public static function __callStatic($method, $arg)
		{
			self::$setUp[$method][$arg[0]] = $arg[1];
		}

		public static function disPatch()
		{
			$url = explode("/", $_GET["url"] ?? "main/index");
			$setUp = self::$setUp[strtolower($_SERVER["REQUEST_METHOD"])][$url[0]."/".$url[1]] ?? NULL;

			if($setUp) {
				$r = new ReflectionFunction($setUp);
				$args = array_slice($url, 2);


				if(count($r->getParameters()) == count($args)) {
					$setUp(...$args);
				} else {
					redirect("/", "비정상적인 접근 입니다.");
				};
			} else {
				redirect("/", "비정상적인 접근 입니다.");
			};
		}
	} 