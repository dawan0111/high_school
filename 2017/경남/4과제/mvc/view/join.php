	<div id="join"> 
		<p class="title"><span class="glyphicon glyphicon-user"></span>JOIN</p>
		<form class="form-horizontal" method="post" action="/member/joinAction">
			<div class="form-group">
				<label for="id" class="col-sm-2 control-label">아이디</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="id" name="id" placeholder="아이디">
				</div>
			</div>
			<div class="form-group">
				<label for="pw" class="col-sm-2 control-label">비밀번호</label>
				<div class="col-sm-10">
					<input type="password" class="form-control" id="pw" name="pw" placeholder="비밀번호">
				</div>
			</div>
			<div class="form-group">
				<label for="repw" class="col-sm-2 control-label">확인 비밀번호</label>
				<div class="col-sm-10">
					<input type="password" class="form-control" id="repw" name="repw" placeholder="비밀번호 재입력">
				</div>
			</div>
			<div class="form-group">
				<label for="name" class="col-sm-2 control-label">이름</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="name" name="name" placeholder="이름">
				</div>
			</div>
			<div class="form-group">
				<label for="age" class="col-sm-2 control-label">나이</label>
				<div class="col-sm-10">
					<select class="form-control" name="age">
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
			<div class="form-group">
				<label for="gender" class="col-sm-2 control-label">성별</label>
				<div class="col-sm-10">
					<select class="form-control" name="gender">
						<option value="male">남성</option>
						<option value="female">여성</option>
					</select>
				</div>
			</div>
		<div class="buttons">
			<button type="reset" class="btn btn-defalut cancel">취소</button>
			<button class="btn btn-primary ok">회원가입</button>
		</div>
		</form>
	</div>
</body>
</html>