        <div id="contents" class="board-set">
            <div class="wrap">
                <div class="page-title">
                    <h3>게시판 설정</h3>
                </div>

                <div class="board-cnt">
                    <h5>게시판</h5>
                </div>

                <div class="board-table">
                    <?php
                        $board = $db::fetchAll("board_set", 1, [], "*, (SELECT COUNT(*) FROM board WHERE bds_idx = board_set.idx) as count");
                    ?>
                    <table>
                        <colgroup>
                            <col style="width:15%">
                            <col style="width:50%">
                            <col style="width:15%">
                            <col style="width:20%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>게시판 이름</th>
                                <th>게시글 총개수</th>
                                <th>수정/삭제</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($board as $key => $data): ?>
                                <tr>
                                    <td><?php echo $data['name'] ?></td>
                                    <td><?php echo $data["count"] ?></td>
                                    <td><button type="button" onclick="location.href='/admin/boardmodify/<?php echo $data['idx'] ?>'" >수정/삭제</button></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>

                <div class="save-btn">
                    <button type="button" onclick="location.href='/admin/boardadd'" >게시판 생성</button>
                </div>
            </div>
        </div>

        <div id="footer">
            <div class="copy">
                <p>COPYRIGHT (c) 2018 ALL RIGHTS RESERVED.</p>
            </div>
        </div>
    </div>

</body>

</html>
