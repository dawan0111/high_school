
<!-- contents-start -->
<div id="contents" class="container">
	<div class="row">
		<!-- contentsInner -->
		<div class="col-md-12 col-sm-12 col-xs-12 contentsInner">
			<div class="titleBar">
				<span>
					내 예약정보
				</span>
			</div>
			
			<!-- contentsBox -->
			<div class="contentsBox">
				
				<table class="table restable">
					<thead class="resthead">
						<tr>
							<th>박람회명</th>
							<th>기업명</th>
							<th>Booth번호</th>
							<th>예약일자</th>
							<th>예약인원</th>
							<th>예약취소/인쇄</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($res as $key => $value) { ?>
							<tr class="res<?php echo $key ?>">
								<td><?php echo $value['festival']['name'] ?></td>
								<td><?php echo $value['booth']['id'] ?></td>
								<td><?php echo $value['booth']['booth'] ?></td>
								<td><?php echo $value['day'] ?></td>
								<td><?php echo $value['people'] ?>명</td>
								<td>
									<button type="button" class="btn btn-default btn-sm" onclick="location.href='userres/cancle/<?php echo $value['idx'] ?>'">예약취소</button>
									<button type="button" class="btn btn-default btn-sm" onclick="printSetting( this )" data-class='<?php echo "res".$key ?>'>인쇄</button>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>

			</div>

		</div>
	</div>
</div>

<script>
	function printSetting( is )
	{
		var list = document.getElementsByClassName($(is).data("class"));
		var originalContents = document.body.innerHTML;

		var html = "<table class='table'>";
				html += $(".resthead").html();
				html += "<tbody>";
					html += $(list).html();
				html += "</tbody>";
			html += "</table>";

			document.body.innerHTML = html;
			window.print();
			document.body.innerHTML = originalContents;
	}
</script>