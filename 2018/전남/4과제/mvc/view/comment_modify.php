<div id="view">
	<form class="form" method="post" action="/comment/postModify/<?php echo $comment['idx'] ?>">
		<table>
			<tr>
				<td>
					<label for="">제목</label>
				</td>
				<td>
					<input type="text" name="title" value="<?php echo $comment['title'] ?>">
				</td>
			</tr>
			<tr>
				<td>
					<label for="">평점</label>
				</td>
				<td class="js-score">
					<input type="hidden" name="star" value="<?php echo $comment['star'] ?>" class="js-getScore">
					<?php echo makeStar($comment["star"]) ?>
				</td>
			</tr>
			<tr>
				<td>
					<label for="">내용</label>
				</td>
				<td>
					<textarea name="info" style="font-family:'malgun gothic'"><?php echo $comment['content'] ?></textarea>
				</td>
			</tr>
		</table>
		<input type="submit" value="수 정">
	</form>
</div>