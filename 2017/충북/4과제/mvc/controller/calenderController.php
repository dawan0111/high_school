<?php

	namespace Controller;

	use Model\userres;

	class calenderController
	{
		public function get()
		{
			$date = $_POST['date'];
			$startDate = strtotime(str_replace(".", "-", $_POST['startdate']));
			$endDate = strtotime(str_replace(".", "-", $_POST['enddate']));
			$max_people = $_POST['maxPeople'];
 
			list($year, $month) = explode(".", $date);

			$time = strtotime($year."-".$month.'-01');
			list($totalDay, $startWeek) = explode("-", date("t-w", $time));
			$tweek = ceil( ($totalDay + $startWeek) / 7);
			$lastWeek = date('w', strtotime($year."-".$month."-".$totalDay));

			$calender = "";

			for($day = 1, $week = 0; $week<$tweek; $week++) {
				$calender .= "<tr>";
				for($k = 0; $k < 7; $k++) {
					$calender .= "<td>";
						if(!(($week == 0 && $k < $startWeek) || ($week == $tweek-1 && $k > $lastWeek))) {
							$calender .= $day;
							$day++;
							$nowDay = $year."-".$month."-".($day-1);
							if($startDate <= strtotime($nowDay) && strtotime($nowDay) <= $endDate) {
								$calender .= "<div class='max'>1일예약가능인원 : ".userres::getRemnant(userres::getprevRes($_POST['idx'], date("Y-m-d H:i:s", strtotime($nowDay))), $max_people)."명</div>";
								$calender .= "<form action='userres/res/".$_POST['idx']."' method='post'>";
									$calender .= "<input type='hidden' value='".$nowDay."' name='day'>";
									$calender .= "<input type='number' placeholder='예약인원' class='form-control input-sm' name='number'></button>";
									$calender .= "<button type='submit' class='button'>예약하기</button>";
								$calender .= "</form>";
							}

						}
					$calender .= "</td>";
				};
				$calender .= "</tr>";
			};

			echo json_encode(array("calender" => $calender, "year" => $year, "month" => $month));
		}
	}