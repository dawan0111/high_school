	<article class="items">
		<?php if (!isset($_GET["search"]) || $_GET["search"] == ""): ?>
			<p class="title">Best</p>
			<section class="rank item">
				<?php foreach ($products as $key => $product): ?>
					<?php if ($key == 2): ?>
						<?php break; ?>
					<?php endif ?>
					<div onclick="location.href='/product/view/<?php echo $product['pidx'] ?>'">
						<img src="/img/<?php echo $product['file'] ?>">
						<div>
							<h3><?php echo $product["name"] ?></h3>
							<p>
								<?php if ($product["sale"] != 0): ?>
									<span><?php echo $product["sale"] ?>%</span> <!-- 할인률(없을시 생략) -->
									<span class="dis"><?php echo number_format($product["price"]) ?>원</span> <!-- 할인 전 가격(없을시 생략) -->
								<?php endif ?>
								<span><?php echo $product["salePrice"] ?>원</span></p> <!-- 가격(할인가) -->
						</div>
					</div>
					<?php
						unset($products[$key]);
					?>
				<?php endforeach ?>
			</section>
		<?php endif ?>
		<p class="title">All</p>
		<section class="all item">
			<?php foreach ($products as $key => $product): ?>
				<div onclick="location.href='/product/view/<?php echo $product['pidx'] ?>'">
					<img src="/img/<?php echo $product['file'] ?>">
					<div>
						<?php
							$name = $product["name"];

							if($search != "") {
								$name = str_replace($search, "<mark>$search</mark>", $name);
							};
						?>
						<h3><?php echo $name ?></h3>
						<p>
							<?php if ($product["sale"] != 0): ?>
								<span><?php echo $product["sale"] ?>%</span> <!-- 할인률(없을시 생략) -->
								<span class="dis"><?php echo number_format($product["price"]) ?>원</span> <!-- 할인 전 가격(없을시 생략) -->
							<?php endif ?>
							<span><?php echo $product["salePrice"] ?>원</span></p> <!-- 가격(할인가) -->
					</div>
				</div>
			<?php endforeach ?>
		</section>
	</article>
</body>
</html>