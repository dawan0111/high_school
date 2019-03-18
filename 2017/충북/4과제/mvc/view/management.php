
<!-- contents-start -->
<div id="contents" class="container">
	<div class="row">
		<!-- contentsInner -->
		<div class="col-md-12 col-sm-12 col-xs-12 contentsInner">
			<div class="titleBar">
				<span>
					Booth관리
				</span>
			</div>
			
			<!-- contentsBox -->
			<div class="contentsBox">
				
				<div class="col-md-12 col-sm-12 col-xs-12">
					<?php if($_SESSION['id'] == 'admin') { ?>
						<form action="page/management" method="get">
							<select name="id" onchange=" this.form.submit() ">
								<option value="all">전체보기</option>
								<?php foreach($company as $key => $value) { ?>
									<option value="<?php echo $value['name'] ?>" <?php echo $selected == $value['name'] ? "selected" : "" ?>>
										<?php echo $value['name'] ?>
									</option>
								<?php } ?>
							</select>
						</form>
					<?php } ?>
					<?php foreach($booth as $key => $value) { ?>
						<table class="table boothTable">
							<thead>
								<tr>
									<th>
										부스번호 : <?php echo $value['booth'] ?>&nbsp;&nbsp;/&nbsp;&nbsp;
										등록기간 : <?php echo $value['startdate'] ?> ~<?php echo $value['enddate'] ?>
									</th>
									<td class="text-right">
										<button type="button" class="btn btn-default btn-sm" onclick="window.location='page/management_w/<?php echo $value['idx'] ?>'">
											박람회등록
										</button>
									</td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td colspan="2">
										<table class="table boothTable-innner">
											<thead>
												<tr>
													<th>사진</th>
													<th>Booth명</th>
													<th>개최기간</th>
													<th>1일예약가능인원</th>
													<th>설명</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($value['festival'] as $idx => $festival) { ?>
													<tr>
														<td class="col-md-2 col-sm-2 col-xs-2">
															<img src="/upload/<?php echo $festival['image'] ?>" alt="sample" style="width: 100%;">
														</td>
														<td class="col-md-2 col-sm-2 col-xs-2">
															<?php echo $festival['name'] ?>
														</td>
														<td class="col-md-3 col-sm-3 col-xs-3">
															<?php echo $festival['startdate'] ?> ~ 
															<?php echo $festival['startdate'] ?>
														</td>
														<td class="col-md-2 col-sm-2 col-xs-2">
															<?php echo $festival['max_people'] ?>명
														</td>
														<td>
															<?php echo $festival['intro'] ?>
														</td>
													</tr>
												<?php } ?>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
					<?php } ?>
				</div>

			</div>

		</div>
	</div>
</div>
