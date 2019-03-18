
    <style>
        .m-cont {
            float: left;
            width: 100%;
            margin-top: 10px;
        }

        .m-cont>li {
            float: left;
            width: 100%;
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 15px 20px;
            margin-bottom: 10px;
        }

        .m-cont>li p {
            margin-top: 3px;
            font-size: 14px;
        }

        .m-cont>li.add-list {
            background-color: #fff !important;
        }
    </style>    
        <div id="contents" class="main-page">
            <div class="wrap">
                <div class="page-title">
                    <h3>메인페이지 구성</h3>
                </div>

                <div class="dan-add-btn">
                    <button type="button">단 추가</button>
                </div>

                <form method="post" class="main-page-frm">
                    <div class="dan-list">
                        <div class="dan-add-frm">
                        </div>
                        <?php
                            $dans = $db::fetchAll("dan", "1 order by sort asc");
                        ?>

                        <?php foreach ($dans as $key => $dan): ?>
                            <div class="list dan-item" data-idx="<?php echo $dan['idx'] ?>">
                                <p>1단 : 상단 라인색 : <?= color($dan['top']) ?> 하단 라인색 : <?= color($dan['bottom']) ?> 배경색 : <?= color($dan['bottom']) ?>

                                <button type="button" class="main-page-set" >라인 및 배경색 설정</button>
                                <button type="button" class="cont-add" >+ 컨텐츠 추가</button>
                                <span>
                                    <input type="checkbox" class="r_chk" name="dan_remove[]" value="<?php echo $dan['idx'] ?>" >
                                    삭제
                                </span>

                                <?php
                                    $dan_content = $db::fetchAll("dan_content", "dan_idx = ?", [$dan['idx']]);
                                ?>
                                <ul class="m-cont">
                                    <?php foreach ($dan_content as $key => $content): ?>
                                        <?php
                                            $label = "미설정";
                                            if($content["type"] == "board") {
                                                $board = $db::fetch("board_set", "idx = ?", [$content["board"]]);
                                                $label = "게시판 - ".$board['name'];
                                            } else if($content["type"] == "banner") {
                                                $label = "배너 - ".fm($content["def_img"]);
                                            };
                                        ?>
                                        <li class="cont-item" data-idx="<?php echo $content['idx'] ?>">
                                            <p><span>↕</span> 컨텐츠 : <?php echo $label ?></p>
                                            <button type="button" class="cont-set" >컨텐츠 설정</button>
                                            <input type="checkbox" class="r_chk" name="cont_remove[]" value="<?php echo $content['idx'] ?>" > 삭제
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        <?php endforeach ?>
                    </div>
                </form>

                <div class="save-btn">
                    <button type="button">변경사항 적용하기</button>
                </div>
            </div>
        </div>

        <div id="footer">
            <div class="copy">
                <p>COPYRIGHT (c) 2018 ALL RIGHTS RESERVED.</p>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function() {
            mp();
        })
    </script>
</body>

</html>
