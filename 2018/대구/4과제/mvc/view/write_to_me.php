	<div class="mail-content">
		<div class="mail-title">내게쓰기</div>
		<form method="post" action="/mail/postWriteMe" enctype="multipart/form-data">
			<div class="mail-skill-btn-group">
				<div class="btn-group">
					<button name="save" class="btn btn-default">저장</button>
				</div>
				<div class="btn-group">
					<button name="tmp" class="btn btn-default">임시저장</button>
				</div>
			</div>
			<div class="mail-write">
				<div class="form-group input-group">
					<label for="">제목</label>
					<input type="text" class='form-control' name="title">
				</div>
				<div class="form-group input-group">
					<label for="">파일첨부</label>
					<input type="file" class='form-control' multiple name="file[]">
				</div>
				<div class="form-group">
					<textarea class="form-control" name="content"></textarea>
				</div>
			</div>
		</form>
	</div>
</section>