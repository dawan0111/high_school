	<div id="course_create">
		<div class="left">
			<div class="menu">
				<?php foreach ($lists as $key => $list): ?>
					<?php
						$link = $idx != null ? "/course/create/".$idx : "/course/create";
					?>
					<span class="<?php echo $category == $list ? "on" : ""; ?>"><a href="<?php echo $link ?>?category=<?php echo $list ?>"><?php echo $list ?></a></span>
				<?php endforeach ?>
			</div>
		</div>
		<div class="center">
			<div class="list js-flexAlign">
				<?php
					$add_idx = array_column($add_course, "idx");
				?>
				<?php foreach ($tour_list as $key => $tour): ?>
					<div class="box">
						<img src="/images/<?php echo $tour['image'] ?>" alt="image">
						<h4><?php echo $tour['name'] ?></h4>
						<div class="type"><?php echo $tour['category'] ?></div>

						<?php if (!in_array($tour['idx'], $add_idx)): ?>
							<a href="/course/add/<?php echo $tour['idx'] ?>" class="btn">코스 추가</a>
						<?php endif ?>
					</div>
				<?php endforeach ?>
			</div>
		</div>
		<div class="right">
			<?php
				$action = $idx == null ? "/course/courseAdd" : "/course/courseModify/".$idx;
			?>
			<form class="form" method="post" action="<?php echo $action ?>">
				<div class="button">
					<input class="btn" type="submit" value="코스 저장">
					<input class="btn" type="reset" value='초기화' onclick="location.href='/course/clear'">
				</div>
				<div class="title">
					<input type="text" placeholder="제목" name="title" value="<?php echo $idx != "" ? $course['title'] : ""; ?>">
				</div>
				<div class="content">
					<textarea placeholder="설명" name="content" style="font-family: 'malgun gothic'"><?php echo $idx != "" ? $course['info'] : ""; ?></textarea>
				</div>
				<div class="list">
					<div class="top">
						<span>
							<i class="fa fa-map-marker"></i>
							추가한 관광지
						</span>
					</div>
					<?php foreach ($add_course as $key => $course): ?>
						<div class="box">
							<span class="idx"><?php echo $key + 1 ?></span>
							<span class="title"><?php echo $course['name'] ?></span>
							<a class="remove" href="/course/delete/<?php echo $key ?>"><i class="fa fa-times"></i></a>
						</div>
					<?php endforeach ?>
				</div>
			</form>
		</div>
	</div>

</body>
</html>