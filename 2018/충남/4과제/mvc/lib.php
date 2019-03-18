<?php

	session_start();
	date_default_timezone_set("Asia/Seoul");

	define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

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

	function small($category) {
		return in_array($category, ["전기자전거", "미니전기자동차", "전기스쿠터"]);
	}

	function don($val)
	{
		return number_format($val);
	}

	function stt($time)
	{
		return strtotime($time);
	}

	function daySale($product, $s_time = null, $e_time = null)
	{
		$s_time = $s_time ?? $product["s_time"];
		$e_time = $e_time ?? $product["e_time"];

		$list = [20, 0, -30, -30, -30, 0, 20];

		if(small($product["category"])) {
			$week = date("w", stt($s_time));
			$sale = $list[$week];

			return $product["price"] / 100 * $sale;
		} else {
			$totalSale = 0;
			for ($i=stt($product["s_time"]); $i <= stt($e_time);) { 
				$w = date("w", $i);
				$totalSale += $product["price"] / 100 * $list[$w];
				
				$i += 86400;
			};

			return $totalSale;
		};
	}

	function mSale($price, $level) {
		$sale = [
			"일반회원" => 5,
			"멤버십회원" => 10,
			"VIP회원" => 15,
			"관리" => 0,
		];

		return $price / 100 * $sale[$level];
	}