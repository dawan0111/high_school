<?php

	spl_autoload_register(function($classname) {
		require __dir__."/$classname.php";
	});

	/* 페이지 이동 함수 */
	function redirect($url, $msg = null) {
		$msg = gettype($msg) == "array" ? join("\\n", $msg) : $msg;

		echo "<script>
			".($msg ? "alert('$msg')" : "").";
			".($url == "back" ? "history.back(1)" : "location.href='$url'").";
		</script>";

		exit;
	};

	/** 디버깅용 함수 */
	function dd() {
		echo "<pre>";
			var_dump(...func_get_args());
		echo "</pre>";
	}
	
	/* 한국표기를 미국표기로 바꿔줌 */
	function changeDate($date) {
		return mb_substr(preg_replace('/[가-힣]+\s?/', "-", $date), 0, -1);
	}

	/* 미국표기를 한국표기로 바꿔줌 */
	function krDate($date) {
		return date("Y년 m월 d일", strtotime($date));
	}

	/* 배열값 찾기 */
	function array_find($value, $array) {
		return in_array($value, $array) ? array_search($value, $array) : -1;
	}