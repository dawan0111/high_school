<?php

	session_start();
	date_default_timezone_set("Asia/Seoul");

	error_reporting(0);

	define('ROOT', $_SERVER['DOCUMENT_ROOT']);

	spl_autoload_register(function($classname) {
		require __dir__."/$classname.php";
	});

	function view($url, $data = []) {
		extract($data);
		ob_start();
			require __dir__."/view/$url.php";
		$data = ob_get_clean();
		require __dir__."/view/layout.php";
	}

	function redirect($url, $msg = null) {
		$msg = gettype($msg) == "array" ? join("\\n", $msg) : $msg;

		echo "<script>
			".($msg ? "alert('$msg')" : "").";
			".($url == "back" ? "history.back(1)" : "location.href='$url'").";
		</script>";

		exit;
	}

	function dd() {
		echo "<pre>";
			var_dump(...func_get_args());
		echo "</pre>";
	}

	function array_ref(&$main, $sub) {
		$main = array_merge($main, $sub);
	}

	function makeStar($star) {
		$fullStar = $star;
		$halfStar = $star != (int)$star && $star - (int)$star >= 0.5;
		$html = "";

		for ($i=1; $i <= 5; $i++) { 
			if($fullStar >= $i) {
				$html .= "<i class='fa fa-star on'></i>";
			} else if($halfStar) {
				$html .= "<i class='fa fa-star half'></i>";
				$halfStar = false;
			} else {
				$html .= "<i class='fa fa-star'></i>";
			};
		};

		return $html;
	}