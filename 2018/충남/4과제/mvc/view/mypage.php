	<div id="content">
		<div class="w100">
			<div class="mypage">
				<h1 class="title">마이페이지</h1>
				
				<div class="page">
					<h3 class="title">예약 및 결제 완료된 품목</h3>
					<table>
						<tr>
							<th>구분</th>
							<th>품목명</th>
							<th>대여일(시간)~반납일(시간)</th>
							<th>대여/반납지점</th>
							<th>결제금액</th>
							<th>예약상태</th>
							<th>선택</th>
						</tr>
						<?php foreach ($success_list as $key => $success): ?>
							<tr>
								<td><?php echo $success["ridx"] ?></td>
								<td><img src="/images/<?php echo $success['image'] ?>" alt="image" title="image"><span><?php echo $success['product_name'] ?></span></td>
								<td><?php echo $success["s_time"]." ~ ".$success["e_time"] ?></td>
								<td><?php echo $success["start"] ?>/<?php echo $success["end"] ?></td>
								<td><?php echo don($success["buyprice"]) ?></td>
								<td><?php echo $success["state"] ?></td>
								<td>
									<?php if ($success["state"] != "결제완료"): ?>
										<button class="btn blueBtn" onclick="location.href='/member/cancle/<?php echo $success["i_idx"] ?>'">예약취소</button>
									<?php else: ?>
										<button class="btn blueBtn" onclick="location.href='/member/promise/<?php echo $success["ridx"] ?>'">렌탈계약서</button>
									<?php endif ?>
								</td>
							</tr>
						<?php endforeach ?>
					</table>
				</div><!--page-->
					
				<div class="cancelT">
					<h3 class="title">취소 및 반납된 품목</h3>
					<table>
						<tr>
							<th>품목명</th>
							<th>대여일(시간) ~ 반납일(시간)</th>
							<th>대여/반납지점</th>
							<th>결제금액</th>
							<th>취소사유</th>
						</tr>
						<?php foreach ($cancle_list as $key => $item): ?>
							<tr>
								<td><?php echo $item["name"] ?></td>
								<td><?php echo date("Y-m-d H:i", stt($item['s_time']))."~".date("Y-m-d H:i", stt($item["e_time"])) ?></td>
								<td><?php echo $item["start"] ?>/<?php echo $item["end"] ?></td>
								<td><?php echo don($item["buyprice"]) ?></td>
								<td><?php echo $item["cancle"] ?></td>
							</tr>
						<?php endforeach ?>
					</table>
				</div>
			</div><!--mypage-->
		</div><!--w100-->
	</div><!--content-->
	
</body>
</html>