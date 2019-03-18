	<div id="content">
	<div class="w100">
		<div class="reserv">
			<h1 class="title">예약하기</h1>
			<div class="col-md-4">
				<img src="/images/<?php echo $product["image"] ?>" alt="image" title="image">
			</div>
			
			<div class="col-md-8 choose">
				<form action="/product/postRes/<?php echo $product['idx'] ?>" method="post">
					<?php if (!in_array($product["category"], ["전기자전거", "미니전기자동차", "전기스쿠터"])): ?>
						<div class="date">
							<h3>기간</h3>
							<input type="text" id="start" placeholder="대여일" name="s_time" data-dont="<?php echo join(",", $use_list) ?>" readonly>
							
							<input type="text" id="end" placeholder="반납일" name="e_time" data-dont="<?php echo join(",", $use_list) ?>" readonly>
						</div><!--date-->
					<?php else: ?>
						<div class="time">
							<h3>시간</h3>
							<select name="s_time" id="s_time">
								<option disabled selected value="">대여시간</option>
								<?php for ($i=date("H", stt("now") + 3600); $i <= 23; $i++) {  ?>
									<?php $date = sprintf("%02d", $i).":00"; ?>
									<option <?php echo in_array($date, $use_list) ? "disabled" : ""; ?>><?php echo $date ?></option>
								<?php } ?>
							</select>
							<select name="e_time" id="e_time">
								<option disabled selected value="">반납시간</option>
								<?php for ($i=date("H", stt("now") + 7200); $i <= 24; $i++) {  ?>
									<?php $date = sprintf("%02d", $i).":00"; ?>
									<option <?php echo in_array($date, $use_list) ? "disabled" : ""; ?>><?php echo $date ?></option>
								<?php } ?>
							</select>
						</div><!--time-->
					<?php endif ?>
					<div class="place">
						<h3>지점</h3>
						<select name="s_place" id="s_place">
							<option disabled selected value="">대여지점</option>
							<option>여수시</option>
							<option>순천시</option>
							<option>목포시</option>
							<option>담양군</option>
							<option>보성군</option>
							<option>완도군</option>
							<option>해남군</option>
							<option>구례군</option>
						</select>
						<select name="e_place" id="e_place">
							<option disabled selected value="">반납지점</option>
							<option>여수시</option>
							<option>순천시</option>
							<option>목포시</option>
							<option>담양군</option>
							<option>보성군</option>
							<option>완도군</option>
							<option>해남군</option>
							<option>구례군</option>
						</select>
					</div><!--place-->
					
					<button class="btn blueBtn">결제하기</button>
				</form>
			</div><!--choose-->
		</div><!--reserv-->
	</div><!--w100-->
</div><!--content-->
<script type="text/javascript">
	
</script>
</body>
</html>