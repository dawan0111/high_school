<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>전남관광명소</title>

    <link rel="stylesheet" href="/css/default.css">

    <link rel="stylesheet" href="/css/common.css">

    <script src="/js/jquery.min.js"></script>

    <script src="/js/script.js"></script>
</head>

<body>
    <div id="wrap">
        <div id="header" class="main-header">
            <div class="wrap">
                <div id="logo">
                    <h1><a href="/">전남관광명소</a></h1>
                </div>

                <div id="util-menu">
                    <ul>
                        <li><a href="/">홈</a></li>
                        <li><a href="#">E-mail : tour@yeosu.com</a></li>
                        <li><a href="#">Contents</a></li>
                        <li><button type="button" onclick="location.href='/admin/index'">관리자모드</button></li>
                    </ul>
                </div>
            </div>
            <?php
                $first_menu = $db::fetchAll("menu", "parent = 0 && active = 1 order by sort asc");
                $sub_menu = [];
            ?>
            <div id="main-menu" class="main-hd">
                <div class="wrap">
                    <ul class="menu">
                        <?php foreach ($first_menu as $key => $menu): ?>
                            <li><a href="#"><?php echo $menu['name'] ?></a></li>
                            <?php
                                $sub_menu[] = $db::fetchAll("menu", "parent = ? && active = 1 order by sort asc", [$menu['idx']]);
                            ?>
                        <?php endforeach ?>
                    </ul>
                </div>

                <div class="submenu" style="display: none;">
                    <div class="wrap">
                        <div class="submenu-find">
                            <?php foreach ($sub_menu as $key => $data): ?>
                                <ul>
                                    <?php foreach ($data as $key => $val): ?>
                                        <li><a href="/menu/cont/<?php echo $val['idx'] ?>"><?php echo $val['name'] ?></a></li>
                                    <?php endforeach ?>
                                </ul>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>