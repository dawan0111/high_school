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
				if(isset($_POST[$key]) && $_POST[$key] == "")
					self::$message[] = $value." 필수사항 입니다.";
			};
		}
	}