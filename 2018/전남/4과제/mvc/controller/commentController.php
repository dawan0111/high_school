<?php

	namespace Controller;

	/**
	 * 	commentController
	 */
	class commentController extends _PublicController
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function write($tidx)
		{
			$dir = ["/tour/view/{$tidx}", "작성이 완료되었습니다."];

			$this->match([
				[$_POST["title"] == "", "제목을 입력해주세요."],
				[$_POST['info'] == "", "내용을 입력해주세요."],
				[$_POST["star"] == -1, "평점을 선택해주세요."]
			]);

			if (!$this->msg) {
				$this->db->table('comment')->insert([
					"star" => $_POST["star"],
					"midx" => $this->login["idx"],
					"writer" => $this->login["name"],
					"content" => $_POST["info"],
					"title" => $_POST["title"],
					"tidx" => $tidx,
				]);
			} else {
				$dir[1] = $this->msg;
			}

			redirect(...$dir);
		}

		public function modify($idx)
		{
			return view('comment_modify', array_merge($this->result, [
				"comment" => $this->db->table("comment")->fetch("idx = ?", [$idx]),
			]));
		}

		public function postModify($cidx)
		{
			$comment = $this->db->table('comment')->fetch('idx = ?', [$cidx]);
			$dir = ["/tour/view/{$comment['tidx']}", "수정이 완료되었습니다."];

			$this->match([
				[$_POST["title"] == "", "제목을 입력해주세요."],
				[$_POST["star"] == -1, "평점을 선택해주세요."]
			]);	

			if (!$this->msg) {
				$this->db->table('comment')->update([
					"star" => $_POST["star"],
					"content" => $_POST["info"],
					"title" => $_POST["title"],
				], $cidx);
			} else {
				$dir[1] = $this->msg;
			}

			redirect(...$dir);
		}

		public function delete($idx)
		{
			$tour = $this->db->table("comment")->fetch("idx = ?", [$idx]);
			$this->db->delete("idx = ?", [$idx]);

			redirect("/tour/view/{$tour['tidx']}", "삭제가 완료되었습니다.");
		}
	}