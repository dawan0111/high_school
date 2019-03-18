<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>제주호텔</title>
<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/style.css">
<script src="/js/jquery-3.2.1.min.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-default" style="margin-bottom:10px;">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">Hotel Jeju</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="/reserve/c">예약하기</a></li>
                <li><a href="/faq/index">문의하기</a></li>
            </ul>
            <?php if (!isset($login)): ?>
                <ul class="nav navbar-nav navbar-right">
                    <li style="border: 2px solid #ededed; background:#fff; border-radius: 3px;"><a href="/member/join"><i class="glyphicon glyphicon-user"></i>&nbsp;회원가입</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-lock"></i>&nbsp;로그인<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                <form class="form-horizontal login-form" method="post" action="/member/loginAction?prevPage=/">
                                    <label><input type="checkbox" name="auto">&nbsp;자동로그인</label>
                                    <input type="text" name="id" class="form-control input-sm" placeholder="Enter ID">
                                    <input type="password" name="pw" class="form-control input-sm" placeholder="Enter PASSWORD">
                                    <input type="submit" class="btn btn-success btn-sm btn-block" value="로그인">
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            <?php else: ?>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="/faq/index">
                        <i class="glyphicon glyphicon-comment"></i>
                        <?php if ($faq != 0): ?>
                            <span class="label label-danger">
                                <?php if ($login["id"] == "admin"): ?>
                                    <?php echo $faq ?>
                                <?php else: ?>
                                    new
                                <?php endif ?>
                            </span>
                        <?php endif ?>
                        </a>
                    </li>
                    <li><a href="#"><i class="glyphicon glyphicon-user"></i>&nbsp;<?php echo $login["name"] ?>님<?php if($login["id"] != "admin") { ?>(<?php echo number_format($login["point"]) ?>포인트 보유중) <?php } ?></a></li>
                    <?php if($login["id"] == "admin") { ?>
                        <li><a href="admin/index"><i class="glyphicon glyphicon-cog"></i>&nbsp;관리자 페이지</a></li>
                    <?php } ?>
                    <li><a href="/member/logout"><i class="glyphicon glyphicon-log-out"></i>&nbsp;로그아웃</a></li>
                </ul>
            <?php endif ?>
        </div>
    </nav>
    <?php echo $data ?>