
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="/css/animate.css">
	<link rel="stylesheet" href="/css/icomoon.css">
	<link rel="stylesheet" href="/css/magnific-popup.css">
	<link rel="stylesheet" href="/css/salvattore.css">
	<link rel="stylesheet" href="/css/style.css">
	<script src="/js/modernizr-2.6.2.min.js"></script>
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

</head>
	<body>
		
	<div id="fh5co-offcanvass">
		<a href="#" class="fh5co-offcanvass-close js-fh5co-offcanvass-close">목록<i class="icon-cross"></i> </a>
		<h1 class="fh5co-logo"><a class="navbar-brand" href="/">목록</a></h1>
		<ul>
			<li class="active"><a href="/">홈</a></li>
			<li><a href="/member/join">회원가입</a></li>
			<?php if(!isset($_SESSION['id'])) { ?>
				<li><a href="/member/login">로그인</a></li>
			<?php } ?>
			<?php if(isset($_SESSION['id'])) { ?>
				<li><a href="/member/logout">로그아웃</a></li>
				<li><a href="/member/mypage">MyPage</a></li>
			<?php } ?>
		</ul>
		<?php if(isset($_SESSION['id']) && $_SESSION['id']['email'] == "admin") { ?>
			<h1 class="fh5co-logo"><a class="navbar-brand" href="/">admin</a></h1>
			<ul>
				<li><a href="/admin/admin_house_insert">펜션등록</a></li>
				<li><a href="/admin/admin_house_delete">펜션삭제</a></li>
				<li><a href="/admin/admin_house_reservation">예약확인</a></li>
			</ul>
		<?php } ?>
		<h3 class="fh5co-lead">Connect with us</h3>
		<p class="fh5co-social-icons">
			<a href="#"><i class="icon-twitter"></i></a>
			<a href="#"><i class="icon-facebook"></i></a>
			<a href="#"><i class="icon-instagram"></i></a>
			<a href="#"><i class="icon-dribbble"></i></a>
			<a href="#"><i class="icon-youtube"></i></a>
		</p>
	</div>
	<header id="fh5co-header" role="banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<a href="#" class="fh5co-menu-btn js-fh5co-menu-btn">목록 <i class="icon-menu"></i></a>
					<a class="navbar-brand" href="/"><?php echo $title ?></a>
				</div>
			</div>
		</div>
	</header>

	<?php echo $data ?>

	<!-- jQuery -->
	<script src="/js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="/js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="/js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="/js/jquery.waypoints.min.js"></script>
	<!-- Magnific Popup -->
	<script src="/js/jquery.magnific-popup.min.js"></script>
	<!-- Salvattore -->
	<script src="/js/salvattore.min.js"></script>
	<!-- Main JS -->
	<script src="/js/main.js"></script>

	

	<script>
	    $(function() {
	        $("#place").on({
	            change : function() {
	                var place = $(this).find("option:selected").val();

	                location.href='/admin/admin_house_reservation?place='+place;
	            },
	        })
	    })
	</script>
	
	</body>
</html>
