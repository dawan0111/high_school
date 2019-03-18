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
						case "product/contract":	
							if(!USER || USER["type"] != "고객사")
								redirect("/", "고객사 회원만 접근 가능합니다.");
							break;
						case "product/delivery":
							if(USER && USER["type"] != "고객사")
								redirect("/", "고객사 회원과 비회원만 접근 가능합니다.");
							break;
						case "product/manager":	
							if(!USER || USER["type"] != "지입차량주")
								redirect("/", "지입차량주 회원만 접근 가능합니다.");
							break;
						case "admin/index":	
							if(!USER || USER["type"] != "관리자")
								redirect("/", "관리자만 접근 가능합니다.");
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