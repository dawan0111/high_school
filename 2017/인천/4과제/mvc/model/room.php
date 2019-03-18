<?php

	namespace Model;

	class room extends _Base {
		protected static $table = "room";
		/* 처음 room 셋팅 */
		public static function defaultSet() {
			self::delete();

			for ($floor=1; $floor <= 5; $floor++) { 
				for ($i=1; $i <= 20; $i++) {
					$number = $floor.sprintf("%02d", $i);
					$type = $i % 2 == 0 ? 1 : 0;

					self::insert([
						"floor" => $floor,
						"number" => $number,
						"price" => $floor * 10000 + 5000 * $type
					]);
				};
			};
		}
		/* 방 가격 변경 $sql = query문 $price = 변경할 가격 */
		public static function priceChange($sql, $price) {
			self::mq("UPDATE `room` SET `price` = ? WHERE {$sql}", [$price]);
		}
	}