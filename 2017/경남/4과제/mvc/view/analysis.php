	<div id="analysis">
		<p class="title"><span class="glyphicon glyphicon-stats"></span>데이터 분석</p>
		<p><?php echo date("Y년  m월 d일"); ?> 기준 &nbsp; 총 판매금액 : <?php echo $total ?>원 </p>
		<div>
			<div class="form-group col-sm-3 col-sm-offset-6">
				<select class="form-control sex">
					<option value="all">성별 전체</option>
					<option value="male">남자</option>
					<option value="female">여자</option>
				</select>
			</div>
			<div class="form-group col-sm-3">
				<select class="form-control age">
					<option value="all">나이 전체</option>
					<option value="10">10대</option>
					<option value="20">20대</option>
					<option value="30">30대</option>
					<option value="40">40대</option>
					<option value="50">50대</option>
					<option value="60">60대</option>
					<option value="70">70대</option>
					<option value="80">80대</option>
					<option value="90">90대</option>
				</select>
			</div>
		</div>
		<div id="analyser" style="position: relative;">
		</div>
	</div>

	<script>
		window.dd = console.log.bind(console);

		$(function() {
			getData();

			$(".form-control").on({
				change : function() {
					getData();
				}
			})
		});

		function getData() {
			var sex = $(".sex option:selected").val();
			var age = $(".age option:selected").val();

			$.ajax({
				url : "/buy/getGraph",
				data : {	
					sex : sex,
					age : age,
				},
				type : "POST",
				success : function(e) {
					$(analyser).html("");

					var datas = JSON.parse(e);

					$.each(datas, function(idx, data) {
						var $span = $("<span></span>", {
							css : {
								fontSize : data.fontsize+"px",
								left : data.left+"px",
								top : data.top+"px",
								opacity : data.opacity,
							},
							html : data.text,
						});

						$("#analyser").append($span);
					});
				},
			})
		}
	</script>
</body>
</html>