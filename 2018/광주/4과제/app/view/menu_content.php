<link rel="stylesheet" type="text/css" href="/css/board.css">

<div id="contents">
    <?php
        $menu = $db::fetch("menu", "idx = ?", [$idx]);
    ?>
    <div class="wrap">
        <div class="page-title">
            <h2><?php echo $menu["name"] ?></h2>
        </div>

        <?php if ($menu["type"] == "html"): ?>
            <?php echo $menu["html"] ?>
        <?php endif ?>

        <?php if ($menu["type"] == "board"): ?>
            <?php
                $page = $_GET["page"] ?? 1;
                $board = $db::fetch("board_set", "idx = ?", [$menu['board']]);
                $posts = $db::fetchAll("board", "bds_idx = ? order by datetime desc", [$board['idx']]);
                $c = count($posts);
                $limit = $board["line_cnt"] * $board["page_cnt"];

                $posts = array_chunk($posts, $limit);

                $_SESSION["menu"] = $menu;

                $view_post = $posts[$page - 1] ?? [];
            ?>

            <?php if ($board["type"] == 1): ?>
                <table class="n_board">
                    <colgroup>
                        <col style="width:50%;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>전체 : <?php echo $c ?><b></b></th>
                            <th>글번호</th>
                            <th>작성자</th>
                            <th>작성일시</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($view_post as $key => $post): ?>
                            <tr>
                                <td><a href="/board/view/<?php echo $post['idx'] ?>"><?php echo $post['title'] ?></a></td>
                                <td><?php echo $post['idx'] ?></td>
                                <td><?php echo $post["writer"] ?></td>
                                <td><?php echo date("Y-m-d", strtotime($post["datetime"])) ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php endif ?>

            <?php if ($board["type"] == 2): ?>
                <div class="b_board">
                    <ul>
                        <?php foreach ($view_post as $key => $post): ?>
                            <?php $image = gi($post); ?>
                            <li>
                                <?php if ($image): ?>
                                    <span class="img-area">
                                        <img src="/upload/<?php echo $image[0] ?>" alt="img">
                                    </span>
                                <?php else : ?>
                                    <span class="no-img">
                                        No Image
                                    </span>
                                <?php endif ?>
                                <div class="l-info">
                                    <h3><a href="/board/view/<?php echo $post['idx'] ?>"><?php echo $post['title'] ?></a></h3>
                                    <h5><?php echo $post['datetime'] ?></h5>
                                    <p><?php echo $post['text'] ?></p>
                                </div>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>

            <?php if ($board["type"] == 3): ?>
                <?php $width = 100 / $board["line_cnt"]; ?>
                <div class="c_board">
                    <ul>
                        <?php foreach ($view_post as $key => $post): ?>
                            <?php $image = gi($post); ?>
                            <li style="width:<?=$width ?>%; height:300px;">
                                <div class="box">
                                    <?php if ($image): ?>
                                        <div class="img" style="background-image:url('/upload/<?php echo $image[0] ?>'); height: 100px;">
                                        </div>
                                    <?php else: ?>
                                        <div class="no-image img" style="height: 100px;">
                                            <p>No Image</p>
                                        </div>
                                    <?php endif ?>
                                    <span class="b-no"><?php echo $post['idx'] ?></span>

                                    <h3><a href="/board/view/<?php echo $post['idx'] ?>"><?php echo $post['title'] ?></a></h3>
                                    <p class="bd-from"><?php echo $post['writer'] ?></p>

                                    <ul>
                                        <li>일시 <span><?php echo $post['datetime'] ?></span></li>
                                        <li>조회 <span><?php echo $post['hit'] ?></span></li>
                                    </ul>
                                </div>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>

            <div class="paging" style="display: flex; width: 100%;">
                <?php for ($i=1; $i <= count($posts); $i++) {  ?>
                    <a href="?page=<?php echo $i ?>" style="margin: 10px;"><?php echo $i ?></a>
                <?php } ?>
            </div>

            <?php if (USER): ?>
                <div class="write-btn">
                    <button type="button" onclick="location.href='/board/write/<?php echo $board['idx'] ?>'">글쓰기</button>
                </div>
            <?php endif ?>
        <?php endif ?>

        <?php if ($menu["type"] == ""): ?>
            <div class="no-page">
                <div class="no-page-area">
                    <div class="warning">
                        <img src="/images/warning.png" alt="warning">
                    </div>

                    <h2>현재 페이지는 연동이 되어있지 않습니다.</h2>
                    <p>관리자에게 문의 바랍니다.</p>

                    <button type="button">홈으로</button>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>