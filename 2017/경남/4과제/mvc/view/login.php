	<div id="login"> 
		<p class="title"><span class="glyphicon glyphicon-off"></span>LOGIN</p>
		<form class="form-horizontal" method="post" action="/member/loginAction">
			<div class="inputs">
				<div class="form-group">
					<label for="id" class="col-sm-3 control-label">아이디</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="id" name="id" placeholder="아이디" required>
					</div>
				</div>
				<div class="form-group">
					<label for="id" class="col-sm-3 control-label">비밀번호</label>
					<div class="col-sm-9">
						<input type="password" class="form-control" id="pw" name="pw" placeholder="비밀번호" required>
					</div>
				</div>
			</div>
			<button class="btn btn-primary">LOGIN</button>
		</form>
	</div>
</body>
</html>