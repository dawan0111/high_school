<?php
	function __autoload( $class )
	{
		$class = str_replace("\\", "/", $class);

		if( file_exists($f=__dir__."/".$class.".php") ) {
			include $f;
		}
	}

	function redirect( $url, $msg = null )
	{
		echo $msg != null ? "<script>alert('".$msg."')</script>" : "";
		echo "<script>location.href='/".$url."'</script>";
	}

	function move( $url, $data )
	{
		extract($data);
		ob_start();
		include __dir__."/view/".$url.".php";
		$data = ob_get_clean();

		include __dir__."/view/layout.php";
	}

	function dd()
	{
		echo "<pre>";
		foreach(func_get_args() as $v) {
			var_dump($v);
		};
		echo "</pre>";
	}

	function dateFormat($date)
	{
		return date("Y년 n월d일", strtotime($date));
	}

	function stringCut($string)
	{
		$string = trim($string);
		$endCut = 40;
		$Cutstring = mb_substr($string, 0, $endCut);

		$emptyChk = substr_count($Cutstring, " ");

		while($emptyChk) {
			$Cutstring = mb_substr($string, $endCut, $emptyChk);
			$endCut += $emptyChk; 
			$emptyChk = substr_count($Cutstring, " ");
		};
		return mb_substr($string, 0, $endCut);
	}

	function __main( $url )
	{

		session_start();
		date_default_timezone_get("Aisa/Seoul");

		$url = explode("/", $url);
		$controller = array_shift($url) ?: "page";
		$action = array_shift($url) ?: "index";

		try {
			$inst = (new \ReflectionClass("controller\\".$controller."controller"))->newInstance();

			if(method_exists($inst, $action)) {
				return call_user_func_array([$inst, $action], $url);
			}
		} catch (Exception $e) {
			dd($e->getMessage());
		}
	}

	$url = isset($_GET['url']) ? $_GET['url'] : "";
	__main($url);