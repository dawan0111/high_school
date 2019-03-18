<?php

	require "mvc/lib.php";
	new Route($_GET["url"] ?? "main/index");