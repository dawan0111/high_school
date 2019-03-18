            <div class="content login">
    	<div class="wrap">
        	<div class="login_box">
                <h3>	회원가입</h3>
                <form action="/member/postJoin" method="post" enctype="multipart/form-data">
                    <input type="text" placeholder="아이디 (조건 : 영문 + 숫자)" name="id" class="input_box">
                    <input type="password" placeholder="비밀번호 (조건 : 8글자 이상)" name="pw" class="input_box">
                    <input type="text" placeholder="이름 (조건 : 한글 또는 영문)" name="name" class="input_box">
                    <input type="text" placeholder="전화번호 (조건 : 숫자만)" name="phone" class="input_box">
                    <div class="input_box">
                        <span class="radio_box">
                        	<input type="radio" placeholder="판매회원" name="type" checked value="판매자">판매 회원
						</span>
                        <span class="radio_box">
                            <input type="radio" placeholder="판매회원" name="type" value="구매자">구매 회원
						</span>
                    </div>
                    <input type="submit" value="약관 동의 및 회원가입" class="submit">
                </form>
            </div>
        </div>
    </div>
    	 
        
    <div class="copy">
        <div class="wrap">
            Copyright &copy; 2018 노트닷컴 All Right Reserved.
        </div>
    </div>
    
</body>
</html>