<link rel="stylesheet" type="text/css" href="/css/board.css">

<?php
    $board = $db::fetch("board", "idx = ?", [$idx]);
    $db::update("board", [
        "hit" => ++$board["hit"],
    ], "idx = ?", [$idx]);
?>
<div id="contents" class="bd-view">
    <div class="wrap">
        <div class="page-title">
            <h2><?php echo $_SESSION["menu"]["name"] ?></h2>
        </div>

        <div class="bd-title">
            <h5>No.<?php echo $board['idx'] ?></h5>
            <h3><?php echo $board['title'] ?></h3>
        </div>
        <?php $images = gi($board); ?>
        <div class="bd-text">
            <div class="img-area">
                <?php if ($images): ?>
                    <?php foreach ($images as $key => $image): ?>
                        <img src="/upload/<?php echo $image ?>" alt="image">
                    <?php endforeach ?>
                <?php endif ?>
            </div>
            <div class="text">
                <?php echo nl2br($board['text']) ?>
            </div>
        </div>

        <div class="bd-info">
            <p class="username"><b>작성자</b> : <?php echo $board['writer'] ?></p>
            <p class="date"><b>작성일시</b> : <?php echo $board['datetime'] ?></p>

            <p class="hit"><b>조회수</b> : <?php echo $board['hit'] ?></p>
        </div>

        <div class="file-l">
            <span>첨부파일</span>
            <ul>
                <?php foreach (explode(">", $board["file"]) as $key => $file): ?>
                    <?php if (file_exists(ROOT."/upload/".$file)): ?>
                        <li><a href="/upload/<?php echo $file ?>" download="<?=fm($file, false) ?>" ><?php echo fm($file, false) ?></a></li>
                    <?php endif ?>
                <?php endforeach ?>
            </ul>
        </div>

        <?php if (USER): ?>
            <div class="save-btn">
                <button onclick="location.href='/board/modify/<?php echo $board['idx'] ?>'">글 수정</button>
                <button onclick="location.href='/board/delete/<?php echo $board['idx'] ?>'">글 삭제</button>
            </div>
        <?php endif ?>
    </div>
</div>