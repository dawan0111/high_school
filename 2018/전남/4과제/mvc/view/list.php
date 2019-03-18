<div id="list">
	<div class="wrap">
		<h2>관광지 목록</h2>
		<div class="left fl">
			<div class="type">
				<?php foreach ($lists as $key => $list): ?>
					<span class="<?php echo $category == $list ? "on" : ""; ?>"><a href="/tour/index?category=<?php echo $list ?>"><?php echo $list ?></a></span>
				<?php endforeach ?>
			</div>
		</div>
		<div class="right fr">
			<div class="list">
				<?php foreach ($tour_list as $key => $tour): ?>
					<span>
						<a href="/tour/view/<?php echo $tour['idx'] ?>">
							<img src="/images/<?php echo $tour['image'] ?>" alt="image">
							<h4><?php echo $tour['name'] ?></h4>
							<span class="star">
								<?php echo makeStar($tour["star"] ?? 0) ?>
								<i class="text"><?php echo $tour['star'] ?? 0 ?> ( <?php echo $tour["count"] ?> )</i>
							</span>
							<p class="js-overFlow"><?php echo $tour['info'] ?></p>
						</a>
					</span>
				<?php endforeach ?>
			</div>
		</div>
	</div>
</div>

</body>
</html>