<?php

	/**
	 * Route
	 */
	class Route
	{
		public static $setUp = ["get" => [], "post" => []];

		public static function __callStatic($method, $arg)
		{
			self::$setUp[$method][$arg[0]] = $arg[1];
		}

		public static function disPatch()
		{
			$url = explode("/", $_GET["url"] ?? "main/index");
			$key = $url[0]."/".$url[1];
			$request = strtolower($_SERVER["REQUEST_METHOD"]);
			$setUp = self::$setUp[$request][$key];

			if($setUp) {
				$r = new ReflectionFunction($setUp);
				$arg = array_slice($url, 2);

				if(count($r->getParameters()) == count($arg)) {
					$setUp(...$arg);
				};
			};
		}
	}