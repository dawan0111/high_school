<?php

	namespace Controller;

	use Model\booth;

	class boothController
	{
		public function insert()
		{

			if($_POST['booth'] == "") {
				return redirect("page/registration", "부스를 선택해 주세요.");
			};

			$nowStartTime = strtotime($_POST['startdate']);
			$nowEndTime = strtotime($_POST['enddate']);
			$prev_res = booth::prevRes($_POST['booth']);

			foreach($prev_res as $key => $value) {
				$prevStratTime = strtotime($value['startdate']);
				$prevEndTime = strtotime($value['enddate']);

				if(!($nowStartTime > $prevEndTime || $nowEndTime < $prevStratTime)) {
					return redirect("page/registration", "다른등록 기록과 중복되었습니다.");
					break;
				}
			}

			booth::addBooth($_POST);
			return redirect('page/index');
		}
	}