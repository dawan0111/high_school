        <div class="content">
        	<div class="wrap">
            	<div class="item_list item_detail">
                    <div class="ww list">
                    
                    	<div class="first">
                        	<div class="img">
                            	<img src="./data/img1.jpg" alt="">
                            </div>
                        	<div class="text">
                            	<p class="title"><a href="price_list.html">에이수스 - GE73-8RF</a> <span>가격비교</span></p>
                                <p class="price">최저가 200,000</p>
                                <p class="tag">
                                	<span>CPU intel I7</span>
                                    <span>RAM 8G</span>
                                    <span>ROM 1TB</span>
                                    <span>코어 쿼드</span>
                                    <span>멋진 노트북</span>
                                    <span>인치 19</span>
                                </p>
                            </div>    
                        </div>        
                        
                        <div class="check">
                        	<span><input type="checkbox" id="point"> 포인트</span>
                        	<span><input type="checkbox" id="carry"> 배송비</span>
                        </div>
                        <div class="price_list etcs">
                        	<div class="bold">
                            	<div class="seller">판매자</div>
                                <div class="title">제목</div>
                                <div class="price">가격</div>
                                <div class="point">포인트</div>
                                <div class="post">택배비</div>
                            </div>
                        	<div>
                            	<div class="seller">판매자1</div>
                                <div class="title"><a href="product.html">재고보유/특가195만/에이수스 GE73-8RF Raider</a></div>
                                <div class="price">\ 200,000</div>
                                <div class="point">3000 p</div>
                                <div class="post">2500</div>
                            </div>
                        	<div>
                            	<div class="seller">판매자1</div>
                                <div class="title"><a href="product.html">재고보유/특가195만/에이수스 GE73-8RF Raider</a></div>
                                <div class="price">\ 200,000</div>
                                <div class="point">3000 p</div>
                                <div class="post">2500</div>
                            </div>
                        	<div>
                            	<div class="seller">판매자1</div>
                                <div class="title"><a href="product.html">재고보유/특가195만/에이수스 GE73-8RF Raider</a></div>
                                <div class="price">\ 200,000</div>
                                <div class="point">3000 p</div>
                                <div class="post">2500</div>
                            </div>
                        	<div>
                            	<div class="seller">판매자1</div>
                                <div class="title"><a href="product.html">재고보유/특가195만/에이수스 GE73-8RF Raider</a></div>
                                <div class="price">\ 200,000</div>
                                <div class="point">3000 p</div>
                                <div class="post">2500</div>
                            </div>
                        	<div>
                            	<div class="seller">판매자1</div>
                                <div class="title"><a href="product.html">재고보유/특가195만/에이수스 GE73-8RF Raider</a></div>	
                                <div class="price">\ 200,000</div>
                                <div class="point">3000 p</div>
                                <div class="post">2500</div>
                            </div>
                        </div>                             
                    </div>
                </div>
            </div>
        </div>	 
            
        <div class="copy">
            <div class="wrap">
                Copyright &copy; 2018 노트닷컴 All Right Reserved.
            </div>
        </div>
        
        <script type="text/javascript">
            search();
            var first = true;
            function search() {
                var data = {
                    point : $("#point:checked").length,
                    carry : $("#carry:checked").length,
                    code : "<?php echo $_GET['code'] ?>",
                };

                console.log(data);

                $.ajax({
                    url : "/notebook/compareList",
                    data : data,
                    type : "POST",
                    success (data) {
                        data = JSON.parse(data);

                        $(".etcs").html("");

                        $.each(data, function(idx, val) {
                            if(
                                (first && idx == 0 )||
                                (first == false && idx == data.length - 1)
                            ) {
                                $(".first").html(`
                                    <div class="img">
                                        <img src="/data/${val.image}" alt="">
                                    </div>
                                    <div class="text">
                                        <p class="title">
                                            <a href="/notebook/detail/${val.idx}">
                                                ${val.name} - ${val.code}
                                            </a>
                                        </p>
                                        <p class="price">최저가 ${(val.real_price * 1).toLocaleString()}</p>
                                        <p class="tag change-tag">
                                        </p>
                                    </div> 
                                `);

                                $.each(val.tag_list, function(key, tag) {
                                    $(".change-tag").append(" <span>"+tag+"</span> ");
                                });

                                $(".change-tag").removeClass("change-tag");
                            } else {
                                $(".etcs").append(`
                                        <div>
                                            <div class="seller">${val.user_name}</div>
                                            <div class="title"><a href="/notebook/detail/${val.idx}">${val.name}</a></div>    
                                            <div class="price">\ ${val.price}</div>
                                            <div class="point">${val.point} p</div>
                                            <div class="post">${val.carry}</div>
                                        </div>
                                `);
                            };
                        });
                    },
                });

                first = false;
            };

            $("#point, #carry").on({
                change() {
                    search();
                },
            });
        </script>
    </body>
</html>