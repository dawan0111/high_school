	<div id="cart">
		<p class="title"><span class="glyphicon glyphicon-shopping-cart"></span>장바구니</p>
		<form class="form-inline" method="post" action="/buy/cartAction">
			<div class="controll" style="display: flex;">
				<button class="col-sm-offset-9 btn btn-danger" name="delete" style="margin-right: 20px">선택제거</button>
				<button class="btn btn-success" name="buy">선택구매</button>
			</div>
			<table class="table table-striped">
				<thead>
					<th class="col-sm-1">선택</th>
					<th>상품명</th>
					<th>할인율(현재)</th>
					<th>상품권 사용</th>
					<th>가격</th>
					<th>선택수량</th>
					<th>총액</th>
					<th>재고</th>
				</thead>
				<tbody>
					<?php foreach ($lists as $key => $list): ?>
						<?php
							$totalPrice = $list["salePrice"] * $list["buyStock"];
							$totalPrice -= $totalPrice / 100 * $list["sale"];
						?>
						<tr>
							<td><input type="checkbox" name="idx[]" value="<?php echo $list['bidx'] ?>"></td>
							<td><?php echo $list["name"] ?></td>
							<td><?php echo $list["sale"] ?>%</td>
							<td>
								<?php if ($list["cprt"] != 0): ?>
									<?php echo $list["cprt"] ?>% 할인 상품권
								<?php endif ?>
							</td>
							<td><?php echo number_format($list["salePrice"]) ?></td>
							<td><?php echo $list["buyStock"] ?>개</td>
							<td><?php echo number_format($totalPrice) ?></td>
							<td><?php echo $list["stock"] ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</form>
	</div>
</body>
</html>