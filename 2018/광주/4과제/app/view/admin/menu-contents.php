
        <div id="contents" class="menu_contents">
            <div class="wrap">
                <div class="page-title">
                    <h3>메뉴별 컨텐츠</h3>
                </div>

                <?php
                    $result = [];
                    $first_menu = $db::fetchAll("menu", "parent = 0 order by sort asc");

                    foreach ($first_menu as $key => $menu) {
                        $result[] = $menu;
                        $sub_menu = $db::fetchAll("menu", "parent = ? order by sort asc", [$menu['idx']]);

                        $result = array_merge($result, $sub_menu);
                    };
                ?>

                <table>
                    <thead>
                        <th>1차 메뉴</th>
                        <th>2차 메뉴</th>
                        <th>컨텐츠 구성</th>
                    </thead>

                    <tbody>
                        <?php foreach ($result as $key => $menu): ?>
                            <?php
                                $label = "";
                                if($menu["type"] == "board") {
                                    $board = $db::fetch("board_set", "idx = ?", [$menu["board"]]);
                                    $label = "게시판 - ".$board['name'];
                                } else if($menu["type"] == "html") {
                                    $label = "HTML";
                                };
                            ?>
                            <tr>
                                <?php if ($menu['parent'] == 0): ?>
                                    <td style="background-color:#3a3a3a; color:#fff;"><?php echo $menu['name'] ?></td>
                                    <td></td>
                                <?php else: ?>
                                    <td></td>
                                    <td style="background-color:#3a3a3a; color:#fff;"><?php echo $menu['name'] ?></td>
                                <?php endif ?>
                                <td>
                                    <?php if ($menu['parent'] != 0): ?>
                                        <?php echo $label ?>
                                        <button type="button" data-idx="<?php echo $menu['idx'] ?>" class="cont-change">변경</button>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="footer">
            <div class="copy">
                <p>COPYRIGHT (c) 2018 ALL RIGHTS RESERVED.</p>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(".cont-change").on("click", function() {
            var idx = $(this).data("idx");
            popup("/admin/menucontset/"+idx);
        });
    </script>
</body>

</html>
