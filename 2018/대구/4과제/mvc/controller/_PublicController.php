<?php

	namespace Controller;


	use Model\_Base;

	/**
	 * publicController
	 */
	class _PublicController
	{
		public $result = [];
		public $msg = [];

		public function __construct()
		{
			if(isset($_SESSION["login"])) {
				$this->login =
				$this->result["login"] = 
				$_SESSION["login"];
			} else {
				$this->login =
				$this->result["login"] = null;
			};

			$this->db = new _Base;
		}

		public function match($reqs)
		{
			foreach($reqs as $req) {
				if($req[0])
					$this->msg[] = $req[1];
			};
		}
	}