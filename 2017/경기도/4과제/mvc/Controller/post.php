<?php

	namespace controller;

	use Model\post as Mpost;
	use Model\webSite;

	class post
	{
		public function normalwrite($url)
		{	

			if($_POST['title'] == "" || $_POST['content'] == "") {
				return history("제목과 글본문은 필수 입력 사항입니다.");
			}

			$title = $_POST['title'];
			$content = $_POST['content'];
			$usetag = webSite::findSite();
			$tag = explode(", ", $usetag['tag']);
			$stringtag = "";

			foreach($tag as $key => $value) {
				$stringtag .= "<".$value.">";
			};
			$src_reg = "/^http(s?):\/\/[\W\D\.\/]+$/";

			$content = strip_tags($content, $stringtag);
			$title = strip_tags($title, $stringtag);

			$_POST['title'] = $title;
			$_POST['content'] = $content;

			Mpost::writePost($_POST, $url);

			return redirect("/page/normalboard/".$url);
		}

		public function pciturewrite($url)
		{
			if($_POST['title'] == "" || $_POST['content'] == "") {
				return history("제목과 글본문은 필수 입력 사항입니다.");
			}

			$file = $_FILES['upimg'];
			$filename = "";


			if(isset($file['name'])) {
				$filename = $this->imageCheck($file);
			};

			Mpost::writePost($_POST, $url, $filename);

			return redirect("/page/pictureboard/".$url);
		}

		public function delete($idx) {
			Mpost::delete($idx);

			echo "<script> window.history.go(-2) </script>";
		}

		public function boardModify($idx) {
			Mpost::update($_POST, $idx);

			echo "<script> window.history.go(-2) </script>";
		}

		public function imageCheck($file)
		{
			$imageSize = getimagesize($file['tmp_name']);
			$imageExt = pathinfo($file['name'])['extension'];

			if(!$imageSize) {
				history("진짜 이미지만 업로드 가능합니다.");
				exit;
			};
			if(!preg_match("/^(png|jpeg|jpg)$/", $imageExt)) {
				history("jpg, jpeg, png 파일만 업로드가 가능합니다.");
				exit;
			};
			if($file['size'] >= 10485760) {
				history("이미지는 10MB 용량으로 제한되어있습니다.");
				exit;
			};

			$link = $_SERVER['DOCUMENT_ROOT']."/upload/";
			$filename = date("YmdHis").rand().".".$imageExt;

			move_uploaded_file($file['tmp_name'], $link.$filename);

			switch($imageExt) {
				case 'jpg':
				case 'jpeg':
					$from = "imagecreatefromjpeg";
					$save = "imagejpeg";
					break;
				case 'png':
					$from = "imagecreatefrompng";
					$save = "imagepng";
					break;
			};

			$image = imagecreatetruecolor(64, 64);
			$upload_image = $from($link.$filename);
			$getsize = getimagesize($link.$filename);
			imagecopyresized($image, $upload_image, 0, 0, 0, 0, 64, 64, $getsize[0], $getsize[1]);

			$save($image, $link."somenail_".$filename);

			return $filename;
		}


	}