        <div class="content login">
        	<div class="wrap">
            	<div class="login_box">
                    <h3>상품 등록</h3>
                    <form action="/notebook/postAdd" method="post" enctype="multipart/form-data">
                        <input type="text" placeholder="상품명" name="name" class="input_box">
                        <input type="file" placeholder="상품이미지" name="file" class="input_box">
                        <input type="text" placeholder="상품코드" name="code" class="input_box">
                        <input type="number" placeholder="판매가" name="price" class="input_box">
                        <input type="number" placeholder="포인트" name="point" class="input_box">
                        <input type="number" placeholder="배송비" name="carry" class="input_box">
                        <input type="text" placeholder="태그 (,로 구분)" name="tag" class="input_box">
                        <input type="text" placeholder="제조사" name="company" class="input_box">
                        <input type="submit" value="등록" class="submit">
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