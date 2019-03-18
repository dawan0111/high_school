<?php

	/* session 시작 및 datetime 설정 */
	session_start();
	date_default_timezone_set("Asia/Seoul");

	error_reporting(0);

	/* 상수 설정 */
	define("ROOT", $_SERVER["DOCUMENT_ROOT"]);
	define("USER", $_SESSION["login"] ?? false);

	require "app/web.php";