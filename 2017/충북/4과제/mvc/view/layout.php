<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>제주여행박람회</title>
	<base href="/">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="js/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/sub.css">
	<script type="text/javascript" src="js/jquery-1.12.3.js"></script>
	<script type="text/javascript" src="js/jquery-ui.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
</head>
<body>

<!-- header-start -->
<div id="header" class="container">
	<div class="row">
		<!-- social -->
		<div class="col-md-12 col-sm-12 col-xs-12 social">
			<div class="row">
				<div class="social-icon pull-right">
					<img src="images/social_icon.png" alt="social">
				</div>	
			</div>
		</div>
		
		<!-- headerInner -->
		<div class="col-md-12 col-sm-12 col-xs-12 headerInner">
			<div class="row">
				<div class="headerInner-logo pull-left">
					<a href="/" title="홈">
						<img src="images/logo.png" alt="홈">
					</a>
				</div>	
				<div class="headerInner-navi pull-right">
					<ul class="gnb">
						<li>
							<a href="page/reservation" title="제주여행박람회">제주여행박람회</a>
						</li>
						<li>
							<a href="page/information" title="내 예약정보">내 예약정보</a>
						</li>
						<li>
							<a href="page/registration" title="기업회원Booth등록">기업회원Booth등록</a>
						</li>
						<li>
							<a href="page/management" title="Booth관리">Booth관리</a>
						</li>
						<li>
							<a href="page/join" title="회원가입">회원가입</a>
						</li>
						<li>
							<?php if(!isset($_SESSION['id'])) { ?>
								<a href="page/login" title="로그인">로그인</a>
							<?php } else { ?>
								<a href="member/logout" title="로그아웃">로그아웃</a>
							<?php } ?>
						</li>
					</ul>
				</div>	
			</div>
		</div>
	</div>
</div>

<div id="banner" class="container">
	<div class="row">
		<!-- bannerInner -->
		<div class="col-md-12 col-sm-12 col-xs-12 bannerInner">
			<div class="bannerText pull-left">
				<img src="images/banner_text.png" alt="bannerText">
			</div>
		</div>
	</div>
</div>


<?php echo $data ?>

<!-- footer-start -->
<div id="footerScreen">
	<div id="footer" class="container">
		<div class="row">
			<!-- contentsInner -->
			<div class="col-md-12 col-sm-12 col-xs-12 footerInner">
			</div>
		</div>
	</div>
</div>

</body>
</html>