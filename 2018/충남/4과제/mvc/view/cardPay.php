<div id="content">
<div class="w100">
	<div class="card">			
		<h1 class="title">결제 페이지</h1>
		<form action="/product/buy/<?php echo $product['idx'] ?>" method="post">
			<?php
				$sTime = new DateTime($product["s_time"]);
				$eTime = new DateTime($product["e_time"]);
				$diff = date_diff($sTime, $eTime);

				if(small($product["category"])) {
					$diffs = $diff->h + 1;
				} else {
					$diffs = $diff->d + 1;
				};
			?>
			<ul class="info">
				<li>
					<label>품목명 :</label>
					<span><?php echo $product["name"] ?></span>
				</li>
				<li>
					<label>렌탈일(시간) :</label>
					<span>
						<?php echo $product["s_time"]." ~ ".$product["e_time"] ?>
					</span>
				</li>
				<li>
					<label>렌탈/반납지점</label>
					<span><?php echo $product["start"] ?>/<?php echo $product["end"] ?></span>
				</li>
				<li>
					<label>품목금액 :</label>
					<span><?php echo don($product["price"] * $diffs) ?></span> 원
				</li>
				<li>
					<label>할인/할증금액 :</label>
					<span> <?php echo don($daySale = daySale($product)) ?></span> 원
				</li>
				<li>
					<label>결제금액 :</label>
					<span>= <?php echo don($total = $product["price"] * $diffs + $daySale) ?></span> 원
				</li>
				<li>
					<label>회원 할인금액 :</label>
					<span>- <?php echo don($mSale = mSale($total, $login["level"])) ?></span> 원
				</li>
				<li>
					<label>총 결제금액 :</label>
					<h2>= <?php echo don($total - $mSale) ?></h2> 원
				</li>
			</ul>

			<input type="text" name="price" value="<?php echo $total - $mSale ?>" hidden>

			<div class="pay">
				<ul class="row tabs">
					<li class="col-md-6 active" data-for="type1"><a href="#cardpay" data-toggle="tab" class="col-md-12 blueBtn">카드결제</a></li>
					<li class="col-md-6" data-for="type2"><a for="type2" href="#cashpay" data-toggle="tab" class="check col-md-12">무통장입금</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="cardpay">
						<ul class="cardPay">
							<li>
								<label>카드선택 :</label>
								<input type="radio" name="bank" value="농협"><span>농협</span>
								<input type="radio" name="bank" value="하나"><span>하나</span>
								<input type="radio" name="bank" value="신한"><span>신한</span>
								<input type="radio" name="bank" value="국민"><span>국민</span>
								<input type="radio" name="bank" value="우리"><span>우리</span>
							</li>
							<li>
								<label>카드번호 :</label>
								<input type="text" maxlength="16" name="cardNum" size="30" id="cardNum">
								<span class="ex">카드번호 16자리</span>
							</li>
						</ul>
					</div><!--cardpay-->
					
					<div role="tabpanel" class="tab-pane" id="cashpay">
						<ul class="cashPay">
							<li>
								<label>입금은행 : </label>
								<select name="no_bank" id="bank">
									<option disabled selected>::은행선택::</option>
									<option>우리은행 : 9876-6543-6543-7890</option>
									<option>기업은행 : 3210-6549-1234</option>
									<option>농협 : 1234-7891-9876</option>
									<option>신한은행 : 6543-9876-7412</option>
								</select>
							</li>
							<li>
								<label>송금자명 : </label>
								<input type="text" name="send_name">
							</li>
							<li>
								<label>전화번호 : </label>
								<input type="text" maxlength="11" name="phone" size="30" id="phone">
							</li>
						</ul>
					</div><!--cashpay-->
				</div><!--tab-content-->
			</div><!--pay-->
			<input type="radio" name="type" id="type1" value="card" checked hidden>
			<input type="radio" name="type" id="type2" value="bank" hidden>

			<button class="btn blueBtn payment">결제하기</button>
		</form>
	</div><!--card-->

	<script type="text/javascript">
		$("li[data-for]").on("click", function() {
			var type = $(this).data("for");
			$("#"+type).prop("checked", true);
		});
	</script>
</div><!--w100-->
</div><!--content-->
</body>
</html>