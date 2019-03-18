<div id="content">
	<div class="w100">
		<div class="item">
			<h1 class="title">예약관리</h1>
			<table>
				<tr>
					<th>회원등급</th>
					<th>이름</th>
					<th>아이디</th>
					<th>예약 품목명</th>
					<th>대여~반납일</th>
					<th>대여/반납지점</th>
					<th>렌탈료</th>
					<th>상태</th>
				</tr>
				<?php foreach ($res_datas as $key => $data): ?>
					<tr>
						<td><?php echo $data["level"] ?></td>
						<td><?php echo $data["name"] ?></td>
						<td><?php echo $data["id"] ?></td>
						<td><?php echo $data["product_name"] ?></td>
						<td><?php echo date("Y-m-d", stt($data["s_time"])) ?> ~ <?php echo date("Y-m-d", stt($data["e_time"])) ?></td>
						<td><?php echo $data["start"] ?>/<?php echo $data["end"] ?></td>
						<td><?php echo don($data["buyprice"]) ?></td>
						<td>
							<?php if ($data["state"] == "대기중"): ?>
								<button class="btn blueBtn Acancel" onclick="location.href='/admin/cancle/<?php echo $data["i_idx"] ?>'">예약취소</button>
							<?php else: ?>
								<span>예약취소</span>
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