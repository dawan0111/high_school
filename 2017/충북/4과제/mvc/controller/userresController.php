<?php

	namespace controller;

	use Model\userres;
	use Model\booth;
	use Model\fair;

	class userresController
	{
		public function res($url)
		{
			$fairidx = $url;
			$fair = fair::loadFestival($fairidx);
			$booth = booth::getBooth($fair['boothidx']);

			$prevRes = userres::getprevRes($fairidx, $_POST['day']);
			$remnant = userres::getRemnant($prevRes, $fair['max_people']);

			if($remnant - $_POST['number'] < 0) {
				return redirect("page/reservation_w/".$fairidx, "1일 예약가능인원을 초과하였습니다.");
			} else {
				userres::res($_POST, $fairidx);
				return redirect("page/reservation_w/".$fairidx, "예약이 완료되었습니다.");
			};
		}

		public function cancle($url)
		{
			userres::cancle($url);
			return redirect("page/information", "취소가 완료되었습니다.");
		}
	}