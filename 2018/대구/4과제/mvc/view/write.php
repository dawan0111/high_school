			<div class="mail-content">
				<div class="mail-title">메일쓰기</div>
				<form method="post" action="/mail/postWrite/<?php echo $mail_idx ?>/<?php echo $type ?>" enctype="multipart/form-data">
					<div class="mail-skill-btn-group">
						<div class="btn-group">
							<button class="btn btn-default" name="send">보내기</button>
						</div>
						<div class="btn-group">
							<button class="btn btn-default" name="preview" type="button">미리보기</button>
						</div>
						<div class="btn-group">
							<button class="btn btn-default" name="tmp">임시저장</button>
						</div>
					</div>
					<div class="mail-write">
						<div class="form-group input-group">
							<label for="">받는 사람</label>
							<input type="text" class='form-control' name="target" value="<?php echo $target ?>">
						</div>
						<div class="form-group input-group">
							<label for="">제목</label>
							<input type="text" class='form-control' name="title" value="<?php echo $title ?>">
						</div>
						<div class="form-group input-group">
							<label for="">파일첨부</label>
							<input type="file" class='form-control' name="file[]" multiple>
						</div>
						<div class="form-group">
							<textarea class="form-control" name="content"><?php echo $content ?></textarea>
						</div>
					</div>
				</form>
			</div>
		</section>
		<aside class="search-aside">
		</aside>
	</article>
</body>
</html>