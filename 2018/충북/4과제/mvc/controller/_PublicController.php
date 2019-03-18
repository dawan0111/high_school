<?php

	namespace Controller;


	use Model\_Base;
	/**
	 * _PublicController
	 */
	class _PublicController
	{
		public $result = [];
		public $msg = [];
		
		public function __construct()
		{
			$this->db = new _Base;

			$this->login = 
			$this->result["login"] = 
				isset($_SESSION["login"]) ? 
				$this->db->table("member")->fetch("id = ?", [$_SESSION["login"]["id"]]) : 
				false;
		}

		public function match($regs)
		{
			foreach ($regs as $key => $reg) {
				if($reg[0]) {
					$this->msg[] = $reg[1];
				}
			};
		}

		public function getNote($where = 1, $param = [], $type = "fetch")
		{
			return $this->db->mq("
				SELECT
					notebook.*,
					member.phone as phone
				FROM `notebook`
				LEFT JOIN `member`
				ON notebook.user_id = member.id
				WHERE {$where}
			", $param)->$type();
		}

		public function getTags(&$notebook)
		{
			$notebook["tag_list"] = array_unique(explode(",", $notebook["tag"]));
		}
	}