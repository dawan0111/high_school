<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $page_title ?></title>
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
	<!-- //header -->

	<!-- content -->
	<article id="content">
		<section class="mail-section">
			<aside class="mail-aside">
				<div class="mail-btn-group">
					<a href="/mail/write" class="mail-btn">메일쓰기</a>
					<a href="/mail/mywrite" class="mail-btn">내게쓰기</a>
				</div>
				<ul class="mail-menu">
					<?php foreach ($menus as $key => $menu): ?>
						<li <?php echo $key == $method ? "class='active'" : "" ?>>
							<a href="/mail/<?php echo $key ?>"><?php echo $menu[0] ?> 
							<?php if (in_array($key, ["mail1", "mail2", "mail6"])): ?>
								<span><?php echo $menu[1] ?></span>
							<?php endif ?>
						</a>
						</li>
					<?php endforeach ?>
				</ul>
			</aside>
			<?php echo $data ?>
	<?php if (in_array($method, array_keys($menus))): ?>
			<aside class="search-aside">
				<form method="get" action="/mail/<?php echo $method ?>">
					<div class="form-group">
						<h4 class="search-title">검색 영역</h4>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="검색" name="search" value="<?php echo $search ?>">
					</div>
					<div class="form-group">
						<h4 class="search-subtitle">날짜</h4>
					</div>
					<div class="form-group">
						<label for=""><small>시작 날짜</small></label>
						<input type="date" class="form-control" name="s_date" value="<?php echo $s_date ?>">
					</div>
					<div class="form-group">
						<label for=""><small>끝 날짜</small></label>
						<input type="date" class="form-control" name="e_date" value="<?php echo $e_date ?>">
					</div>
					<div class="form-group">
						<button class="search-btn">검색</button>
					</div>
				</form>
			</aside>
	<?php endif ?>
	</article>
	<!-- //content -->

</body>
</html>