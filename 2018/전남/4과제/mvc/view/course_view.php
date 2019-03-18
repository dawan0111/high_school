	<div id="course_view">
		<div class="wrap">
			<h2>코스 보기</h2>
			<div class="btn-box">
				<a href="/course/index?order=<?php echo $_GET["order"] ?>" class="btn">목록으로</a>
				<a href="/course/like/<?php echo $course['idx'] ?>?order=<?php echo $_GET["order"] ?>" class="btn">
					<i class="fa fa-heart <?php echo isset($like) && $like ? "on" : ""; ?>"></i>좋아요
				</a>
				<!-- <a href="#" class="btn"><i class="fa fa-heart on"></i>좋아요</a> -->
			</div>
			<div class="header">
				<div class="title">
					<h3><?php echo $course["title"] ?></h3>
					<dl>
						<i class="fa fa-calendar"></i>
						<dt>작성일</dt>
						<dd><?php echo $course["date"] ?></dd>
						<i class="fa fa-user"></i>
						<dt>작성자</dt>
						<dd><?php echo $course["writer"] ?></dd>
						<i class="fa fa-heart"></i>
						<dt>좋아요</dt>
						<dd><?php echo $course['good'] ?></dd>
					</dl>
				</div>
				<div class="course">
					<?php foreach ($course["tours"] as $key => $tour): ?>
						<span><?php echo $tour["name"] ?></span>
						<?php if ($key != count($course["tours"]) - 1): ?>
							<i class="fa fa-angle-right"></i>
						<?php endif ?>
					<?php endforeach ?>
				</div>
			</div>
			<div class="list">
				<?php foreach ($course["tours"] as $key => $tour): ?>
					<div class="box">
						<div class="img">
							<img src="/images/<?php echo $tour['image'] ?>" alt="image">
						</div>
						<div class="con">
							<h4><?php echo $tour['name'] ?></h4>
							<span class="type"><?php echo $tour["category"] ?></span>
							<dl>
								<i class="fa fa-map-marker"></i>
								<dt>주소</dt>
								<dd><?php echo $tour["address"] ?></dd>
								<i class="fa fa-info"></i>
								<dt>설명</dt>
								<dd class="js-overFlow" data-length="20"><?php echo $tour["info"] ?></dd>
							</dl>
						</div>
						<span class="idx"><?php echo $key + 1 ?></span>

						<?php if ($key != count($course["tours"]) - 1): ?>
							<?php
								$next = $course["tours"][$key + 1];
								$tour["x"] *= 0.9;
								$next["x"] *= 0.9;
								$tour["y"] *= 1.1;
								$next["y"] *= 1.1;

								$dir = sqrt(pow($tour["x"] - $next["x"], 2) + pow($tour["y"] - $next["y"], 2)) / 1000;

								$dir = round($dir, 1);

							?>
							<span class="distance"><?php echo $dir ?> km</span>
						<?php endif ?>
					</div>
				<?php endforeach ?>
				<div class="bar"></div>
			</div>
		</div>
	</div>

</body>
</html>