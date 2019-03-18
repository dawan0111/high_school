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
			$add_tour = $this->db->table("course")->fetchAll("1 order by c_date desc limit 0, 4");
			$nice_tour = $this->db->table("course")->fetchAll("1 order by good desc limit 0, 4");

			foreach ($add_tour as $key => &$tour) {
				$tour["tours"] = $this->Tour->getCourseTour("course_tour.course_idx = ?", [$tour['idx']], "fetchAll");
			};
			foreach ($nice_tour as $key => &$tour) {
				$tour["tours"] = $this->Tour->getCourseTour("course_tour.course_idx = ?", [$tour['idx']], "fetchAll");
			};


			return view("index", array_merge($this->result, [
				"add_tour" => $add_tour,
				"nice_tour" => $nice_tour
			]));
		}

		public function parsing()
		{
			$tours = json_decode(file_get_contents(ROOT."/data/data.json"), true);

			foreach ($tours["data"] as $key => $tour) {
				$this->db->table("tour")->insert($tour);
			};

			$courses = json_decode(file_get_contents(ROOT."/data/course.json"), true);

			foreach ($courses["data"] as $key => $course) {
				$cidx = $this->db->table("course")->insert([
					"title" => $course["title"],
					"info" => $course["info"],
					"date" => $course["date"],
					"writer" => $course["writer"],
					"good" => $course["good"]
				]);

				foreach ($course["course"] as $key => $value) {
					$this->db->table("course_tour")->insert([
						"course_idx" => $cidx,
						"tour_idx" => $value['idx'],
					]);
				};
			};
		}
	}