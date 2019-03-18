

<!-- contents-start -->
<div id="contents" class="container">
	<div class="row">
		<!-- contentsInner -->
		<div class="col-md-12 col-sm-12 col-xs-12 contentsInner">
			<div class="titleBar">
				<span>
					박람회등록
				</span>
			</div>
			
			<!-- contentsBox -->
			<div class="contentsBox">
				
				<!-- expoWrite -->
				<div id="expo">
					<form action="festival/add/<?php echo $boothidx ?>" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="expoName">박람회명</label>
							<input type="text" id="expoName" name="name" class="form-control" required placeholder="박람회명">
						</div>
						<div class="form-group">
							<label for="start">개최기간</label>
							<input type="text" id="start" name="startdate" class="form-control" required placeholder="시작일">
							<input type="text" id="end" name="enddate" class="form-control" required placeholder="종료일">
						</div>
						<div class="form-group">
							<label for="available">1일예약가능인원</label>
							<input type="number" id="available" name="max_people" required class="form-control" placeholder="1일예약가능인원">
						</div>
						<div class="form-group">
							<label for="description">설명</label>
							<textarea id="description" name="intro" required class="form-control"></textarea>
						</div>
						<div class="form-group">
							<label for="picture">사진</label>
							<input type="file" id="picture" name="image" class="form-control">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">박람회등록</button>
							<button type="reset" class="btn btn-primary">다시작성하기</button>
						</div>
					</form>
				</div>

			</div>

		</div>
	</div>
</div>
