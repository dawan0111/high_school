<?php

	namespace Model;

	class reserve extends _Base {
		protected static $table = "reserve";
		/* 그 날에 예약된 방 찾기 $indate = 시작일, $outdate = 종요일 */
		public static function getReserve($indate, $outdate) {
			$result = [];
			$reserveRoom = self::find("!(outdate < ? || indate > ?)", [$indate, $outdate])->fetchAll();

			foreach($reserveRoom as $key => $reserve) {
				$result = array_merge($result, explode(",", $reserve["room"]));
			};
			
			return $result;
		}
	}