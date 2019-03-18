<div id="content">
	<div class="w100">
		<div class="detail">
			<h1 class="title">상세정보</h1>
			
			<div class="details">
				 <img src="/images/<?php echo $product['image'] ?>" alt="image" title="image">
				 
				<table>
					<tr>
						<th>품목명</th>
						<td><?php echo $product["name"] ?></td>
					</tr>
					<tr>
						<th>품목금액</th>
						<td><?php echo number_format($product["price"]) ?>원</td>
					</tr>
					<tr>
						<th>주행거리</th>
						<td><?php echo $product["distance"] ?>km</td>
					</tr>
					<tr>
						<th>최고속도</th>
						<td><?php echo $product["speed"] ?>kn/h</td>
					</tr>
					<tr>
						<th>충전시간</th>
						<td><?php echo $product["chargtime"] ?>시간</td>
					</tr>
					<tr>
						<th>인승</th>
						<td><?php echo $product["passenger"] ?>인승</td>
					</tr>
					<tr>
						<th>중량</th>
						<td><?php echo $product["weight"] ?>kg</td>
					</tr>
				</table>
				
				<div>
					<a href="/product/index?type=<?php echo $type ?>" class="btn blueBtn">목록</a>
					<a href="/product/res/<?php echo $product['idx'] ?>" class="btn blueBtn">예약하기</a>
				</div>
				
			</div><!--details-->
			
			<div class="detailImg col-md-12">
				<h2 class="title">상세이미지</h2>
				
				<?php if ($login && $login["id"] == "admin"): ?>
					<form action="/product/addImage/<?php echo $product['idx'] ?>" class="file" method="post" enctype="multipart/form-data">
						<button class="btn blueBtn">사진추가</button>
						<input type="file" name="file">
					</form>
				<?php endif ?>

				<ul>
					<?php foreach (explode(",", $product["detail"]) as $key => $detail): ?>
						<li class="col-md-3"><img src="/images/<?php echo $detail ?>" alt="alt"></li>
					<?php endforeach ?>
				</ul>
			</div><!--detailImg-->
		</div><!--detail-->
	</div><!--w100-->
</div><!--content-->
    
	
</body>
</html>