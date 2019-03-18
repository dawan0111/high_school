<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>로그인</title>
	<link rel="stylesheet" type="text/css" href="/app.css">
</head>
<body>

	<!-- header -->
	<header>
		<div id="logo">
			<a href="/">메일 시스템</a>
		</div>

		<nav>
			<ul>
				<?php if (!$login): ?>
					<li><a href="/member/join">회원가입</a></li>
					<li><a href="/">로그인</a></li>
				<?php else: ?>
					<li><a href="/member/logout">로그아웃</a></li>
				<?php endif ?>
			</ul>
		</nav>
	</header>
	<?php echo $data ?>