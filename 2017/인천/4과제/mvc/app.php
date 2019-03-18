<?php
	// 페이지 기본 설정
	session_start();
	date_default_timezone_set("Asia/Seoul");

	// error_reporting(0);

	spl_autoload_register(function($classname) {
		require __dir__."/$classname.php";
	});

	// 페이지 보기 $url = 주소, $data = 변수
	function view($url, $data = []) {
		extract($data);
		ob_start();
			require __dir__."/view/$url.php";
		$data = ob_get_clean();
		require __dir__."/view/layout.php";
	}

	// 페이지 이동
	function redirect($url, $msg = null) {
		if(gettype($msg) == "array")
			$msg = join("\\r", $msg);

		echo "<script>
			".($msg ? "alert('$msg')" : "").";
			location.href='$url';
		</script>";
	}

	function dd() {
		echo "<pre>";
			foreach(func_get_args() as $v) {
				var_dump($v);
			};
		echo "</pre>";
	}

	function v(&$ref, $def) {
		return isset($ref) ? $ref : $def;
	}

	function __main() {
		$url = explode("/", v($_GET["url"], "main/index"));
		$controller = "Controller\\".array_shift($url)."Controller";
		$method = array_shift($url);

		$inst = new $controller;

		return call_user_func_array([$inst, $method], $url);
	}
	// 메인 실행
	__main();