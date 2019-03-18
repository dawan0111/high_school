
<!-- contents-start -->
<div id="contents" class="container">
	<div class="row">
		<!-- contentsInner -->
		<div class="col-md-12 col-sm-12 col-xs-12 contentsInner">
			<div class="titleBar">
				<span>
					박람회 상세보기
				</span>
			</div>
		
			<!-- contentsBox -->
			<div class="contentsBox">
				
				<div id="exerciseView">
					<table class="table table-bordered">
						<tr>
							<th>
								박람회사진
							</th>
							<td>
								<img src="upload/<?php echo $festival['image'] ?>" alt="sample" style="width:400px">
							</td>
						</tr>
						<tr>
							<th>
								박람회명
							</th>
							<td>
								<?php echo $festival['name'] ?>
							</td>
						</tr>
						<tr>
							<th>
								Booth번호
							</th>
							<td>
								<?php echo $booth['booth'] ?>
							</td>
						</tr>
						<tr>
							<th>
								개최기간
							</th>
							<td>
								<?php echo $festival['startdateformat'] ?> ~ <?php echo $festival['enddateformat'] ?>
							</td>
						</tr>
						<tr>
							<th>
								설명
							</th>
							<td>
								<?php echo $festival['intro'] ?>
							</td>
						</tr>
					</table>
					<div class="pan">
						<div class="calenderPosition">
							<span class="prev"><button>&lt;</button></span>
							<h2 class="year" 
								data-type="<?php echo date("Y.n", strtotime($festival['startdate'])) ?>"
								data-startdate="<?php echo date("Y.n.d", strtotime($festival['startdate'])) ?>"
								data-enddate="<?php echo date("Y.n.d", strtotime($festival['enddate']))?>"
								data-maxpeople="<?php echo $festival['max_people'] ?>"
								data-idx="<?php echo $festival['idx'] ?>"
							><?php echo date("Y.m", strtotime($festival['startdate'])) ?></h2>
							<span class="next"><button>&gt;</button></span>
						</div>
						<table class="table calender table-bordered">
							<thead>
								<tr>
									<th>일</th>
									<th>월</th>
									<th>화</th>
									<th>수</th>
									<th>목</th>
									<th>금</th>
									<th>토</th>
								</tr>
							</thead>
							<tbody class="dayday">
							</tbody>
						</table>
					</div>
				</div>

			</div>

		</div>
	</div>
</div>

<script>

	var year = 0;
	var month = 0;

	function dataLoad()
	{
		$.ajax({
			url:"calender/get",
			data:{
				date:$(".year").data("type"),
				enddate:$(".year").data('enddate'),
				startdate:$(".year").data('startdate'),
				maxPeople:$(".year").data("maxpeople"),
				idx:$(".year").data('idx'),
			},
			type:"post",
			success:function(e) {
				
				var data = JSON.parse(e);

				$(".dayday").html(data.calender);

				$(".dayday input").on("input", function() {

					if($(this).val() <= 0) {
						$(this).val(1);
					}
				})
				year = data.year;
				month = data.month;
			}
		})
	}

	dataLoad();

	function changeDate()
	{
		if(month == 13) {
			year++;
			month = 1;
		}

		if(month == 0) {
			year--;
			month = 12;
		}

		$(".year").data("type", year+"."+month);

		$(".year").html(year+"."+zero(month));
		dataLoad();
	}

	function zero(month)
	{
		return month < 10 ? "0"+month : month;
	}

	$(".next").on("click", function() {
		month++;
		changeDate();
	})
	$(".prev").on("click", function() {
		month--;
		changeDate();
	})

</script>

<style>
	button {
		border:none;
		background:none;
	}
	.calenderPosition {
		display: flex;
		justify-content: center;
		align-items: center;
	}
	.calenderPosition h2 {
		font-weight: bold;
		font-size: 48px;
		display: block;
		margin: 0 30px;
	}
	.calenderPosition span {
		font-size: 60px;
		font-weight: bold;
	}
	.calender {
		margin-top: 20px;
	}
	.calender th {
		width: calc(100% / 7) !important;
		background:#555;
		color: #fff;
	}
	.dayday td {
		height: 140px;
		padding-left: 10px !important;
		padding-top: 10px !important;
		position: relative;
	}
	.dayday tr td > div {
		color: #000 !important;
	}
	.dayday tr td:first-child {
		color: red;
	}
	.dayday tr td:last-child {
		color: blue;
	}
	.dayday td:hover {
		background:rgba(0, 0, 0, 0.02);
	}
	.max {
		font-size: 12px;
		position: absolute;
		right: 5px;
		bottom: 5px;
	}
	.button {
		position: absolute;
		right: 5px;
		bottom: 30px;
		width: 70px;
		height:30px;
		border:none;
		background:#333;
		color: #fff !important;
		font-size: 12px;
	}
	.dayday input {
		color: #000 !important;
		margin-top: 10px;
	}
</style>
