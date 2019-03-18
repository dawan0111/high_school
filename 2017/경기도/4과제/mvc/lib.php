<?php

	function __autoload($className) {
		$className = str_replace('\\', '/', $className);

		if(file_exists($f=__dir__."/".$className.".php")) {
			require $f;
		};
	}

	function redirect($url, $msg = false) {
		
		if($msg !== false) {
			echo "<script>alert('".$msg."');</script>";
		}
		echo "<script>location.href='".$url."';</script>";
		exit;
	}

	function history($msg) {
		echo "<script>alert('{$msg}')</script>";
		echo "<script>history.back(1)</script>";
	}

	function view($url, $data = []) {
		extract($data);
		require __dir__."/view/".$url.".php";
	}

	function layoutView($url, $data = []) {

		extract($data);

		ob_start();
		if(file_exists($f=__dir__."/view/".$url.".php")) {
			include $f;
		}
		$data = ob_get_clean();

		require 'view/page/layout.php';
	}

	function dd() {
		echo "<pre>";
		foreach (func_get_args() as $v) {
			var_dump($v);
		};
		echo"</pre>";
	}

	function __main($url) {

		session_start();
		date_default_timezone_set("Asia/Seoul");

		$url = explode("/", $url);
		$controller = array_shift($url) ?: "main";
		$method = array_shift($url) ?: "index";

		try {
			$inst = (new \ReflectionClass("Controller\\".$controller))->newInstance();
			if(method_exists($inst, $method)) {
				return call_user_func_array([$inst, $method], $url);
			};
		} catch (Exception $e) {
			dd($e->getMessage());
		}
	}

	$url = isset($_GET['url']) == false ? "" : $_GET['url'];
	return __main($url);