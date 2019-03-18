<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<title>메인 페이지</title>

	<!-- font awesome -->
	<link rel="stylesheet" href="/css/font-awesome/css/font-awesome.css">

	<!-- style -->
	<link rel="stylesheet" href="/css/style.css">

	<!-- jquery -->
	<script src="/js/jquery-3.2.1.min.js"></script>

	<!-- script -->
	<script src="/js/script.js"></script>
</head>
<body>
	<header>
		<div id="util">
			<div class="wrap">
				<div class="fl">
					<span>
						아름다운 여수 행복한 시민
					</span>
				</div>
				<div class="fr">
					<span class="menu">
						<?php if (!$login): ?>
							<a href="/member/login">
								<i class="fa fa-sign-in"></i>
								로그인
							</a>
							<a href="/member/join">
								<i class="fa fa-user"></i>
								회원가입
							</a>
						<?php else: ?>
							<a href="/member/logout">
								<i class="fa fa-sign-out"></i>
								로그아웃
							</a>
							<a href="#">
								<i class="fa fa-user"></i>
								<?php echo $login["name"] ?> 님
							</a>
						<?php endif ?>
					</span>
				</div>
			</div>
		</div>
		<nav id="nav">
			<div class="wrap">
				<div class="fl">
					<span class="logo">
						<a href="/">
							여수관광안내
						</a>
					</span>
				</div>
				<div class="fr menu">
					<span>
						<a href="/">
							메인 페이지
						</a>
					</span>
					<span>
						<a href="/tour/index">
							관광지 목록
						</a>
					</span>
					<span>
						<a href="/course/create">
							코스 만들기
						</a>
					</span>
					<span>
						<a href="/course/index">
							코스 목록
						</a>
					</span>
				</div>
			</div>
		</nav>
	</header>
	<?php echo $data ?>