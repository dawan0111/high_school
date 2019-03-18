<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta content="" name="keywords">
<meta content="" name="description">
<title>:: 불우이웃돕기 :: <?php echo $title ?? ""; ?></title>
<link href="/assets/css/style.css" rel="stylesheet" type="text/css">

<script src="/assets/jquery/jquery-3.3.1.js"></script>
<script src="/assets/jquery/jquery-ui-1.12.1/jquery-ui.js"></script>
<script src="/assets/js/app.js"></script>
</head>

<body>

<!-- header -->

<header>
    
	<div class="wrap">

		<div class="fl">    
        	<div id="logo">
                <a href="/" title="홈">
                    <img src="/assets/image/logo.png" alt="홈">   
                </a>
            </div>
        </div>
        
        <nav>
        	<ul>                
                <li><a href="/">메인페이지</a></li>
				<li><a href="/event/join">참가내역</a></li>
				<li><a href="/event/success">당첨자보기</a></li>
				<li><a href="/notice/index">공지사항</a></li>
            </ul>
        </nav>
		
        <div id="top">     	
            <?php if (isset($login)): ?>
                <?php if ($login["id"] != "admin"): ?>
                	<span class="blue cu"><?php echo $login["name"] ?></span> 님 &nbsp;
                    메시지 : <span class="fb red cu" onclick="window.open('/message/index', '', 'width=900,height=500')"><?php echo count($login["msg"]) ?></span> 개, &nbsp;
                    나눔포인트 : <span class="blue fb"><?php echo number_format($login["give_point"]) ?></span> &nbsp;&nbsp;
        			회원포인트 : <span class="blue fb"><?php echo number_format($login["point"]) ?></span> &nbsp;&nbsp;
                <?php else: ?>
                    <span class="blue cu"><?php echo $login["id"] ?></span>
                    &nbsp;
                    &nbsp;
                    <a href="/admin/index">관리자페이지</a>
                <?php endif ?>
                &nbsp;
                &nbsp;
                <a href="/member/logout">로그아웃</a>
            <?php else: ?>
                <a href="/member/login">로그인</a>
                &nbsp;
                &nbsp;
                &nbsp;
                <a href="/member/join">회원가입</a>
            <?php endif ?>
        </div>
        
	</div>
    
</header>

<section id="slide">
    <img src="/assets/image/visual.jpg" alt="visual">
</section>