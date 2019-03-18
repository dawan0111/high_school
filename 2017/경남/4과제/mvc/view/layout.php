<!DOCTYPE html>
<html>
<head>
	<title>4과제</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/common.css">
	<script src="/js/jquery-3.2.1.min.js"></script>
	<script src="/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
	<?php if (isset($main)): ?>
		<form id="searchForm" method="get" style="margin-bottom: 20px;">
			<div id="search">
				<input type="hidden" name="category" value="<?php echo $category ?>">
				<input type="text" placeholder="검색어 입력" name="search" value="<?php echo $search ?>" required>
				<button><span style="font-size:1.4em" class="glyphicon glyphicon-search"></span></button>
			</div>
		</form>
	<?php endif ?>
	<div id="back"> 
	</div>
	<header>
		<!-- 비회원 -->
		<?php if (!isset($login)): ?>
			<p class="login">
				<span class="glyphicon glyphicon-user"></span><a href="/member/login">로그인</a> /
				<a href="/member/join">회원가입</a>
			</p>
		<?php else: ?>
			<p class="login">
			이름: <kbd><?php echo $login["name"] ?></kbd> &nbsp;
			상품권: <kbd><?php echo count($coupon) ?>개</kbd> &nbsp;
			<a href="/member/logout">로그아웃</a>
			<a href="/buy/cart"><span class="glyphicon glyphicon-shopping-cart"></span>장바구니</a>
			<a href="/buy/list" style="margin-left:10px"><span class="glyphicon glyphicon-th-list"></span>구매목록</a>
			</p>

			<?php if ($login["id"] == "admin"): ?>
				<p class="login">
					<a href="/admin/analysis">데이터 분석</a>
					&nbsp;|&nbsp;  
					<a href="/admin/stock">재고관리</a>
					&nbsp;|&nbsp;  
					<a href="/admin/item">물품추가</a>
					&nbsp;|&nbsp;
					<a href="/admin/discount">할인율 설정</a>
				</p>
			<?php endif ?>
		<?php endif ?>
	</header>
	<div class="logo">
		<img src="/img/logos.png" alt="logo" onclick="location.href='/'">
	</div>
	<nav>
		<?php
			$categorys = ["전체보기", "가공식품", "건강식품", "신선식품", "여행/체험권", "기타"];
		?>
		<ul>
			<?php foreach ($categorys as $key => $cate): ?>
				<?php @$selected = $category == $cate ? "class='select'" : ""; ?>
				<?php $search = isset($_GET["search"]) ? $_GET["search"] : ""; ?>
				
				<li <?php echo $selected ?> onclick="location.href='/?category=<?php echo $cate ?>&search=<?php echo $search ?>'"><?php echo $cate ?></li>
			<?php endforeach ?>
		</ul>
	</nav>
	<?php echo $data ?>