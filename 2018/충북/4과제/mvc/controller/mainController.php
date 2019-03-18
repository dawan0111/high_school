<?php

	namespace Controller;

	/**
	 * 	mainController
	 */
	class mainController extends _PublicController
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function index()
		{
			/*$members =  array_map(function($arr) {
				return explode("\t", $arr);
			}, explode(
				"\r\n",
				iconv("EUC-KR", "UTF-8", file_get_contents(ROOT."/member.txt"))
			));

			foreach ($members as $key => $member) {
				if($key == 0)
					continue;

				$this->db->table("member")->insert(
					array_combine(["id", "pw", "name", "phone", "type"], $member)
				);
			};*/


			return view('index', $this->result);
		}
	}