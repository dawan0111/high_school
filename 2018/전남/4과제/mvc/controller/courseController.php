<?php

	namespace Controller;

	/**
	 * 	courseController
	 */
	class courseController extends _PublicController
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function index()
		{
			$order = $_GET["order"] ?? "";
			$sql_order = "1";

			if($order != "") {
				$sql_order = "1 order by {$order} desc";
			};

			$course_list = $this->db->table("course")->fetchAll($sql_order);

			foreach ($course_list as $key => &$course) {
				$course["tours"] = $this->Tour->getCourseTour("course_tour.course_idx = ?", [$course["idx"]], "fetchAll");
			};


			return view("course_list", array_merge($this->result, [
				"order" => $order,
				"course_list" => $course_list,
			]));
		}

		public function create($idx = null)
		{
			if(!$this->login)
				redirect("/member/login", "회원만 접근 가능합니다.");

			$category = $_GET["category"] ?? "공원/쉼터";

			if($idx) {
				$this->result["course"] = $this->db->table("course")->fetch("idx = ?", [$idx]);
			};

			return view("course_create", array_merge($this->result, [
				"category" => $category,
				"tour_list" => $this->db->table("tour")->fetchAll("category = ?", [$category]),
				"add_course" => $_SESSION["course"] ?? [],
				"idx" => $idx,
			]));
		}

		public function view($idx)
		{
			$course = $this->db->table("course")->fetch("idx = ?", [$idx]);
			$course["tours"] = $this->Tour->getCourseTour("course_tour.course_idx = ?", [$idx], "fetchAll");

			if($this->login) {
				$this->result["like"] = $this->db->table("like")->fetch("course_idx = ? && midx = ?", [$idx, $this->login['idx']]);
			};

			return view("course_view", array_merge($this->result, [
				"course" => $course,
			]));
		}

		public function modify($idx)
		{
			$_SESSION["course"] = $this->Tour->getCourseTour("course_tour.course_idx = ?", [$idx], "fetchAll");

			redirect("/course/create/{$idx}");
		}

		public function add($idx)
		{
			$tour = $this->Tour->fetch("idx = ?", [$idx]);

			$_SESSION["course"] = $_SESSION["course"] ?? [];
			$_SESSION["course"][] = $tour;

			redirect("back", $tour["name"]." 관광지가 추가 완료되었습니다.");
		}

		public function delete($key)
		{
			unset($_SESSION["course"][$key]);
			$_SESSION["course"] = array_values($_SESSION["course"]);

			redirect("back", "삭제가 완료되었습니다.");
		}

		public function clear()
		{
			$_SESSION["course"] = [];
			redirect("back", "초기화가 완료되었습니다.");
		}

		public function courseAdd()
		{
			$dir = ["/", "코스 추가가 완료되었습니다."];

			$this->match([
				[@count($_SESSION["course"]) < 2, "관광지를 두개이상 추가해주세요."],
				[$_POST["title"] == "", "코스 제목을 입력해주세요."],
				[$_POST["content"] == "", "코스 설명을 입력해주세요."],
			]);

			if(!$this->msg) {
				$cidx = $this->db->table("course")->insert([
					"title" => $_POST["title"],
					"info" => $_POST["content"],
					"date" => date("Y-m-d"),
					"writer" => $this->login["name"],
					"midx" => $this->login["idx"]
				]);

				foreach ($_SESSION["course"] as $key => $course) {
					$this->db->table("course_tour")->insert([
						"course_idx" => $cidx,
						"tour_idx" => $course["idx"]
					]);
				};

				$_SESSION["course"] = [];
			} else {
				$dir = ["/course/create", $this->msg];
			};

			redirect(...$dir);
		}

		public function courseModify($idx)
		{
			$dir = ["/", "코스 수정이 완료되었습니다."];

			$this->match([
				[@count($_SESSION["course"]) < 2, "관광지를 두개이상 추가해주세요."],
				[$_POST["title"] == "", "코스 제목을 입력해주세요."],
				[$_POST["content"] == "", "코스 설명을 입력해주세요."],
			]);

			if(!$this->msg) {
				$this->db->table("course")->update([
					"title" => $_POST["title"],
					"info" => $_POST["content"],
				], $idx);

				$this->db->table("course_tour")->delete("course_idx = ?", [$idx]);

				foreach ($_SESSION["course"] as $key => $course) {
					$this->db->table("course_tour")->insert([
						"course_idx" => $idx,
						"tour_idx" => $course["idx"]
					]);
				};

				$_SESSION["course"] = [];
			} else {
				$dir = ["/course/create", $this->msg];
			};

			redirect(...$dir);
		}

		public function courseDelete($idx)
		{
			$this->db->table("course")->delete("idx = ?", [$idx]);
			redirect("/course/index", "삭제가 완료되었습니다.");
		}

		public function like($idx)
		{
			if(!$this->login)
				redirect("/member/login", "로그인 한 회원만 이용 가능합니다.");

			$like = $this->db->table("like")->fetch("midx = ? && course_idx = ?", [$this->login['idx'], $idx]);
			$course = $this->db->table("course")->fetch("idx = ?", [$idx]);

			if($like) {
				$this->db->table("like")->delete("idx = ?", [$like["idx"]]);
				$course["good"]--;
			} else {
				$this->db->table("like")->insert([
					"course_idx" => $idx,
					"midx" => $this->login["idx"],
				]);

				$course["good"]++;
			};

			$this->db->table("course")->update([
				"good" => $course["good"],
			], $idx);

			redirect("/course/view/{$idx}?order={$_GET['order']}", "처리 되었습니다.");
		}
	}