<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>관리자</title>

    <link rel="stylesheet" href="/css/default.css">

    <link rel="stylesheet" href="/css/admin.css">

    <script src="/js/jquery.min.js"></script>

    <script type="text/javascript" src="/js/jquery-ui.js"></script>
    <script src="/js/script.js"></script>

    <script type="text/javascript">
        $(function() {
            menuPos();
        });
    </script>
</head>

<body>
    <div id="wrap" class="admin">
        <div id="header">
            <div class="wrap">
                <div class="hd-top">
                    <div id="logo">
                        <h1><a href="/admin/index">ADMIN</a></h1>
                    </div>
                    <a href="/" class="home-move">홈페이지로 이동</a>
                    <?php if (USER): ?>
                        <p><a href="/member/logout">LOG OUT</a></p>
                    <?php endif ?>
                </div>

                <div class="hd-bot">
                    <ul>
                        <li>
                            <a href="#">관리 메뉴</a>
                        </li>
                    </ul>

                    <div class="submenu" style="display:none;">
                        <ul>
                            <li><a href="#">홈페이지 관리</a></li>
                            <li><a href="/admin/menu">메뉴관리</a></li>
                            <li><a href="/admin/main">메인페이지 구성</a></li>
                            <li><a href="/admin/menucont">메뉴별컨텐츠</a></li>
                            <li><a href="/admin/ani">애니메이션 구성</a></li>
                        </ul>

                        <ul>
                            <li><a href="#">게시판</a></li>
                            <li><a href="/admin/board">설정</a></li>
                        </ul>

                        <span class="menu-pos2">메뉴 접기 버튼</span>
                        <span class="menu-pos1">열어두기 활성화 버튼</span>
                    </div>
                </div>
            </div>
        </div>