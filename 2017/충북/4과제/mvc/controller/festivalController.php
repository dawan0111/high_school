<?php

	namespace Controller;

	use Model\fair;
	use Model\booth;

	class festivalController
	{
		public function add($url)
		{
			$prevRes = fair::prevres($url);
			$booth = booth::getBooth($url);
			$boothStart = strtotime($booth['startdate']);
			$boothEnd = strtotime($booth['enddate']);
			$festivalStart = strtotime($_POST['startdate']);
			$festivalEnd = strtotime($_POST['enddate']);

			if(count($prevRes)) {
				foreach($prevRes as $key => $prev) {
					$prevStartTime = strtotime($prev['startdate']);
					$prevEndTime = strtotime($prev['enddate']);

					if(!($festivalStart > $prevEndTime || $festivalEnd < $prevStartTime)) {
						return redirect("page/management_w/".$url, "다른박람회 개최기간과 중복되었습니다.");
					}
				};
			}

			if(!(($boothStart <= $festivalStart && $festivalStart <= $boothEnd) && ($boothStart <= $festivalEnd && $festivalEnd <= $boothEnd) )) {
				return redirect("page/management_w/".$url, "박람회 개최기간이 Booth등록기간이 아닙니다.");
			};

			$filename = "";

			if(!$_FILES['image']['name'] == "") {
				$file = $_FILES['image'];
				$ext  = pathinfo($file['name'])['extension'];

				$filename = date("YmdHis").rand().".".$ext;

				move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/upload/".$filename);
			} else {
				return redirect("page/management_w/".$url, "박람회 이미지를 선택해 주세요.");
			};

			fair::add($_POST, $filename, $url);

			return redirect("page/management", "박람회 등록이 완료되었습니다.");
		}
	}