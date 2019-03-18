<?php

	namespace Model;

	/**
	 * 	tour
	 */
	class tour extends _Base
	{
		public $t = "tour";

		public function __construct()
		{
			parent::__construct();
		}

		public function getTour($where = 1, $param = [], $mode = "fetch")
		{
			$this->t = "tour";
			
			return $this->mq("
				SELECT 
					tour.*,
					COUNT(comment.tidx) as count,
					ROUND(AVG(comment.star), 1) as star
				FROM `tour`
				LEFT JOIN `comment`
				ON tour.idx = comment.tidx
				WHERE {$where}
				GROUP BY tour.idx
			", $param)->$mode();
		}

		public function getCourseTour($where = 1, $param = [], $mode = "fetch")
		{
			$this->t = "tour";

			return $this->mq("
				SELECT
					tour.*,
					course_tour.course_idx as cidx
				FROM `course_tour`
				LEFT JOIN `tour`
				ON course_tour.tour_idx = tour.idx
				WHERE {$where}
				ORDER BY course_tour.idx asc
			", $param)->$mode();
		}
	}
