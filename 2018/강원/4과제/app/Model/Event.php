<?php

	namespace Model;

	/**
	 * 	Eventg
	 */
	class Event extends DB
	{
		public static function getList($where = 1, $param = [], $get = "*")
		{
			$eventList = self::find("event", $where, $param)->fetchAll();

			foreach ($eventList as $key => &$event) {
				self::getInfo($event);
			};

			return $eventList;
		}

		public static function getInfo(&$event)
		{
			$event["image"] = $event["kind"] == "독거노인돕기" ? "old_man.jpg" : "child.jpg";
			$event["max_people"] = $event["kind"] == "독거노인돕기" ? 10 : 5;
			$event["use_point"] = $event["kind"] == "독거노인돕기" ? 10000: 20000;
		}

		public static function getNow()
		{
			return self::find("event", "end = ?", [true], "MAX(time) + 1 as time")->fetch()["time"] ?? 1;
		}

		public static function getJoin($where = 1, $param = [])
		{
			return self::mq("
				SELECT
					*,
					e.idx as eidx,
					ej.idx as jidx
				FROM `event_join` as ej
				LEFT JOIN `event` as e
				ON e.idx = ej.eventIdx
				WHERE {$where}
				GROUP BY ej.idx
				ORDER BY e.count ASC, e.kind ASC, ej.id ASC, ej.date DESC
			", $param)->fetchAll();
		}

		public static function getSuccessPoint($eidx)
		{
			$event = self::find("event", "idx = ?", [$eidx])->fetch();
			$join_count = self::find("event_join", "eventIdx = ?", [$eidx])->rowCount();

			self::getInfo($event);

			return $join_count * $event["use_point"];
		}

		public static function sortSuccess($numbers, $type = null)
		{
			$result = [];
			$result_max = [];

			foreach ($numbers as $key => &$number) {
				$eidx = $number["eidx"];

				if(!isset($result[$eidx])) {
					$result[$eidx] = [];
					$result_max[$eidx] = [
						"success" => -1,
						"diff" => 999999,
					];
				};

				$lotto_result = getGood($number["number"], $number["ok_number"]);
				$number["success"] = $lotto_result["ok"];
				$number["diff"] = $lotto_result["diff"];

				if($type == null) {
					if($result_max[$eidx]["success"] < count($number["success"])) {
						$result_max[$eidx] = [
							"success" => count($number["success"]),
							"diff" => $number["diff"],
						];

						if($type == null) {
							$result[$eidx] = [$number];
						};
					} else if($result_max[$eidx]["success"] == count($number["success"])) {
						if($result_max[$eidx]["diff"] <= $number["diff"]) {

							if($result_max[$eidx]["diff"] == $number["diff"]) {
								$result[$eidx][] = $number;
							} else {
								$result[$eidx] = [$number];
								$result_max[$eidx]["diff"] = $number["diff"];
							};
						};
					};
				} else {
					$result[$eidx][] = $number;
				};
			};

			return $result;
		}
	}