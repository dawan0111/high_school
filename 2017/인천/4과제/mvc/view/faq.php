    <div class="container">
        <h3>문의하기</h3>
        <div class="panel"></div>
        <div class="chat-panel panel panel-default">
            <div class="panel-body">
                <ul class="chat">
                    <?php foreach ($faqList as $key => $val): ?>
                        <?php
                            $type = $val["fromid"] == $login["id"] ? "right" : "left";

                            $diffTime = strtotime("now") - strtotime($val["date"]);
                            $viewTime = "";

                            if($diffTime < 3600) {
                                $viewTime = floor($diffTime / 60)."분";
                            } elseif ($diffTime < 86400) {
                                $viewTime = floor($diffTime / 3600)."시";
                            } else {
                                $viewTime = date("y-m-d", strtotime($val["date"]));
                            };
                        ?>
                        <li class="<?php echo $type ?> clearfix">
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <?php if ($type == "right"): ?>
                                        <small class="text-muted">
                                            <i class="glyphicon glyphicon-time"></i> <?php echo $viewTime ?> 전
                                        </small>
                                        <strong class="pull-right primary-font"><?php echo $login["name"] ?>님</strong>
                                    <?php else: ?>
                                        <strong class="primary-font"><?php echo $val["fromname"] ?>님</strong>
                                        <small class="pull-right text-muted">
                                            <i class="glyphicon glyphicon-time"></i> <?php echo $viewTime ?> 전
                                        </small>
                                    <?php endif ?>
                                </div>
                                <p>
                                    <?php echo $val["content"] ?>
                                </p>
                            </div>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
            <div class="panel-footer">
                <form class="chat-form" method="post" action="/faq/write">
                    <?php if (isset($_GET["toid"])): ?>
                        <input type="hidden" name="toid" value="<?php echo $_GET["toid"] ?>">
                    <?php endif ?>
                    <textarea class="form-control" cols="30" rows="10" placeholder="문의할 내용을 입력하세요" name="content"></textarea>
                    <button class="btn btn-warning" id="btn-chat">전송</button>
                    <label class="pull-right">A 태그와 Color 태그를 사용할 수 있습니다.</label>
                </form>
            </div>
        </div>
    </div>
</body>
</html>