<?php

	session_start();
	date_default_timezone_set("Asia/Seoul");

	define("ROOT", $_SERVER["DOCUMENT_ROOT"]);
	define("USER", $_SESSION["login"] ?? false);

	require "app/web.php";