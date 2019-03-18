<?php

	namespace Controller;

	/**
	 * mainController
	 */
	class mainController extends _PublicController
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function index()
		{
			if ($this->login) {
				redirect("/mail/mail1");
			}
			
			return view("index", $this->result);
		}
	}