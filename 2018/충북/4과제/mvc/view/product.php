        <div class="content">
        	<div class="wrap">
            	<div class="item_list item_buy">
                    <div class="ww list">
                    
                    	<div>
                        	<div class="img">
                            	<img src="/data/<?php echo $product['image'] ?>" alt="image">
                            </div>
                        	<div class="text">
                            	<p class="title"><a href="price_list.html"><?php echo $product['name'] ?> - <?php echo $product['code'] ?></a> <span>가격비교</span></p>
                                <p class="price">\ <?php echo number_format($product['real_price']) ?></p>
                                <p class="tag">
                                    <?php foreach ($product["tag_list"] as $key => $tag): ?> 
                                	   <span><?php echo $tag ?></span>
                                    <?php endforeach ?>
                                </p>
                                <p class="seller"><?php echo $product["user_name"] ?> / <?php echo $product["phone"] ?></p>
                                <div class="button">
                                    <form style="display: inline-block;" method="post" action="/notebook/buy/<?php echo $product['idx'] ?>">
                                        <input type="number" name="count" value="1" style="width: 80px; height: 30px; border-left: 2px solid red;" min="1">
                                        <button>구매하기</button>
                                    </form>
                                    <button>장바구니</button>
                                 </div>
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
        
    </body>
</html>