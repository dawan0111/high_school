

<div id="contents">
    <div class="banner" data-delay='<?php echo $ani['delay'] ?>'>
        <div class="banner-img">
            <?php
                $left = $ani["l_bg"] == "" ? "#fff" :  "#".$ani["l_bg"];
            ?>
            <div class="left-back" style="background-color:<?php echo $left ?>;"></div>
            <ul style="width: 100%; margin-left: 0%;">
                <?php foreach ($ani_image as $key => $image): ?>
                    <li>
                        <a href="#">
                            <div class="main-img" style="background-image:url('/upload/<?php echo $image ?>')"></div>
                        </a>
                    </li>
                <?php endforeach ?>
            </ul>
            <?php
                $right = $ani["r_bg"] == "" ? "#fff" :  "#".$ani["r_bg"];
            ?>
            <div class="right-back" style="background-color:<?php echo $right ?>;"></div>

            <div class="banner-pos">
                <ul>

                </ul>
            </div>
        </div>
    </div>
    <div id="section">
        <div class="wrap">
            <?php
                $dans = $db::fetchAll("dan", "1 order by sort asc");
                $class = ["", "board_cont", "b_board", "c_board"];
                $limit = ["", 5, 2, 3];
            ?>

            <?php foreach ($dans as $key => $dan): ?>
                <?php
                    $dan_content = $db::fetchAll("dan_content", "dan_idx = ?", [$dan['idx']]);
                    $width = 100 / count($dan_content);
                    $style = [];

                    if($dan["top"] != "") {
                        $style[] = "border-top: 5px solid ".$dan["top"];
                    };
                    if($dan["bottom"] != "") {
                        $style[] = "border-bottom: 5px solid ".$dan["bottom"];
                    };
                    if($dan["bg"] != "") {
                        $style[] = "background:".$dan["bg"];
                    };
                ?>
                <div class="section" style="width:100%; <?php echo join(";", $style) ?>">
                    <?php foreach ($dan_content as $key => $data): ?>
                        <?php if ($data["type"] == "board"): ?>
                            <?php 
                                $board = $db::fetch("board_set", "idx = ?", [$data['board']]);
                                $now_limit = $limit[$board['type']];
                                $posts = $db::fetchAll("board", "bds_idx = ? order by datetime desc limit 0, $now_limit", [$board['idx']]);
                            ?>
                            <div class="<?php echo $class[$board['type']] ?>" style="width:<?php echo $width ?>%;">
                                <div class="title">
                                    <h3 style="cursor:pointer;"><?php echo $board['name'] ?></h3>
                                </div>

                                <ul>
                                    <?php foreach ($posts as $key => $post): ?>
                                        <?php $image = gi($post); ?>
                                        <?php if ($board["type"] == 1): ?>
                                            <li><a href="/board/view/<?php echo $post['idx'] ?>"><span class="a_text"><?php echo $post['title'] ?></span></a></li>
                                        <?php endif ?>

                                        <?php if ($board["type"] == 2): ?>
                                            <li>
                                                <h4 style="margin-right:10px;"></h4>
                                                <?php if ($image): ?>
                                                    <span class="img-area" style="background-image:url('/upload/<?php echo $image[0] ?>')"></span>
                                                <?php else: ?>
                                                    <span class="no-img">No Image</span>
                                                <?php endif ?>
                                                <div class="l-info">
                                                    <h3><?php echo $post['title'] ?></h3>
                                                    <p><?php echo $post['text'] ?></p>
                                                </div>
                                            </li>
                                        <?php endif ?>
                                        <?php if ($board["type"] == 3): ?>
                                            <li style="width:33.33%;">
                                                <div class="box">
                                                    <?php if ($image): ?>
                                                        <div class="img" style="background-image:url('/upload/<?php echo $image[0] ?>');">
                                                        </div>
                                                    <?php else: ?>
                                                        <span class="no-img">No Image</span>
                                                    <?php endif ?>

                                                    <h3><?php echo $post["title"] ?></h3>

                                                    <ul>
                                                        <li>일시 <span><?php echo date("Y-m-d", strtotime($post["datetime"])) ?></span></li>
                                                        <li>조회 <span><?php echo $post['hit'] ?></span></li>
                                                    </ul>
                                                </div>
                                            </li>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        <?php elseif($data["type"] == "banner"): ?>
                            <div class="banner-img" style="width:<?php echo $width ?>%;">
                                <a href="<?php echo $data["link"] ?>" <?php echo $data["link_type"] == 2 ? "target='_blank'" : ""; ?>>
                                    <img src="/upload/<?php echo $data['def_img'] ?>" alt="def" class="def_i">
                                    <img src="/upload/<?php echo $data['over_img'] == "" ? $data["def_img"] : $data['over_img'] ?>" alt="over" class="over_i" style="display:none;">
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endforeach ?>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
</div>