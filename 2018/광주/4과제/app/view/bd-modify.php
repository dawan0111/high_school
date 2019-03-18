<link rel="stylesheet" type="text/css" href="/css/board.css">
<?php
    $board = $db::fetch("board", "idx = ?", [$idx]);
    $board_set = $db::fetch("board_set", "idx = ?", [$board["bds_idx"]]);

    $files = explode(">", $board["file"]);
?>
<div id="contents">
    <div class="write-frm">
        <div class="wrap">
            <form method="post" action="/board/modify/<?php echo $board['idx'] ?>" enctype="multipart/form-data">
                <div class="frm-ctrl">
                    <label for="title">게시글 제목</label>
                    <input type="text" name="title" value="<?php echo $board['title'] ?>" id="title">
                </div>

                <div class="frm-ctrl">
                    <label for="file">첨부 파일</label>
                    <div class="u_file">
                        <?php for ($i=1; $i <= $board_set['upload_cnt']; $i++) {  ?>
                            <div class="f-list">
                                <button type="button" class="f_btn">파일 선택</button> <span><?php echo fm($files[$i - 1] ?? "") ?></span>
                                <input type="file" name="file<?php echo $i ?>" id="file" style="display:none;">
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="frm-ctrl">
                    <textarea name="text" placeholder="글 내용"><?php echo $board['text'] ?></textarea>
                </div>

                <div class="write-btn">
                    <button type="submit">수정</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        var max = "<?php echo $board_set['upload_size'] ?>";
        $(".f_btn").on("click", function() {
            $(this).next().next().click();
        });

        $("input[type='file']").on("change", function() {
            var file = this.files[0];

            if(file.size > max * 1024 * 1024) {
                alert("파일 크기는 "+max+"mb 이하만 가능합니다.");
                $(this).val("");
                return false;
            };

            $(this).prev().html(file.name);
        });
    });
</script>