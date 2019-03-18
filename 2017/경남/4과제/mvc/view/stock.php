	<div id="stock">
		<p class="title"><span class="glyphicon glyphicon-list-alt"></span>재고관리</p>
		<form class="form-inline" method="post" action="/product/addStock">
			<div class="controll">
				<div class="form-group">
					<input type="text" class="form-control" name="count" placeholder="수량">
				</div>
				<div class="form-group">
					<button class="form-control">적용</button>
				</div>
			</div>
			<table class="table table-striped">
				<thead>
					<th class="col-sm-1">선택</th>
					<th>상품명</th>
					<th>가격</th>
					<th>재고</th>
				</thead>
				<tbody>
					<?php foreach ($products as $key => $product): ?>
						<tr>
							<td><input type="checkbox" name="idx[]" value="<?php echo $product['idx'] ?>"></td>
							<td><?php echo $product["name"] ?></td>
							<td><?php echo number_format($product["price"]) ?></td>
							<td><?php echo $product["stock"] ?>개</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</form>
	</div>
</body>
</html>