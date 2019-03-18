<!doctype html>
<html lang="ko">
	<head>
		<meta charset="UTF-8">
		<title>전남컴퓨터나라</title>
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/css/main.css">
        <link rel="stylesheet" href="/css/sub.css">
        <script src="/js/jquery.js"></script>
        <script src="/js/script.js"></script>
        <meta name="theme-color" content="#64a1ee">
	</head>
	<body>
        <!-- Header -->   
        <div class="header">
	        <div class="wrap">
    		    <div>
        			<a href="#">
        				<span>system@webmaster.com</span>
        			</a>
        		</div>
                <?php if (!$login): ?>
            		<div class="tr">
            			<a href="/member/login">로그인</a>
            			<a href="/member/join">회원가입</a>
    		        </div>
                <?php endif ?>
        	</div>
        </div>
        
        <div class="menubar">
            <div class="wrap">
                <div class="logo">
                    <a href="/"><img src="/image/logo.jpg" alt=""></a>
                </div>
                <div class="menu">
                    <div>
                        <a href="/notebook/list">상품조회</a>
                    </div>
                    <?php if ($login && $login["type"] == "판매자"): ?>
                        <div>
                            <a href="/notebook/add">상품등록</a>
                        </div>
                        <div>
                            <a href="/notebook/modify">상품관리</a>
                        </div>
                    <?php endif ?>
                    <?php if (!$login): ?>
                    	<div>
                        	<a href="/member/login">로그인</a>
    					</div>
                    	<div>
                        	<a href="/member/join">회원가입</a>
    					</div>
                    <?php else: ?>
                        <div>
                            <a href="/member/logout">로그아웃</a>
                        </div>
                        <div>
                            <a href="/member/mypage">내 정보</a>
                        </div>
                        <div>
                            <a href="/member/history">구매내역</a>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>	
        <?php echo $data ?>