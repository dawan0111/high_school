<?php

	namespace Controller;

	use Model\{_Base, Tour};

	/**
	 * 	_PublicController
	 */
	class _PublicController
	{
		public $result = [];
		public $msg = [];

		public $list = ["공원/쉼터", "문화재", "산/등산로", "섬", "전시/공연장", "종교시설", "해수욕장/해변", "경관", "교통", "쇼핑", "체험/체육시설", "레저"];

		public function __construct()
		{
			$this->login =
			$this->result["login"] = $_SESSION['login'] ?? false;

			$this->db = new _Base();
			$this->Tour = new Tour();

			$this->result["lists"] = $this->list;
		}

		public function match($matchs)
		{
			foreach ($matchs as $key => $match) {
				if($match[0])
					$this->msg[] = $match[1];
			};
		}
	}