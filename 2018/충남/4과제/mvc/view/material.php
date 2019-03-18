<div id="content">
	<div class="w100">
		<div class="material">
			<h1 class="title">기간별 매출관리</h1>
			<button class="formerly arrow" onclick="location.href='/admin/material?month=<?php echo $month-1 ?>'">&lt;</button>
			<button class="next arrow" onclick="location.href='/admin/material?month=<?php echo $month+1 ?>'">&gt;</button>
			<h2 class="date"><?php echo $month ?>월</h2>
			<table>
				<tr>
					<th rowspan="2">예약일</th>
					<th colspan="2">예약건수</th>
					<th colspan="2">결제금액</th>
				</tr>
				<tr>
					<th>건수</th>
					<th>증감</th>
					<th>금액</th>
					<th>증감</th>
				</tr>
				<?php $first = true; ?>
				<?php for ($i=0; $i < count($result); $i++) {  ?>
					<?php $data = $result[$i]; ?>
					<tr>
						<td><?php echo $data["date"] ?></td>
						<td><?php echo $data["count"] ?>건</td>
						<td>
							<?php 
								if($i == 0 || $result[$i - 1]["count"] - $data["count"] == 0) {
									echo "─";
								} else {
									$counting = $result[$i - 1]["count"] - $data["count"];
									$mark = "▲";
									if($counting > 0) {
										$mark = "▼";
									};

									echo $mark." ".abs($counting)."건";
								};
							?>
						</td>
						<td><?php echo don($data["price"]) ?>원</td>
						<td>
							<?php 
								if($i == 0 || $result[$i - 1]["price"] - $data["price"] == 0) {
									echo "─";
								} else {
									$data = $result[$i - 1]["price"] - $data["price"];
									$mark = "▲";
									if($data > 0) {
										$mark = "▼";
									};

									echo $mark." ".don(abs($data))."원";
								};
							?>
						</td>
					</tr>
				<?php } ?>
			</table>
			
			<h1 class="title">기간별 매출관리 현황</h1>
			<img src="/admin/graph?month=<?php echo $month ?>" width="1440" height="500">
		</div>
	</div><!--w100-->
</div><!--content-->

</body>
</html>