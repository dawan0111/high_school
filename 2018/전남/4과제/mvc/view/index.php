

	<div id="main">
		<div class="banner"></div>
		<div class="wrap">
			<div class="list">
				<h3>최근 추가된 코스</h3>
				<div class="box-wrap">
					<?php foreach ($add_tour as $key => $tour): ?>
						<span class="box">
							<a href="/course/view/<?php echo $tour["idx"] ?>?order=c_date">
								<img src="/images/<?php echo $tour["tours"][0]['image'] ?>" alt="image">
								<h4 class="js-overFlow" data-length="14"><?php echo $tour['title'] ?></h4>
								<p class="js-overFlow" data-length="40"><?php echo $tour["info"] ?></p>
								<div class="info">
									<span>
										<i class="fa fa-heart"></i>
										<?php echo $tour['good'] ?>
									</span>
									<span><?php echo $tour['date'] ?></span>
								</div>
							</a>
						</span>
					<?php endforeach ?>
				</div>
				<a href="/course/index?order=c_date" class="more">더보기</a>
			</div>
			<div class="list">
				<h3>인기 있는 코스</h3>
				<div class="box-wrap">
					<?php foreach ($nice_tour as $key => $tour): ?>
						<span class="box">
							<a href="/course/view/<?php echo $tour['idx'] ?>?order=good">
								<img src="/images/<?php echo $tour["tours"][0]['image'] ?>" alt="image">
								<h4 class="js-overFlow" data-length="14"><?php echo $tour['title'] ?></h4>
								<p class="js-overFlow" data-length="40"><?php echo $tour["info"] ?></p>
								<div class="info">
									<span>
										<i class="fa fa-heart"></i>
										<?php echo $tour['good'] ?>
									</span>
									<span><?php echo $tour['date'] ?></span>
								</div>
							</a>
						</span>
					<?php endforeach ?>
				</div>
				<a href="/course/index?order=good" class="more">더보기</a>
			</div>
		</div>
	</div>
	
</body>
</html>