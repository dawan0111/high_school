
<!-- contents-start -->
<div id="contents" class="container">
	<div class="row">
		<!-- contentsInner -->
		<div class="col-md-12 col-sm-12 col-xs-12 contentsInner">
			<div class="titleBar">
				<span>
					회원가입
				</span>
			</div>
			
			<!-- contentsBox -->
			<div class="contentsBox">
				
				<!-- joinForm -->
				<div id="join">
					<form action="member/join" method="post">
						<div class="form-group">
							<label for="id">아이디</label>
							<input type="text" id="id" name="id" class="form-control" placeholder="아이디">
						</div>
						<div class="form-group">
							<label for="password">비밀번호</label>
							<input type="password" id="password" name="pw" class="form-control" placeholder="비밀번호">
						</div>
						<div class="form-group">
							<label for="name">성명/기업명</label>
							<input type="text" id="name" name="name" class="form-control" placeholder="성명/기업명">
						</div>
						<div class="form-group">
							<label for="group">회원그룹</label>
							<select class="form-control" id="group" name="type">
								<option value="">--선택--</option>
								<option value="일반회원">일반회원</option>
								<option value="기업회원">기업회원</option>
							</select>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">회원가입</button>
							<button type="reset" class="btn btn-primary">다시작성하기</button>
						</div>
					</form>
				</div>

			</div>

		</div>
	</div>
</div>
