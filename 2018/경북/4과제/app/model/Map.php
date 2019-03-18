<?php

	namespace Model;

	/**
	 * Map
	 */
	class Map extends _Base
	{
		public static function getAll()
		{
			$result = [];
			$start = array_column(self::fetchAll("map", 1, [], "DISTINCT start as start"), "start");

			foreach ($start as $key => $value) {
				$result[$value] = [];
				$ways = self::fetchAll("map", "start = ?", [$value]);

				foreach ($ways as $key => $way) {
					$result[$value][$way["end"]] = $way["spend"];
				};
			};

			return $result;
		}
	}