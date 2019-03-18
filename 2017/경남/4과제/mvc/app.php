<?php

	session_start();
	date_default_timezone_set("Asia/Seoul");

	error_reporting(0);

	define("ROOT", $_SERVER["DOCUMENT_ROOT"]);
	// class 자동 로드
	spl_autoload_register(function($classname) {
		require __dir__."/$classname.php";
	});
	// 페이지 보여주기
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
			location.href = '$url';
		</script>";
	}

	function dd() {
		
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

	__main();