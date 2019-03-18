        <div class="content">
        	<div class="wrap">
            	<div class="item_list">
                    <div class="ww search">
                    	<div class="tag_line">
                        	<div>태그</div>
                            <div class="tag real-tag">
                                <?php foreach ($tags as $key => $tag): ?>
                                    <button><?php echo $tag ?></button>
                                <?php endforeach ?>
                            </div>
                        </div>
                    	<div>
                        	<div>제조사</div>
                            <div class="tag make real-company">
                                <?php foreach ($companys as $key => $company): ?> 
                            	   <button><?php echo $company ?></button>
                                <?php endforeach ?>
                            </div>
                        </div>
                    	<div>
                        	<div>가격</div>
                            <div class="price">
                            	<input type="text" value="1" id="min_price"> ~
                                <input type="text" value="999,999,999,999" id="max_price">
                            </div>
                        </div>
					</div>
                    
                    <div class="ww list">
                        <?php foreach ($all_product as $key => $product): ?>
                            <div>
                                <div class="img">
                                    <img src="/data/<?php echo $product['image'] ?>" alt="">
                                </div>
                                <div class="text">
                                    <p class="title">
                                        <a 
                                            href="<?php echo $product['count'] == 1 ? 
                                            "/notebook/detail/{$product['idx']}" :
                                            "/notebook/compare?code={$product['code']}&company={$product['company']}" ?>">

                                            <?php if ($product["count"] == 1): ?>
                                                <?php echo $product['name'] ?>
                                            <?php else: ?>
                                                <?php echo $product['company'] ?> - <?php echo $product['code'] ?> 
                                            <?php endif ?>
                                        </a> 
                                        <?php if ($product['count'] == 1): ?>
                                            <span class="normal">일반 상품</span>
                                        <?php else: ?>
                                            <span class="price">가격비교</span>
                                        <?php endif ?>
                                    </p>
                                    <p class="price">최저가 <?php echo number_format($product["min_price"]) ?></p>
                                    <p class="tag">
                                        <?php foreach ($product["tag_list"] as $key => $tag): ?>
                                            <span><?php echo $tag ?></span>
                                        <?php endforeach ?>
                                    </p>
                                    <p class="seller">판매자1</p>
                                </div>    
                            </div>            
                        <?php endforeach ?>
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
            function search() {
                var data = {
                    tag : ["z"],
                    company : ["z"],
                    min_price : $("#min_price").val(),
                    max_price : $("#max_price").val()
                };

                $(".real-tag .select").each((idx, el) => {
                    data.tag.push($(el).html());
                });
                $(".real-company .select").each((idx, el) => {
                    data.company.push($(el).html());
                });

                $.ajax({
                    url : "/notebook/getList",
                    data : data,
                    type : "POST",
                    success (data) {
                        console.log(data);
                        data = JSON.parse(data);

                        $(".list").html("");

                        $.each(data, function(idx, val) {
                            $(".list").append(`
                                <div>
                                    <div class="img">
                                        <img src="/data/${val.image}" alt="">
                                    </div>
                                    <div class="text">
                                        <p class="title">
                                            <a href="/notebook/compare/${val.code}" class='change-a'>${val.name}</a> 
                                            <span class='change-type'>가격비교</span>
                                        </p>
                                        <p class="price">최저가 ${(val.min_price * 1).toLocaleString()}</p>
                                        <p class="tag change-tag">
                                        </p>
                                        <p class="seller">${val.user_name}</p>
                                    </div>    
                                </div>
                            `);

                            if(val.count == 1) {
                                $(".change-type").addClass("normal").html("일반 상품");
                                $(".change-a").attr("href", `/notebook/detail/${val.idx}`);
                            } else {
                                $(".change-type").addClass("price").html("가격비교");
                                $(".change-a").attr("href", `/notebook/compare?code=${val.code}&company=${val.company}`);
                                $(".change-a").html(`${val.company} - ${val.code}`)
                            };

                            $.each(val.tag_list, (idx, tag) => {
                                $(".change-tag").append(" <span>"+tag+"</span> ");
                            });

                            $(".change-tag").removeClass("change-tag");
                            $(".change-type").removeClass("change-type");
                            $(".change-a").removeClass("change-a");
                        });
                    },
                });
            };

            $(".tag button").on({
                click () {
                    $(this).toggleClass("select");
                    search();
                } 
            });

            $(".price input").on({
                input () {
                    search();
                }
            });
        </script>
    </body>
</html>