	<div id="dc">
		<p class="title"><span class="glyphicon glyphicon-usd"></span>할인율 설정</p>
		<form class="form-inline" method="post" action="/product/setSale">
			<div class="controll">
				<div class="form-group">
					<select type="text" class="form-control" name="sale">
						<option value="">할인율 설정</option>
						<option value="0">0%</option>
						<option value="10">10%</option>
						<option value="20">20%</option>
						<option value="30">30%</option>
						<option value="40">40%</option>
						<option value="50">50%</option>
						<option value="60">60%</option>
						<option value="70">70%</option>
						<option value="80">80%</option>
						<option value="90">90%</option>
					</select>
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
					<th>할인율</th>
				</thead>
				<tbody>
					<?php foreach ($products as $key => $product): ?>
						<tr>
							<td><input type="checkbox" name="idx[]" value="<?php echo $product['idx'] ?>"></td>
							<td><?php echo $product["name"] ?></td>
							<td><?php echo number_format($product["price"]) ?></td>
							<td><?php echo $product["sale"] ?>%</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</form>
	</div>
	<div class="page" style="width:100%;text-align:center">
		<ul class="pagination">
			<?php for ($i=1; $i <= $blockEnd; $i++) {  ?>
				<?php $selected = $i == $page ? "class='active'" : ""; ?>
				<li <?php echo $selected ?>><a href="/admin/discount?page=<?php echo $i ?>"><?php echo $i ?></a></li>
			<?php } ?>
		</ul>
	</div>
</body>
</html>