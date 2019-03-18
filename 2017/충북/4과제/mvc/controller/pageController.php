<?php

	namespace Controller;

	use Model\member;
	use Model\booth;
	use Model\fair;
	use Model\userres;

	class pageController
	{
		public $url = "";
		public $result = [];


		public function __construct()
		{
			@$this->result['member'] = member::id_load($_SESSION['id']);
		}

		public function index()
		{
			$this->url = "index";
		}

		public function join()
		{
			if(isset($_SESSION['id'])) {
				return redirect("page/index", "비회원만 접근 가능합니다.");
			}
			$this->url = "join";
		}
		public function login()
		{
			if(isset($_SESSION['id'])) {
				return redirect("page/index", "비회원만 접근 가능합니다.");
			}

			$this->url = "login";
		}
		public function reservation()
		{

			@$id = member::id_load($_SESSION['id']);

			if($id['type'] == "기업회원" || $id == null) {
				return redirect("page/index", "일반회원과 관리자만 접근 가능합니다.");
			};

			$booth = booth::activeBooth();
			$booth = booth::Loadfestival($booth);

			$this->result['booth'] = $booth;

			$this->url = "reservation";
		}
		public function registration()
		{
			$id = member::id_load($_SESSION['id']);

			if($id == null || $id['type'] == '일반회원') {
				return redirect("page/index", "기업회원과 관리자만 접근 가능합니다.");
			}
			
			$this->url = "registration";
		}

		public function management()
		{
			$id = member::id_load($_SESSION['id']);

			if($id == null || $id['type'] == '일반회원') {
				return redirect("page/index", "기업회원과 관리자만 접근 가능합니다.");
			}

			if($_SESSION['id'] != 'admin') {
				$booth = booth::my_booth($id['name']);
			} else {
				$booth = isset($_GET['id']) && $_GET['id'] != 'all' ? booth::my_Booth($_GET['id']) : booth::allBooth();
				$company = member::findCompany();

				$this->result['company'] = $company;
			}

			$booth = booth::Loadfestival($booth);

			$this->result['booth'] = $booth;
			$this->result['selected'] = isset($_GET['id']) ? $_GET['id'] : "";

			$this->url = "management";
		}

		public function management_w($idx)
		{
			$booth = booth::getBooth($idx);

			if(strtotime($booth['enddate']) < strtotime("now")) {
				return redirect("page/management", "Booth등록기간이 지난 목록입니다.");
			};

			$this->result['boothidx'] = $idx;

			$this->url = "management_w";
		}

		public function reservation_w($url)
		{
			$festival = fair::loadFestival($url);
			$booth = booth::getBooth($festival['boothidx']);
			$festival['startdateformat'] = dateFormat($festival['startdate']);
			$festival['enddateformat'] = dateFormat($festival['enddate']);

			$this->result['festival'] = $festival;
			$this->result['booth'] = $booth;

			$this->url = "reservation_w";
		}

		public function information()
		{

			$id = member::id_load($_SESSION['id']);

			if($id['type'] == "기업회원" || $id == null) {
				return redirect("page/index", "일반회원과 관리자만 접근 가능합니다.");
			};

			$res = userres::memberRes($_SESSION['id']);

			foreach($res as $key => &$value) {
				$value['festival'] = $festival = fair::loadFestival($value['fairidx']);
				$value['booth'] = $booth = booth::getBooth($festival['boothidx']);
				$value['day'] = booth::dateFormat($value['day']);
			};

			$this->result['res'] = $res;

			$this->url = "information";
		}

		public function __destruct()
		{
			return move($this->url, $this->result);
		}
	}