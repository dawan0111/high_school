<?php

	require "lib.php";

	use Model\_Base as DB;
	use Middle\{Vail};

	Route::get("main/index", function() {
		View::open("index");
	});

	Route::disPatch();