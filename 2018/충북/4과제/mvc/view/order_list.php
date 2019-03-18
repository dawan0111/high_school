        <div class="content login">
        	<div class="wrap">
                <h1 class="ww tc mt20 fs25">구매내역</h1>
                <table class="table1 ww mt20 table3">
                    <thead>
                        <tr>
                            <td class="w15">구매날짜</td>
                            <td>상품명</td>
                            <td class="w15">구매한 개수</td>
                            <td class="w15">판매자 연락처</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $key => $order): ?>
                            <tr>
                                <td><?php echo date("Y-m-d", strtotime($order["date"])) ?></td>
                                <td><?php echo $order["p_name"] ?></td>
                                <td><?php echo $order["count"] ?></td>
                                <td><?php echo $order["p_phone"] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
        	 
		<div class="copy">
        	<div class="wrap">
            	Copyright &copy; 2018 [이름]노트북 All Right Reserved.
            </div>
        </div>
        
    </body>
</html>