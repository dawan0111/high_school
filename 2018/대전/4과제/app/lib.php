<?php

	spl_autoload_register(function($classname) {
		require __dir__."/$classname.php";
	});

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

	function sum($data) {
		return number_format(array_sum(array_column($data, "total_price")));
	}