        <div class="content login">
        	<div class="wrap">
                <div class="login_box">
                    <h3>    상품 수정</h3>
                    <form action="/notebook/postModify" method="post" enctype="multipart/form-data">
                        <select id="select" name="idx">
                            <option value="" selected disabled>상품을 선택해주세요.</option>
                            <?php foreach ($notebooks as $key => $notebook): ?>
                                <option value="<?php echo $notebook['idx'] ?>"><?php echo $notebook["name"] ?></option>
                            <?php endforeach ?>
                            <option></option>
                        </select>
                        <input type="text" placeholder="상품명" name="name" class="input_box">
                        <input type="file" placeholder="상품이미지" name="file" class="input_box">
                        <input type="text" placeholder="상품코드" name="code" class="input_box">
                        <input type="number" placeholder="판매가" name="price" class="input_box">
                        <input type="number" placeholder="포인트" name="point" class="input_box">
                        <input type="number" placeholder="포인트" name="carry" class="input_box">
                        <input type="text" placeholder="태그 (,로 구분)" name="tag" class="input_box">
                        <input type="text" placeholder="제조사" name="company" class="input_box">
                        <input type="submit" value="수정" class="submit" name="modify">
                        <input type="submit" value="삭제" class="submit" name="delete">
                    </form>
                </div>
            </div>
        </div>
        	 
            
        <div class="copy">
            <div class="wrap">
                Copyright &copy; 2018 노트닷컴 All Right Reserved.
            </div>
        </div>
        
        <script type="text/javascript">
            $("#select").on({
                change () {
                    var idx = $(this).find("option:selected").val();

                    $.ajax({
                        url : "/notebook/getData",
                        data : { idx : idx },
                        type : "POST",
                        success (data) {
                            data = JSON.parse(data);

                            console.log(data);
                            $.each(data, (name, val) => {
                                if(name == "real_price")
                                    name = "price";

                                if(name == "image")
                                    return true;

                                $("input[name="+name+"]").val(val);
                            });
                        },
                    });
                },
            });
        </script>
    </body>
</html>