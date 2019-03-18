<?php

	/**
	 * route control
	 */
	class Route
	{
		public function __construct($url)
		{
			$url = explode("/", $url);
			$cont_name = array_shift($url);
			$method = array_shift($url);

			if(
				class_exists($controller = "Controller\\{$cont_name}Controller") &&
				method_exists($inst = new $controller, $method)
			) {
				return call_user_func_array([$inst, $method], $url);
			}
		}
	}