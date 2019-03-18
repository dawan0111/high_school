<?php

	/**
	 * route
	 */
	class Route
	{
		public $member_access = ["member/logout", "member/mypage", "member/order"];
		public $user_access = ["member/login", "member/join"];

		public function __construct($url)
		{
			$url = explode("/", $url);
			$cont_name = array_shift($url);
			$method = array_shift($url);

			if (
				class_exists($controller = "Controller\\{$cont_name}Controller") &&
				method_exists($inst = new $controller($method), $method)
			) {
				if ($this->accessRight($cont_name."/".$method)) {
					return call_user_func_array([$inst, $method], $url);
				}
			};
		}

		public function accessRight($method)
		{
			$access = isset($_SESSION["login"]) ? $this->user_access : $this->member_access;


			if ( in_array( $method, $access) ) {
				return redirect("/main/index", "접근 불가!");
			} else {
				return true;
			}
		}
	}