<?php

	spl_autoload_register(function($classname) {
		require __dir__."/$classname.php";
	});

	function dd() {
		echo "<pre>";
			var_dump(...func_get_args());
		echo "</pre>";
	}

	function redirect($url, $msg = null) {
		$msg = gettype($msg) == "array" ? join("\\n", $msg) : $msg;

		echo "<script>
			".($msg ? "alert('$msg')" : "").";
			".($url == "back" ? "history.back(1)" : "location.href='$url'").";
		</script>";
		exit;
	}

	function required($matchs, &$msg) {
		foreach($matchs as $match) {
			if(trim($match[0]) == "")
				$msg[] = $match[1]." 필수입력 사항입니다.";
		};
	}

	function getGood(String $num, String $ok_num) {
		$num = explode(",", $num);
		$ok_num = explode(",", $ok_num);

		$success = array_values(array_intersect($num, $ok_num));
		$diff_add = 0;
		$diff_mm = 0;

		foreach ($ok_num as $key => $val) {
			if(!in_array($val, $success)) {
				$diff_add += $num[$key];
				$diff_mm -= $ok_num[$key];
			};
		};

		return [
			"ok" => $success,
			"diff" => abs($diff_add + $diff_mm)
		];
	}