	<div id="course_list">
		<div class="wrap">
			<h2>코스 목록</h2>
			<div class="btn-box">
				<a href="/course/index?order=c_date" class="btn <?php echo $order == "c_date" ? "on" : ""; ?>">최신순</a>
				<a href="/course/index?order=good" class="btn <?php echo $order == "good" ? "on" : ""; ?>">인기순</a>
			</div>
			<div class="list">
				<?php foreach ($course_list as $key => $course): ?>
					<div class="box">
						<span class="img">
							<a href="/course/view/<?php echo $course['idx'] ?>?order=<?php echo $order ?>">
								<img src="/images/<?php echo $course["tours"][0]["image"] ?>" alt="image">
							</a>
						</span>
						<span class="con">
							<div class="container">
								<h4><a href="/course/view/<?php echo $course['idx'] ?>?order=<?php echo $order ?>"><?php echo $course["title"] ?></a></h4>
								<div class="course">
									<?php foreach ($course["tours"] as $key => $tour): ?>
										<span><?php echo $tour["name"] ?></span>
										<?php if ($key != count($course["tours"]) - 1): ?>
											<i class="fa fa-angle-right"></i>
										<?php endif ?>
									<?php endforeach ?>
								</div>
								<p><?php echo $course["info"] ?></p>
								<div class="like">
									<i class="fa fa-heart"></i>
									<?php echo $course["good"] ?>
								</div>
								<span class="date"><?php echo $course["date"] ?></span>
							</div>
						</span>
						<?php if (@$login && $login["idx"] == $course["midx"]): ?>
							<div class="btn">
								<a href="/course/modify/<?php echo $course['idx'] ?>" class="modi">수정</a>
								<a href="/course/courseDelete/<?php echo $course['idx'] ?>" class="del confirm-a">삭제</a>
							</div>
						<?php endif ?>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>

</body>
</html>