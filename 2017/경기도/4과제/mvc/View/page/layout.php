<!DOCTYPE html>
<!-- saved from url=(0026)http://localhost:8000/home -->
<html lang="ko"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title><?php echo $webSite['siteName'] ?></title>
    <link rel="stylesheet" href="<?php echo $webSite['theme'] ?>">
    <script src="/js/app.js"></script>
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand"><?php echo $webSite['siteName'] ?></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">게시판<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php foreach($webSite['normal_board'] as $key => $board) { ?>
                                <li>
                                    <a href="/page/normalboard/<?php echo $board['id'] ?>"><?php echo $board['boardname'] ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">사진 게시판<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php foreach ($webSite['photo_board'] as $key => $value): ?>
                                <li>
                                    <a href="/page/pictureboard/<?php echo $value['id'] ?>"><?php echo $value['boardname'] ?></a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </li>
                </ul>

                <?php if (!isset($_SESSION['id'])) { ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">로그인 <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <form method="post" action="/member/login" accept-charset="UTF-8" style="margin:0px;padding:10px;">
                                    <input type="text" class="form-control" placeholder="email@domain.com" id="email" name="email" style="margin-bottom:5px;" value="" >
                                    <input type="password" class="form-control" placeholder="비밀번호" id="password" name="password" style="margin-bottom:5px;" value="">
                                    <button class="btn btn-default btn-block" type="submit" id="sign-in">로그인</button>
                                    <a href="/page/register" class="btn btn-default btn-block" >회원가입</a>
                                </form>
                            </ul>
                        </li>
                    </ul>
                <?php } else { ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a><?php echo $_SESSION['id']['name'] ?> 님</a></li>
                        <?php if($_SESSION['id']['id'] == $webSite['admin_email']) { ?>
                            <li><a href="/page/admin">관리메뉴</a></li>
                        <?php } ?>
                        <li><a href="/member/logout">로그아웃</a></li>
                    </ul>
                <?php } ?>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
        
    </nav>

    <?php echo $data ?>
