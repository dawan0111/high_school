<?php

	/**
	 * route
	 */
	class Route
	{		
		public function __construct($url)
		{
			$url = explode("/", $url);
			$cont_name = array_shift($url);
			$method = array_shift($url);
			
			$controller = "Controller\\{$cont_name}Controller";
			return call_user_func_array([new $controller, $method], $url);
		}
	}