<?php

	namespace Controller;

	/**
	 * 	tourController
	 */
	class tourController extends _PublicController
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function index()
		{
			$category = $_GET["category"] ?? "공원/쉼터";
			$tour_list = $this->Tour->getTour("tour.category = ?", [$category], "fetchAll");

			return view("list", array_merge($this->result, [
				"category" => $category,
				"tour_list" => $tour_list,
			]));
		}

		public function view($idx)
		{
			$tour = $this->Tour->getTour("tour.idx = ?", [$idx], "fetch");

			return view("view", array_merge($this->result, [
				"tour" => $tour,
				"comments" => $this->db->table("comment")->fetchAll("tidx = ? order by date desc", [$idx]),
			]));
		}
	}