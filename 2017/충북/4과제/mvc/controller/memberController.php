<?php

	namespace Controller;

	use Model\member;
	use \Exception;

	class memberController
	{
		public $errorBox = [];

		public function join()
		{

			$this->emptyChk($_POST['id'], "아이디란이 누락되었습니다.");
			$this->emptyChk($_POST['pw'], "비밀번호란이 누락되었습니다.");
			$this->emptyChk($_POST['name'], "성명/기업명 란이 누락되었습니다.");
			$this->emptyChk($_POST['type'], "회원그룹을 선택하지 않으셨습니다.");

			try {
				if(!count($this->errorBox)) {
					$this->errorBox = [];

					$this->regChk($_POST['id'], '/^(?=.*?[a-zA-Z])[A-Za-z0-9]{1,}$/', "아이디가 형식에 일치하지 않습니다.");
					$this->regChk($_POST['pw'], '/^(?=.*[\@\!\#\$\%\^\&\*\\\\]).{6,}$/', "비밀번호가 형식에 일치하지 않습니다.");
					
					if(!count($this->errorBox)) {
						$id_chk = member::id_load($_POST['id']);

						if($id_chk == null) {
							member::join($_POST);
							return redirect("page/index");
						} else {
							throw new Exception("이미 존재하는 아이디 입니다.");
						}
					} else {
						throw new Exception(join($this->errorBox, "\\r"));
					}
				} else {
					throw new Exception(join($this->errorBox, "\\r"));
				}
			} catch (Exception $e) {
				redirect("page/join", $e->getMessage());
			}
		}

		public function login()
		{
			$login_chk = member::login($_POST['id'], $_POST['pw']);

			if($login_chk != null) {
				$_SESSION['id'] = $login_chk['id'];

				return redirect("page/index");
			} else {
				return redirect("page/login", "존재하지 않는 아이디 이거나 비밀번호를 잘못입력 하셨습니다.");
			}
		}

		public function logout()
		{
			session_destroy();
			return redirect("page/index");
		}

		public function regChk( $value, $reg, $msg )
		{
			if(!preg_match($reg, $value)) {
				dd($value);
				$this->errorBox[] = $msg;
			}
		}

		public function emptyChk( $value, $msg )
		{
			if($value == "") {
				$this->errorBox[] = $msg;
			}
		}
	}