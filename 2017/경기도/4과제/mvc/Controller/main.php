<?php

	namespace Controller;

	use Model\Website as website;

	class main
	{
		public function index()
		{
			$website = website::findwebSite();
			if(!$website) {
				$_SESSION['install'] = [
					'level' => 1,
				];
				return redirect("/install/level/1");
			} else {
				return redirect("/page/main");
			}
		}
	}