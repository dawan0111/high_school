<?php

	namespace Controller;

	use Model\member as Mmember;

	class member
	{
		public function register()
		{
			$msg = [];
			$email_reg = "/^[a-zA-Z0-9]+@[a-z]+(\.[a-z]+)$/";
			$pw_reg = "/^(?=.*?[A-Za-z])(?=.*?[0-9])(?=.*?[\#\!\?\@\$\%\^\&\*\-\\\]).{8,}$/";

			if(!preg_match($email_reg, $_POST['email'])) {
				$msg[] = '이메일이 이메일 형식에 올바르지 않습니다.';
			};

			if(!preg_match($pw_reg, $_POST['password'])) {
				$msg[] = '비밀번호는 8자 이상으로 영문자 특수문자 숫자가 모두 한개이상 포함되어 있어야 합니다.';
			};

			if($_POST['password'] != $_POST['password_confirmation']) {
				$msg[] = "입력하신 비밀번호와 재 입력하신 비밀번호가 일치하지 않습니다.";
			};

			if(count($msg)) {
				return history(join($msg, "\\r\\n"));
			} else {
				Mmember::register($_POST['email'], $_POST['name'], $_POST['password']);
			}

			return redirect("/page/main");
		}

		public function login()
		{
			$user = Mmember::login($_POST['email'], $_POST['password']);

			if(isset($user['id'])) {
				$_SESSION['id'] = $user;
				return redirect("/page/main");
			} else {
				return history("존재하지 않는 아이디 이거나 비밀번호를 잘못입력 하셧습니다.");
			};
		}

		public function logout() {
			session_destroy();

			return redirect("/page/main");
		}
	}