	<div id="view">
		<div class="wrap">
			<h2>관광지 보기</h2>
			<div class="btn-box">
				<a href="/tour/index?category=<?php echo $tour['category'] ?>" class="btn">목록으로</a>
			</div>
			<div class="intro">
				<div class="img">
					<img src="/images/<?php echo $tour['image'] ?>" alt="image">
				</div>
				<div class="content">
					<h3><?php echo $tour["name"] ?></h3>
					<span class="type"><?php echo $tour["category"] ?></span>
					<div class="score">
						<span class="header">관광지 평점</span>
						<span class="star">
							<?php echo makeStar($tour["star"] ?? 0) ?>
						</span>
						<span class="num"><?php echo $tour["star"] ?> ( <?php echo $tour["count"] ?> )</span>
					</div>
					<p><?php echo $tour['info'] ?></p>
				</div>
			</div>
		</div>
		<div class="comment">
			<div class="wrap">
				<?php if ($login): ?>
					<form class="form" method="post" action="/comment/write/<?php echo $tour['idx'] ?>">
						<table>
							<tr>
								<td>
									<label for="">제목</label>
								</td>
								<td>
									<input type="text" name="title">
								</td>
							</tr>
							<tr>
								<td>
									<label for="">평점</label>
								</td>
								<td class="js-score">
									<input type="hidden" name="star" value="-1" class="js-getScore">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</td>
							</tr>
							<tr>
								<td>
									<label for="">내용</label>
								</td>
								<td>
									<textarea name="info" style="font-family:'malgun gothic'"></textarea>
								</td>
							</tr>
						</table>
						<input type="submit" value="전 송">
					</form>
				<?php endif ?>
				<div class="list">
					<?php foreach ($comments as $key => $comment): ?>
						<div class="box">
							<h4 class="title"><?php echo $comment['title'] ?></h4>
							<div class="star" data-idx="<?php echo $comment["star"] ?>">
								<?php echo makeStar($comment["star"]) ?>
							</div>
							<p><?php echo $comment["content"] ?></p>
							<dl>
								<dt>작성자 : </dt>
								<dd class="writer"><?php echo $comment["writer"] ?></dd>
								<dt>작성일 : </dt>
								<dd><?php echo date("Y-m-d", strtotime($comment["date"])) ?></dd>
							</dl>

							<?php if ($login && $login["idx"] == $comment['midx']): ?>
								<div class="btn">
									<a href="/comment/modify/<?php echo $comment['idx'] ?>"  class="modi">수정</a>
									<a href="/comment/delete/<?php echo $comment['idx'] ?>" class="del confirm-a">삭제</a>
								</div>
							<?php endif ?>
						</div>
					<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>