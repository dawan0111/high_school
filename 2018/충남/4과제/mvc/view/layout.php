<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="/css/css.css">
	<script src="/js/jquery/jquery-1.12.3.min.js"></script>
	<script src="/js/jquery/jquery-ui-1.11.4/jquery-ui.js"></script>
	<link rel="stylesheet" href="/js/jquery/jquery-ui-1.11.4/jquery-ui.css">
	<script src="/js/script.js"></script>
	<link rel="stylesheet" href="/js/bootstrap-3.3.7-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="/js/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css">
	<script src="/js/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</head>
<body>
	
	<header>
		<div class="w100">
			<a href="/" class="home"><img src="/images/logo.png" alt="Green wheel" title="Green wheel"></a>
			
			<ul>
				<?php if (!$login): ?>
					<li><a href="/member/login">로그인</a></li>
				<?php else: ?>
					<li><a href="/member/logout">로그아웃</a></li>
					<?php if ($login["id"] != "admin"): ?>
						<li><a href="/product/search">검색예약</a></li>
						<li><a href="/member/mypage">마이페이지</a></li>
					<?php endif ?>
				<?php endif ?>
				<?php if ($login && $login["id"] == "admin"): ?>
					<li class="subMenu">
						<a href="/admin.html">관리자</a>
						<div class="sub">
							<a href="/admin/index">결제관리</a>
							<a href="/admin/item">예약관리</a>
							<a href="/admin/material">통계자료</a>
						</div>
					</li>
				<?php endif ?>
			</ul>
		</div><!--w100-->
	</header>
	<?php echo $data ?>