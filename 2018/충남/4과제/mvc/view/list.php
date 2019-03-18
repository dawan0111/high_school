<div id="content">
	<div class="w100">
		<div class="list">
			<h1 class="title">예약 품목 리스트</h1>
			<ul>
				<?php foreach ($product_list as $key => $product): ?>
					<li>
						<img src="/images/<?php echo $product['image'] ?>" alt="image" title="image">
						<h4>이름 : <span><?php echo $product["name"] ?></span></h4>
						<h4>기본렌탈료 : <span><?php echo number_format($product["price"]) ?></span>원</h4>
						<h4>월, 금 할인/할증률 : <span>0</span>%</h4>
						<h4>화, 수, 목 할인률 : <span>30</span>%</h4>
						<h4>토, 일 할증률 : <span>20</span>%</h4>
						<h4 class="last">대여가능 수량 : <span><?php echo $product["use_quantity"] ?></span> / <?php echo $product["quantity"] ?> 대</h4>
						
						<div class="right">
							<a href="/product/detail/<?php echo $product['idx'] ?>" class="btn infor blueBtn">상세정보</a>
							<?php if ($product["use_quantity"] != 0): ?>
								<a href="/product/res/<?php echo $product['idx'] ?>"" class="btn Reserv blueBtn">예약하기</a>
							<?php endif ?>
						</div>
					</li>
				<?php endforeach ?>
			</ul>
			
		</div><!--list-->
	</div><!--w100-->
</div><!--content-->


</body>
</html>