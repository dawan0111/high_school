<div id="content">
	<div class="w100">
		<div class="cart">
			<div class="search form-inline">
				<form method="get">
					<label>품목구분</label>
					<select class="form-control" name="category" id="category">
						<option data-category="자전거" <?php echo $category == "전기자전거" ? "selected" : "" ?>>전기자전거</option>
						<option data-category="자전거" <?php echo $category == "미니전기자동차" ? "selected" : "" ?>>미니전기자동차</option>
						<option data-category="자전거" <?php echo $category == "전기스쿠터" ? "selected" : "" ?>>전기스쿠터</option>
						<option data-category="자동차" <?php echo $category == "전기자동차" ? "selected" : "" ?>>전기자동차</option>
						<option data-category="자동차" <?php echo $category == "장거리전기자동차" ? "selected" : "" ?>>장거리전기자동차</option>
					</select>
					<label>대여지점</label>
						<select name="start" id="placeS" class="place" required>
								<option disabled selected>대여지점</option>
								<?php foreach ($places as $key => $place): ?>
									<option value="<?php echo $place ?>" <?php echo $place == $start ? "selected" : "" ?>><?php echo $place ?></option>
								<?php endforeach ?>
							</select>
							<label>반납지점</label>
							<select name="end" id="placeE" class="place" required>
								<option disabled selected>반납지점</option>
								<?php foreach ($places as $key => $place): ?>
									<option value="<?php echo $place ?>" <?php echo $place == $end ? "selected" : "" ?>><?php echo $place ?></option>
								<?php endforeach ?>
							</select>
					<div class="form-group div-category" data-category="자동차" style="display: none;">
						<label>대여가능일</label>
						<input type="text" id="start" name="s_date" class="form-control" readonly value="<?php echo $s_date ?>" required>
						<label>반납가능일</label>
						<input type="text" id="end" name="e_date" class="form-control" readonly value="<?php echo $e_date ?>" required>
					</div>
					<div class="form-group div-category" data-category="자전거">
						<label>대여가능시간</label>
						<select class="Rtime form-control" name="s_time" required>
							<option disabled selected>대여시간</option>
							<?php for ($i=date("H", stt("now") + 3600); $i <= 23; $i++) {  ?>
								<?php $date = sprintf("%02d", $i).":00"; ?>
								<option <?php echo $date == $s_time ? "selected" : ""; ?>><?php echo $date ?></option>
							<?php } ?>
						</select>
						<label>반납가능시간</label>
						<select class="Rtime form-control" name="e_time" required>
							<option disabled selected>반납시간</option>
							<?php for ($i=date("H", stt("now") + 7200); $i <= 24; $i++) {  ?>
								<?php $date = sprintf("%02d", $i).":00"; ?>
								<option <?php echo $date == $e_time ? "selected" : ""; ?>><?php echo $date ?></option>
							<?php } ?>
						</select>
					</div>
					<button class="btn greenBtn">검색</button>
				</form>
			</div>
			
			<div class="cartList">
				<ul class="col-md-12">
					<?php foreach ($products as $key => $product): ?>
						<li class="col-md-6">
							<div>
								<img src="/images/<?php echo $product['image'] ?>" alt="image">
								<p><span>품목명 : </span><?php echo $product["name"] ?></p>
								<p><span>가격 : </span><?php echo don($product["price"]) ?>원</p>
								<p><span>주행거리 : </span><?php echo $product["distance"] ?>km</p>
								<p><span>최고속도 : </span><?php echo $product["speed"] ?>km/h</p>
								<p><span>대여가능 수량 : </span><?php echo $product["use_quantity"] ?> / <?php echo $product["quantity"] ?>대</p>
								<?php if ($product["use_quantity"] != 0 && (isset($_GET["category"]) && $start != "" && $end != "")): ?>
									<button class="btn blueBtn" onclick="location.href='/product/add/<?php echo $product['idx'] ?>?back=<?php echo urlencode($_SERVER["REQUEST_URI"]) ?>'">추가하기</button>
								<?php endif ?>
							</div>
						</li>
					<?php endforeach ?>
				</ul>
				
				<span class="line">&nbsp;</span>
				
				<div class="baskets">
					<form method="post" action="/product/multiple" id="multiForm">
						<h1 class="title">장바구니</h1>
						<table>
							<tr>
								<th><input type="checkbox" class="parent"></th>
								<th>품목 이미지</th>
								<th>품목명</th>
								<th>대여일(시간)~반납일(시간)</th>
								<th>품목금액</th>
								<th>할인/할증금</th>
								<th>렌탈금액</th>
								<th>렌탈/반납지점</th>
								<th>상세</th>
							</tr>
							<?php foreach ($items as $key => $item): ?>
								<?php
									$sTime = new DateTime($item["s_time"]);
									$eTime = new DateTime($item["e_time"]);
									$diff = date_diff($sTime, $eTime);

									if(small($item["product"]["category"])) {
										$diffs = $diff->h + 1;
									} else {
										$diffs = $diff->d + 1;
									};

									$total = $item["product"]["price"] * $diffs;
									$dSale = daySale($item["product"], $item["s_time"], $item["e_time"]);

									$real_price = $total + $dSale;
								?>
								<tr>
									<td><input type="checkbox" class="price-input" name="idx[]" value="<?php echo $key ?>" data-price="<?php echo $real_price ?>"></td>
									<td><img src="/images/<?php echo $item["product"]["image"] ?>" alt="image"></td>
									<td><?php echo $item["product"]["name"] ?></td>
									<td><?php echo date("Y-m-d H:i", stt($item["s_time"])) ?> ~ <?php echo date("Y-m-d H:i", stt($item["e_time"])) ?></td>
									<td><?php echo don($total) ?>원</td>
									<td><?php echo don($dSale) ?>원</td>
									<td>= <?php echo don($real_price) ?>원</td>
									<td><?php echo $item["start"]."/".$item["end"] ?></td>
									<td><a href="/product/delete/<?php echo $key ?>?back=<?php echo urlencode($_SERVER["REQUEST_URI"]) ?>" class="btn blueBtn">삭제하기</a></td>
								</tr>
							<?php endforeach ?>
						</table>
						<div class="total">
							<p>총 렌탈가격 <span class="blue p">= 0 원</span> </p>
							<button class="btn blueBtn" style="margin-left: 67px;">결제하기</button>
						</div>
					</form>
				</div>
				
			</div>
			
		</div>
	</div><!--w100-->
</div><!--content-->

	<script type="text/javascript">

		$("#multiForm").on({
			submit : function() {
				if($(".price-input:checked").length == 0) {
					alert("체크박스를 하나이상 선택해주세요.");
					return false;
				};
			},
		});

		setTimeout(function() {
			$("#category").trigger("change");
		}, 10);

		$(".price-input").on({
			change : function() {
				totalChange();
			},
		});

		function totalChange() {
			var total = 0;

			$(".price-input").each(function(idx, el) {
				if($(el).is(":checked"))
					total += $(el).data("price");
			});

			$(".p").html("= "+total.toLocaleString()+" 원");
		};

		$(".parent").on({
			change : function() {
				$(".price-input").prop("checked", $(this).is(":checked"));
				totalChange();
			},
		})
	</script>
</body>
</html>