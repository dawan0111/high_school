<?php

	namespace Controller;

	use Model\Board as board;
	use Model\Website as website;

	class install 
	{
		public function level($url) {

			if($url != $_SESSION['install']['level']) {
				return redirect("/");
			};
			dd($_SESSION['install']);
			view('install/install'.$url);
		}

		public function process($nowlevel) {
			if(isset($_POST['siteName'])) {

				if($_POST['siteName'] == "") {
					return history("사이트 이름은 필수 입력 사항입니다.");
				};

				$_SESSION['install']['siteName'] = $_POST['siteName'];
				$_SESSION['install']['mysqlPass'] = $_POST['mysqlPass'];
			};

			if(isset($_POST['dbName'])) {
				if($_POST['dbName'] == "" || $_POST['dbpass'] == "" || $_POST['dbpassc'] == "") {
					return history("데이터베이스 계정명 계정 비밀번호 계정 비밀번호 확인 란은 필수 입력사항입니다.");
				}
				if($_POST['dbpass'] != $_POST['dbpassc']) {
					return history("입력하신 계정 비밀번호와 재 입력하신 계정 비밀번호 확인이 일치하지 않습니다.");
				};

				$_SESSION['install']['dbName'] = $_POST['dbName'];
				$_SESSION['install']['dbpass'] = $_POST['dbpass'];
			}

			if(isset($_POST['email'])) {
				$email_reg = "/^[A-Za-z0-9]+@[A-Za-z]+(\.[a-z]+)+$/";

				if($_POST['email'] == "" || $_POST['password'] == "" || $_POST['password_confirmation'] == "") {
					return history("관리자 email 과 비밀번호와 비밀번호 확인란은 필수 입력사항입니다.");
				}

				if(!preg_match($email_reg, $_POST['email'])) {
					return history("관리자 email이 이메일 형식에 올바르지 않습니다.");
				};

				if($_POST['password'] != $_POST['password_confirmation']) {
					return history("비밀번호와 비밀번호확인이 일치하지 않습니다.");
				};

				$_SESSION['install']['email'] = $_POST['email'];
				$_SESSION['install']['admin_pw'] = $_POST['password'];
			}

			$_SESSION['install']['level'] = $nowlevel+1;

			redirect("/install/level/".($nowlevel+1));
		}

		public function fileUpload() {
			$file = $_FILES['photo'];
			$fileCount = count($file['name']);
			$uploadImage = [];

			if($fileCount > 5) {
				return history("슬라이드 이미지는 최대 5장 까지 업로드 가능합니다.");
			};

			foreach($file['name'] as $key => $value) {
				$ext = pathinfo($value)['extension'];

				if(!preg_match("/^(jpg|jpeg|png)$/", $ext)) {
					return history("이미지 확장자는 jpg jpeg png 확장자의 파일만 가능합니다.");
				};
				if($file['size'][$key] > 10485760) {
					return history("이미지 크기는 10MB를 넘어서는 안됩니다.");
				};
			};

			for ($i=0; $i < $fileCount; $i++) { 
				$ext = pathinfo($file['name'][$i])['extension'];
				$filename = md5($file['name'][$i]).".".$ext;
				$upload_dir = $_SERVER['DOCUMENT_ROOT']."/upload/".$filename;

				move_uploaded_file($file['tmp_name'][$i], $upload_dir);

				$uploadImage[] = $filename;

				switch($ext) {
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

				$image = imagecreatetruecolor(700, 350);
				$upload_image = $from($upload_dir);
				$getsize = getimagesize($upload_dir);
				imagecopyresized($image, $upload_image, 0, 0, 0, 0, 700, 350, $getsize[0], $getsize[1]);

				$save($image, $upload_dir);
			};

			$_SESSION['install']['slide_image'] = join($uploadImage, ", ");

			$_SESSION['install']['level'] = 5;

			redirect("/install/level/5");
		}

		public function addBoard() {
			$n_board = [];
			for ($i=0; $i < $_POST['normalBoard']; $i++) { 
				$main = $i == $_POST['mainn'] ? true : false;
				$idx = board::makeBoard($_POST['nboard'][$i], "normal", $main);

				$n_board[] = $idx;
			};

			$p_board = [];
			for ($i=0; $i < $_POST['pictureBoard']; $i++) { 
				$main = $i == $_POST['mainp'] ? true : false;
				$idx = board::makeBoard($_POST['pboard'][$i], "photo", $main);

				$p_board[] = $idx;
			};

			$_SESSION['install']['normalBoard'] = join($n_board, ", ");
			$_SESSION['install']['photoBoard'] = join($p_board, ", ");

			$_SESSION['install']['level'] = 6;
			redirect("/install/level/6");
		}

		public function createSite() {
			if(mb_strlen($_POST['description']) > 300) {
				return history("소개글은 300자 이내로 작성해 주세요.");
			};

			$_SESSION['install']['description'] = $_POST['description'];
			$_SESSION['install']['theme'] = $_POST['themes'];

			website::makeSite();
			
		}
}