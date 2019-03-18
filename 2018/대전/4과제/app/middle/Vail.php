<?php

	namespace Middle;

	/**
	 * Vail
	 */
	class Vail
	{
		public static $message = [];

		public static function required($data)
		{
			foreach ($data as $key => $value) {
				if($_POST[$key] == "")
					self::$message[$key."|required"] = $value." 필수사항 입니다.";
			};
		}

		public static function regex($data)
		{
			foreach ($data as $key => $value) {
				if(!isset(self::$message[$key."|required"]) && !preg_match($value[0], $_POST[$key])) {
					self::$message[] = $value[1];
				};
			};
		}
	}