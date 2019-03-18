	<div id="view">
	<form method="post" action="/product/buyAction/<?php echo $product['idx'] ?>">
		<div class="name">
			<h3><?php echo $product["name"] ?></h3>
		</div>
		<div class="wrap">
			<div class="imgBox">
				<img src="/img/<?php echo $product['file'] ?>" alt="상품이미지">
			</div>
			<div class="controll">
				<div class="info">
					<div class="price">
						<div class="chart">
							<div class='tit'>가격</div>
							<div class="val">
							<!-- 할인 없을 시 생략 -->
								<?php if ($product["sale"] != 0): ?>
									<p class="sale"><span><?php echo number_format($product["price"]) ?>원</span>(<?php echo $product["sale"] ?>% off)</p>
									<br>
								<?php endif ?>
							<!-- -->
								<span class="listPrice" data-price="<?php echo $product['salePrice'] ?>"><?php echo number_format($product["salePrice"]) ?></span>원
							</div>
						</div>
					</div>
					<div class="chart count">
						<div class="tit">재고</div>
						<div class="val">
							<span><?php echo $product["stock"] ?>개</span>
						</div>
					</div>
					<div class="chart count">
						<div class="tit">상품수량</div>
						<div class="val">
							<button type="button" class="control" data-type="mm">-</button>
							<input readonly  type="text" value="1" class="stock" name="stock">
							<button type="button" class="control" data-type="plus">+</button>
						</div>
					</div>
					<div class="chart gift">
						<div class="tit">상품권 사용</div>
						<div class="val">
							<select class="coupon" name="coupon">
								<option value="" data-prt="0">상품권 선택</option>
								<?php foreach ($coupon as $key => $cou): ?>
									<option value="<?php echo $cou['idx'] ?>" data-prt='<?php echo $cou['prt'] ?>'><?php echo $cou["prt"] ?>% 할인 상품권</option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
					<div class="chart total">
						<div class="tit">총 금액</div>
						<div class="val">
							<span class="total-price"><?php echo number_format($product["salePrice"]) ?></span>원
						</div>
					</div>
				</div>
				<div class="buttons">
					<button class="btn cart" name="cart">장바구니</button>
					<button class="btn buy" name="buy">구매하기</button>
				</div>
			</div>
		</div>
	</form>
	</div>

	<script>
		$(".control").on({
			click : function() {
				var type = $(this).data("type");
				var val = $(".stock").val();

				if(type == "plus") {
					val++;
				} else {
					if(val > 1) {
						val--;
					};
				};

				$(".stock").val(val);

				getTotalPrice();
			}
		});
		$(".coupon").on({
			change : function() {
				getTotalPrice();
			},
		})

		function getTotalPrice() {
			var price = $(".listPrice").data("price");
			var stock = $(".stock").val();
			var sale = $(".coupon option:selected").data("prt");

			var totalPrice = price * stock;

			totalPrice -= totalPrice / 100 * sale;

			$(".total-price").html(totalPrice.toLocaleString());
		}
	</script>
</body>
</html>