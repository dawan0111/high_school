	<div id="member">
		<div class="btn">
			<a href="/member/login">로그인</a>
			<a href="/member/join" class="on">회원가입</a>
		</div>
		<form class="form" method="post" action="/member/postJoin">
			<input type="text" name="name" placeholder="Name *">
			<input type="text" name="id" placeholder="ID ( E-Mail ) *">
			<input type="password" name="pw" placeholder="Password *">
			<input type="password" name="re_pw" placeholder="Password Check *">
			<input type="text" name="phone" placeholder="Phone Number">
			<input type="text" name="address" placeholder="Address">
			<input type="submit" value="회원가입">
		</form>
	</div>

</body>
</html>