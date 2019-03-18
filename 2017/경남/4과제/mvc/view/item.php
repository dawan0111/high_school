	<div id="itemAdd">
		<p class="title"><span class="glyphicon glyphicon-tag"></span>물품 추가</p>
		<form method="post" action="/product/addItem" enctype="multipart/form-data">
			<div class="form-group">
				<label>상품명</label>
				<input type="text" class="form-control" placeholder="상품명" name="name">
			</div>
			<div class="form-group">
				<label>이미지</label>
				<input type="file" class="form-control" placeholder="이미지" name="file">
			</div>
			<div class="form-group">
				<label>분류</label>
				<select class="form-control" name="type">
					<option>가공식품</option>
					<option>건강식품</option>
					<option>신선식품</option>
					<option>여행/체험권</option>
					<option>기타</option>
				</select>
			</div>
			<div class="form-group">
				<lable>설정 가격</lable>
				<input type="text" class="form-control" placeholder="가격" name="price">
			</div>
			<div class="form-group">
				<lable>재고</lable>
				<input type="text" class="form-control" placeholder="재고" name="stock">
			</div>
			<div class="form-group">
				<button class="btn btn-default">등록</button>
			</div>
		</form>
	</div>
</body>
</html>