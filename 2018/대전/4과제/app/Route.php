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
				if($request == "get") {
					switch($key) {
						case "member/login":
						case "member/join":
							if(USER)
								redirect("/", "비회원만 접근 가능합니다.");
							break;
						case "member/modify":
							if(!USER || USER["type"] == 3)
								redirect("/", "가맹회원 혹은 일반회원만 접근 가능합니다.");
							break;
						case "order/index":
							if(!USER || USER["type"] != 1)
								redirect("/", "일반회원만 접근 가능합니다.");
							break;
						case "order/list":
							if(!USER || USER["type"] == 2)
								redirect("/", "일반회원과 관리자만 접근 가능합니다.");
							break;
						case "store/index":
							if(!USER || USER["type"] == 1)
								redirect("/", "가맹회원과 관리자만 접근 가능합니다.");
							break;
					};
				};

				$r = new ReflectionFunction($setUp);
				$arg = array_slice($url, 2);

				if(count($r->getParameters()) == count($arg)) {
					$setUp(...$arg);
				};
			};
		}
	}