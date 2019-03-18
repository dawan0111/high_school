
<!-- contents-start -->
<div id="contents" class="container">
	<div class="row">
		<!-- contentsInner -->
		<div class="col-md-12 col-sm-12 col-xs-12 contentsInner">
			<div class="titleBar">
				<span>
					제주여행박람회
				</span>
			</div>
			
			<!-- contentsBox -->
			<div class="contentsBox row">
				<?php foreach($booth as $key => $value) { ?>
					<?php foreach($value['festival'] as $k => $festival) { ?>
						<div id="exerciseBox">
							<a href="page/reservation_w/<?php echo $festival['idx'] ?>" title="상세보기">
								<img src="upload/<?php echo $festival['image'] ?>" alt="sample" style="width: 100%;">
								<ul>
									<li><?php echo $festival['name'] ?></li>
									<li><?php echo $value['id'] ?></li>
									<li><?php echo $value['booth'] ?></li>
									<li><?php echo $festival['startdate'] ?> ~ <?php echo $festival['enddate'] ?></li>
								</ul>
								<p class="text-center">
									<?php echo stringCut($festival['intro']) ?>
								</p>
							</a>
						</div>
					<?php } ?>
				<?php } ?>
			</div>

		</div>
	</div>
</div>
