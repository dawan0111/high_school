	<div id="content">
		<div class="w100">
			<div class="admin">
				<h1 class="title">결제 및 반납관리</h1>
				<table>
					<tr>
						<th>회원등급</th>
						<th>이름</th>
						<th>아이디</th>
						<th>품목명</th>
						<th>대여~반납일</th>
						<th>대여/반납지점</th>
						<th>결제금액</th>
						<th>상태</th>
					</tr>
					<?php foreach ($res_data as $key => $data): ?>
						<tr>
							<td><?php echo $data["level"] ?></td>
							<td><?php echo $data["username"] ?></td>
							<td><?php echo $data["id"] ?></td>
							<td><?php echo $data["product_name"] ?></td>
							<td><?php echo date("Y-m-d", stt($data["s_time"]))." ~ ".date("Y-m-d", stt($data["e_time"])) ?></td>
							<td><?php echo $data["start"] ?>/<?php echo $data["end"] ?></td>
							<td><?php echo don($data["buyprice"]) ?></td>
							<td>
								<?php if ($data["state"] == "대기중"): ?>
									<a href="/admin/resOk/<?php echo $data['i_idx'] ?>" class="btn blueBtn">결제완료</a>
								<?php elseif ($data["state"] == "결제완료"): ?>
									<span>결제완료</span>
								<?php else: ?>
									<span>반납완료</span>
								<?php endif ?>
							</td>
						</tr>
					<?php endforeach ?>
				</table>
			</div>
		</div><!--w100-->
	</div><!--content-->
	
</body>
</html>