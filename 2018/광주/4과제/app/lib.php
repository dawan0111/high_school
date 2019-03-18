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

	function fm($filename, $t = true) {
		if($filename == "" && $t)
			return '선택파일없음';

		$file_cut = explode("_", $filename);
		return join("_", array_slice($file_cut, count($file_cut) == 1 ? 0 : 1));
	}

	function fu($file) {
		$filename = date("YmdHis").rand(1, 999)."_".$file["name"];
		move_uploaded_file($file["tmp_name"], ROOT."/upload/".$filename);
		return $filename;
	}

	function popupClose() {
		echo "<script>
			alert('처리되었습니다.');
			window.opener.location.reload();
			window.close();
		</script>";
	}

	function color($color) {
		return $color == "" ? "미설정" : "<span style='background:".$color."' class='prv_color'></span>";
	};

	function gi($post) {
		$files = explode(">", $post["file"]);
		$result = [];

		foreach ($files as $key => $file) {
			$ext = @pathinfo($file)["extension"];
			if(in_array($ext, ["jpg", "jpeg", "png", "gif"]) && file_exists(ROOT."/upload/".$file)) {
				$result[] = $file;
			};
		};

		return $result ? $result : false;
	}