	<div id="list">
		<p class="title">
			<span class="glyphicon glyphicon-list"></span>구매목록
			<span style="float:right;font-size:16pt">총 사용 금액: <?php echo $total == "" ? 0 : $total ?>원</span>
		</p>
		<table class="table table-striped">
			<thead>
				<th>#</th>
				<th>상품명</th>
				<th>가격</th>
				<th>구매수량</th>
				<th>상품권 사용</th>
				<th>사용금액</th>
				<th>구매날짜</th>
				<th>환불신청</th>
			</thead>
			<tbody>
				<?php foreach ($lists as $key => $list): ?>
					<?php
						$totalPrice = ($list["buyprice"] - $list["buyprice"] / 100 * $list["cprt"]) * $list["buyStock"];
						$return = strtotime($list["date"]) + 86400 > strtotime("now");
					?>
					<tr>
						<td><?php echo $list["idx"] ?></td>
						<td><?php echo $list["name"] ?></td>
						<td><?php echo number_format($list["buyprice"]) ?>원</td>
						<td><?php echo $list["buyStock"] ?>개</td>
						<td>
							<?php if ($list["coupon"] != 0): ?>
								<?php echo $list["cprt"] ?>% 할인 상품권
							<?php endif ?>
						</td>
						<td><?php echo number_format($totalPrice) ?>원</td>
						<td>
							<?php if ($return): ?>
								<?php echo $list["date"] ?>
							<?php else: ?>
								<?php echo date("Y-m-d", strtotime($list["date"])); ?>
							<?php endif ?>
						</td>
						<td><button class="btn btn-default" <?php echo $return ? "" : "disabled"; ?> onclick="location.href='/buy/buyReturn/<?php echo $list['bidx'] ?>'">환불</button></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</body>
</html>