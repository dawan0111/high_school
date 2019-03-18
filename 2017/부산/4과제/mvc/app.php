<?php
	
	date_default_timezone_set("Asia/Seoul");
	session_start();

	spl_autoload_register(function($class) {
		$className = str_replace("\\", "/", $class);

		require_once __dir__."/{$className}.php";
	});

	function view($url, $data = []) {
		extract($data);

		ob_start();
			require_once __dir__."/view/{$url}.php";
		$data = ob_get_clean();

		require_once __dir__."/view/layout.php";
	};

	function redirect($url, $msg = null) {
		echo "<script>
			".($msg ? "alert('{$msg}')" : "").";
			location.href='".$url."';
		</script>";

		exit;
	};

	function dd() {
		if(__DEBUG__) {
			echo "<pre>";
				foreach(func_get_args() as $v) {
					var_dump($v);
				};
			echo "</pre>";
		};
	};

	function v(&$ref, $def) {
		return isset($ref) ? $ref : $def;
	};

	function __main() {
		$url = explode("/", v($_GET['url'], "main/index"));
		$controller = "Controller\\".array_shift($url)."Controller";
		$method = array_shift($url);

		$inst = new $controller;

		if(method_exists($inst, $method)) {
			return call_user_func_array([$inst, $method], $url);
		};
	};

	__main();