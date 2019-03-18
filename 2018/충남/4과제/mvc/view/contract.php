<div id="content">
	<div class="w100">
		<div class="contract">
			<table id="table" border="1">
				<tr>
					<th colspan="4"><h2>렌탈계약서</h2></th>
				</tr>
				<tr>
					<th class="col-md-2">ID</th>
					<td class="col-md-3"><?php echo $res["id"] ?></td>
					<th class="col-md-2">성명</th>
					<td class="col-md-3"><?php echo $res["username"] ?></td>
				</tr>
				<tr>
					<th colspan="4" class="none"><h4>렌탈내역</h4></th>
				</tr>
				<tr>
					<th class="col-md-2">품목명</th>
					<td class="col-md-6" colspan="3"><?php echo $res["product_name"] ?></td>
				</tr>
				<tr>
					<th class="col-md-2">대여일(시간)</th>
					<td class="col-md-3"><?php echo date("Y-m-d H:i", stt($res["s_time"])) ?></td>
					<th class="col-md-2">반납일(시간)</th>
					<td class="col-md-3"><?php echo date("Y-m-d H:i", stt($res["e_time"])) ?></td>
				</tr>
				<tr>
					<th class="col-md-2">대여지점</th>
					<td class="col-md-3"><?php echo $res["start"] ?></td>
					<th class="col-md-2">반납지점</th>
					<td class="col-md-3"><?php echo $res["end"] ?></td>
				</tr>
				<tr>
					<th class="col-md-2">총 결제금액</th>
					<td class="col-md-3"><?php echo $res["buyprice"] ?></td>
					<th class="col-md-2">결제일</th>
					<td class="col-md-3"><?php echo date("Y-m-d H:i", stt($res["date"])) ?></td>
				</tr>
				<?php if ($res["info_type"] == "card"): ?>
					<tr>
						<th class="col-md-2">카드결제</th>
						<td class="col-md-3"><?php echo $res["info_bank"] ?>은행</td>
						<th class="col-md-2">카드번호</th>
						<td class="col-md-3"><?php echo $res["info_card"] ?></td>
					</tr>
				<?php else: ?>					
					<tr>
						<th class="col-md-2">무통장입금</th>
						<td class="col-md-3"><?php echo $res["info_bank"] ?></td>
						<th class="col-md-2">계좌번호</th>
						<td class="col-md-3"><?php echo $res["info_card"] ?></td>
					</tr>
				<?php endif ?>
				<tr>
					<th colspan="4" class="gray"><h4>렌탈 약관</h4></th>
				</tr>
				<tr class="last">
					<td colspan="4">
						<h4>제1조 (렌탈계약의 정의)</h4>
						<p>- 본 계약은 그린휠이 임차인에게 제공한 렌탈 품목이 정상적으로 사용될 수 있도록 필요한 일체의 부품 제공(별도협의) 및 보수 등을 행하며, 임차인은 이에 대하여 소정의 렌탈료를 그린휠에게 지불하는 것으로 한다.</p>
						<h4>제2조 (렌탈기간)</h4>
						<p>- 렌탈기간은 <?php echo date("Y년 m월 d일 h시 m분", stt($res["s_time"])) ?> ~ <?php echo date("Y년 m월 d일 h시 m분", stt($res["e_time"])) ?> 까지 한다.</p>
						<h4>제3조 (보수 서비스)</h4>
						<p>- 그린휠은 임차인에게 렌탈 품목의 사용방법을 지도한다.</p>
						<p>- 렌탈기간 중 임차인의 책임이 아닌 사유에 기인하여 발생한 성능의 결함에 의해 품목이 정상적으로 작동하지 않을 경우 그린휠은 24시간 이내에 수리 또는 교체해 주어야 한다.</p>
						<h4>제4조 (소유권 및 선관의무)</h4>
						<p>- 그린휠이 임차인에게 제공한 렌탈품목은 그린휠로부터 렌탈한 것으로 그린휠의 소유로 한다.</p>
						<p>- 임차인은 렌탈품목의 원형을 변경, 타인에게 매각, 양도, 유통, 질권의 설정 등 기타 그린휠에게 손해를 발생하게 할 우려가 있는 일체의 행위를 하여서는 안 된다.</p>
						<p>- 임차인은 렌탈품목의 소유권을 침해하는 제 3자의 행위(압류, 가압류, 가처분, 공조 공과의 체납 등에 의한 행위)에 대한 그린휠의 소유 재산이라는 사실을 주장, 입증하여야 함은 물론 이러한 사태가 발생할 경우 즉시 그린휠에게 통지하고 그린휠의 조치에 따라야 한다.</p>
					</td>
				</tr>
			</table>
			<button class="btn blueBtn">다운로드</button>
		</div><!--contract-->
	</div><!--w100-->
</div><!--content-->

<script type="text/javascript">
		$(".blueBtn").on("click", function() {
			var $table = $("table").clone();

			$table.find("th:not(.none)").css("background", "#dfdfdf");
			$table.find("th").removeAttr("class");
			$table.find("td").removeAttr("class");

			location.href = "/member/down?table="+encodeURI($table[0].outerHTML);
		})
</script>
</body>
</html>