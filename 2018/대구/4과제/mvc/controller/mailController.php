<?php

	namespace Controller;

	/**
	 * mailControl
	 */
	class mailController extends _PublicController
	{
		public $menus = [
			"mail1" => ["받은 메일함", 0],
			"mail2" => ["스팸 메일함", 0],
			"mail3" => ["보낸 메일함", 0],
			"mail4" => ["임시 메일함", 0],
			"mail5" => ["내게쓴메일함", 0],
			"mail6" => ["휴지통", 0],
		];

		public function __construct($method)
		{
			parent::__construct();
			$page_title = "";

			switch($method) {
				case "write":
					$page_title = "메일 쓰기";
					break;
				default:
					$page_title = "메일함";
					break;
			};

			$this->countRefresh();

			$this->search = $_GET["search"] ?? "";
			$this->s_date = $_GET["s_date"] ?? "";
			$this->e_date = $_GET["e_date"] ?? "";

			$this->result["search"] = $this->search;
			$this->result["s_date"] = $this->s_date;
			$this->result["e_date"] = $this->e_date;

			$this->result["menus"] = $this->menus;
			$this->result["method"] = $method;
			$this->result["page_title"] = $page_title;
		}

		public function countRefresh()
		{
			$this->menus["mail1"][1] = $this->db->table("mail")->rowCount(
				"target = ? && t_read = ? && t_del = ? && t_spam = ? && type = ?",
				[$this->login["email"], false, 0, 0, "send"]
			);
			$this->menus["mail2"][1] = $this->db->table("mail")->rowCount(
				"target = ? && t_read = ? && t_del = ? && t_spam = ? && type = ?",
				[$this->login["email"], false, 0, 1, "send"]
			);
			$this->menus["mail6"][1] = $this->db->table("mail")->rowCount(
				"(target = ? && t_read = ? && t_del = ?) || (send_id = ? && s_read = ? && s_del = ?)",
				[$this->login["email"], 0, 1, $this->login["email"], 0, 1]
			);
		}

		public function mail1()
		{
			$query = ["target = ?", "t_spam = ?", "type = ?", "t_del = ?"];
			$param = [$this->login["email"], 0, "send", 0];

			$giveMail = $this->makeSearchSql($query, $param);

			$this->result["giveMail"] = $giveMail;
			$this->result["fullCount"] = $this->db->table("mail")->rowCount(join(" && ", $query), $param);

			return view("mailbox1", $this->result, "m_layout");
		}

		public function mail2()
		{
			$query = ["t_spam = ?", "target = ?", "t_del = ?"];
			$param = [1, $this->login["email"], 0];

			$this->result["mailList"] = $this->makeSearchSql($query, $param);
			$this->result["fullCount"] = $this->db->table("mail")->rowCount(join(" && ", $query), $param);

			return view("mailbox2", $this->result, "m_layout");
		}

		public function mail3()
		{
			$query = ["send_id = ?", "s_del = ?", "type = ?"];
			$param = [$this->login["email"], 0, "send"];

			$this->result["mailList"] = $this->makeSearchSql($query, $param);
			$this->result["fullCount"] = $this->db->table("mail")->rowCount(join(" && ", $query), $param);

			return view("mailbox3", $this->result, "m_layout");
		}

		public function mail4()
		{
			$query = ["type = ?", "send_id = ?", "s_del = ?"];
			$param = ["tmp", $this->login["email"], 0];

			$this->result["mailList"] = $this->makeSearchSql($query, $param);
			$this->result["fullCount"] = $this->db->table("mail")->rowCount(join(" && ", $query), $param);

			return view("mailbox4", $this->result, "m_layout");
		}

		public function mail5()
		{
			$query = ["type = ?", "send_id = ?", "s_del = ?"];
			$param = ["my", $this->login["email"], 0];

			$mailList = $this->makeSearchSql($query, $param);
			$this->result["fullCount"] = $this->db->table("mail")->rowCount(join(" && ", $query), $param);

			$this->result["mailList"] = $mailList;
			return view("mailbox5", $this->result, "m_layout");
		}

		public function mail6()
		{
			$query = ["(target = ? && t_del = ?) || (send_id = ? && s_del = ?)"];
			$param = [$this->login["email"], 1, $this->login["email"], 1];

			$mailList = $this->makeSearchSql($query, $param);
			$this->result["fullCount"] = $this->db->table("mail")->rowCount(join(" && ", $query), $param);

			$this->result["mailList"] = $mailList;
			return view("mailbox6", $this->result, "m_layout");
		}

		public function write($idx = null)
		{
			$mail = $this->db->table("mail")->fetch("idx = ?", [$idx]);
			$view_data = [
				"content" => "",
				"title" => "",
				"target" => "",
				"type" => "",
				"mail_idx" => "",
			];

			$this->result["mail"] = $mail;

			if($mail && $_GET["type"] == "send") {
				$view_data["content"] = $mail["content"];
				$view_data["title"] = $mail["title"];

				$view_data["type"] = "?type=send";
				$view_data["mail_idx"] = $mail['idx'];
				$view_data["file"] = $this->db->table("file")->fetchAll("midx = ?", [$idx]);
			};

			if($mail && $_GET["type"] == "return") {
				$view_data["target"] = $mail["send_id"];
			};

			$this->result = array_merge($this->result, $view_data);

			return view("write", $this->result, "m_layout");
		}

		public function mywrite()
		{
			return view("write_to_me", $this->result, "m_layout");
		}

		public function view($idx)
		{

			$mail = $this->db->table("mail")->fetch("idx = ?", [$idx]);
			$updateing = [];
			$col = $mail["target"] == $this->login["email"] ? "t_read" : "s_read";

			$updateing[$col] = true;

			$this->db->table("mail")->update($updateing, $idx);
			$this->countRefresh();

			$this->result["mail"] = $this->addFiles($mail);
			$this->result["menus"] = $this->menus;

			return view("view", $this->result, "m_layout");
		}

		public function highright(&$mail)
		{
			$span = "<span class='highright'>{$_GET['search']}</span>";

			$mail["title"] = str_replace($_GET["search"], $span, $mail["title"]);
			$mail["content"] = str_replace($_GET["search"], $span, $mail["content"]);
		}

		public function postWriteMe()
		{
			$dir = ["/", "내게쓰기가 완료되었습니다."];

			$type = isset($_POST["save"]) ? "my" : "";
			$type = isset($_POST["tmp"]) ? "tmp" : $type;

			$success = $this->writeAction([
				"type" => $type,
			]);

			if(!$success)
				$dir[1] = $this->msg;

			return redirect(...$dir);
		}

		public function postWrite($idx = null)
		{
			$send_type = $_GET["type"] ?? "";
			$dir = ["/", "작성이 완료되었습니다."];

			if($_POST["target"] == $this->login["email"]) {
				redirect("/mail/write", "내게 쓰기를 사용하세요.");
			};

			$type = isset($_POST["send"]) ? "send" : "";
			$type = isset($_POST["preview"]) ? "preview" : $type;
			$type = isset($_POST["tmp"]) ? "tmp" : $type;

			$success = $this->writeAction([
				"target" => $_POST["target"],
				"type" => $type,
			]);

			if($send_type == "send") {
				$files = $this->db->table("file")->fetchAll("midx = ?", [$idx]);

				foreach ($files as $key => $file) {
					unset($file["idx"]);
					$file["midx"] = $success;
					$this->db->insert($file);
				};
			};

			if(!$success) {
				$dir[1] = $this->msg;
			};

			redirect(...$dir);
		}

		public function writeAction($data)
		{
			$file = $_FILES["file"];
			$file_ok = $file["name"][0] != "";
			$result = true;


			if($file_ok)
				$this->fileChk($file);

			if(!$this->msg) {
				$midx = $this->db->table("mail")->insert(array_merge([
					"title" => $_POST["title"],
					"content" => $_POST["content"],
					"send_id" => $this->login["email"],
					"send_name" => $this->login["name"]
				], $data));

				
				if($file_ok) {
					$this->fileUpload($file, $midx);
				};

				$result = $midx;
			} else {
				$result = false;
			};

			return $result;
		}

		public function fileChk($file)
		{
			$totalSize = array_sum($file["size"]) / 1024 / 1024;

			if(count($file["name"]) > 20 || $totalSize >= 20)
				$this->msg[] = "파일은 최대 20개, 업로드 용량은 최대 20Mb 입니다.";
		}

		public function fileUpload($file, $mailIdx)
		{
			for ($i=0; $i < count($file["name"]); $i++) { 
				$filename = date("YmdHis")."_".rand(111, 999).".".pathinfo($file["name"][$i])["extension"];

				move_uploaded_file($file["tmp_name"][$i], ROOT."/upload/".$filename);

				$this->db->table("file")->insert([
					"filename" => $file["name"][$i],
					"realname" => $filename,
					"midx" => $mailIdx,
					"filesize" => round($file["size"][$i] / 1024, 1),
				]);
			};
		}

		public function makeSearchSql($sql, $param)
		{
			if($this->search != "") {
				$sql[] = "(`title` LIKE ? || `content` LIKE ? )";
				$param[] = "%$this->search%";
				$param[] = "%$this->search%";
			};

			if($this->s_date != "") {
				$sql[] = "date >= ?";
				$param[] = date("Y-m-d H:i:s", strtotime($this->s_date));
			};

			if($this->e_date != "") {
				$sql[] = "date <= ?";
				$param[] = date("Y-m-d H:i:s", strtotime($this->e_date) + 86399);
			};

			$sql = join(" && ", $sql);
			$mails = $this->db->table("mail")->fetchAll($sql, $param);

			foreach ($mails as $key => &$mail) {
				$mail = $this->addFiles($mail);

				if($this->search != "") {
					$this->highright($mail);
				};
			};

			return $mails;
		}

		private function addFiles($mail)
		{
			$mail["files"] = $this->db->table("file")->fetchAll("midx = ?", [$mail["idx"]]);
			$mail["filesize"] = $this->db->fetch("midx = ?", [$mail['idx']], "SUM(filesize) as sum")["sum"] ?? 0;

			return $mail;
		}

		public function action()
		{
			if(!isset($_POST["midx"])) {
				redirect("back", "메일을 선택해주세요.");
			};

			$midxs = $_POST["midx"];

			$type = isset($_POST["send"]) ? "send" : "";
			$type = isset($_POST["preview"]) ? "preview" : $type;
			$type = isset($_POST["tmp"]) ? "tmp" : $type;
			$type = isset($_POST["delete"]) ? "delete" : $type;
			$type = isset($_POST["read"]) ? "read" : $type;
			$type = isset($_POST["spam"]) ? "spam" : $type;
			$type = isset($_POST["return"]) ? "return" : $type;
			$type = isset($_POST["restore"]) ? "restore" : $type;
			$type = isset($_POST["veryDelete"]) ? "veryDelete" : $type;

			if(count($midxs) > 1 && in_array($type, ["send", "return"])) {
				redirect("back", "전달과 답장은 한개 선택후 이용해주세요.");
			};

			$this->db->table("mail");

			foreach ($midxs as $key => $midx) {
				$mail = $this->db->fetch("idx = ?", [$midx]);

				switch($type) {
					case "delete" :
						$col = $mail["target"] == $this->login["email"] ? "t_del" : "s_del";

						$update_data = [];
						$update_data[$col] = true;

						$this->db->update($update_data, $midx);
						break;
					case "send" :
					case "return":
						return redirect("/mail/write/{$midx}?type={$type}");
						break;
					case "read":
						$col = $mail["target"] == $this->login["email"] ? "t_read" : "s_read";
						$update_data = [];
						$update_data[$col] = true;

						$this->db->update($update_data, $midx);
						break;
					case "spam":
						$this->db->update([
							"t_spam" => true,
						], $midx);
						break;
					case "restore":
					case "veryDelete":
						$col = $mail["target"] == $this->login["email"] ? "t_del" : "s_del";
						$update_data = [];
						$update_data[$col] = $type == "veryDelete" ? 2 : 0;

						$this->db->update($update_data, $midx);
						break;
				};
			};

			redirect("back");
		}

		public function download()
		{
			$file = $this->db->table("file")->fetch("idx = ?", [$_GET['idx']]);
			$filename = $file['filename'];

			$fe = fopen(ROOT."/upload/".$file["realname"], "r");

			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=\"$filename\"");

			fpassthru($fe);
		}
	}