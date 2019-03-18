<?php

	namespace Model;

	class post extends _Base
	{
		public static function getPost($idx)
		{
			$post = self::ma("SELECT * FROM `post` WHERE `boardidx` = ? order by `idx` desc", [$idx]);

			return $post;
		}

		public static function writePost($value, $idx, $image = "") {
			$imageName = $image;

			self::mq("INSERT INTO `post` SET `id` = ?, `writer` = ?, `title` = ?, `content` = ?, `boardidx` = ?, `image` = ?", [
				$value['email'],
				$value['writer'],
				$value['title'],
				$value['content'],
				$idx,
				$imageName
			]);;
		}

		public static function loadPost($idx)
		{
			return self::mf("SELECT * FROM `post` WHERE `idx` = ?", [$idx]);
		}

		public static function delete($idx)
		{
			return self::mq("DELETE FROM `post` WHERE `idx` = ?", [$idx]);
		}
		public static function update($value, $idx)
		{
			self::mq("UPDATE `post` SET `title` = ?, `content` = ? WHERE `idx` = ?", [
				$value['title'],
				$value['content'],
				$idx,
			]);
		}

		public static function timePostGet($starttime, $endtime, $id)
		{
			return self::ma("SELECT * FROM `post` WHERE `date` BETWEEN ? and ? && `id` = ?", [$starttime, $endtime, $id]);

		}
	}