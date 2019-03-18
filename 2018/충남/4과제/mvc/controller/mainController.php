<?php

	namespace Controller;

	/**
	 * 	mainController
	 */
	class MainController extends _PublicController
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function index()
		{
			return view("index", $this->result);
		}
	}