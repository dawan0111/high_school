    <div class="container">
        <h3>예약하기</h3>
        <ul class="nav nav-pills nav-justified">
            <li><a href="/reserve/c">수동 예약</a></li>
            <li class="active"><a href="/reserve/a">자동 예약</a></li>
        </ul>
        <div class="panel"></div>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <p>* 각 층별로 홀수실은 육지, 짝수실은 바다를 바라보고 있습니다.</p>
                        <form class="form-horizontal areserve-form" method="get" action="/reserve/a">
                            <div class="input-group">
                                <span class="input-group-addon">입실</span>
                                <input type="date" class="form-control date indate" name="indate" value="<?php echo @$_GET['indate'] ?>" required>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">퇴실</span>
                                <input type="date" class="form-control date outdate" name="outdate" value="<?php echo @$_GET['outdate'] ?>" required>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">객실수</span>
                                <input type="number" class="form-control" name="roomCount" value="<?php echo @$_GET['roomCount'] ?>" required>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">연속객실</span>
                                <input type="number" class="form-control" name="connectCount" value="<?php echo @$_GET['connectCount'] ?>" required>
                            </div>
                            <label><input type="radio" name="side" <?php if(@$_GET["side"] == "sea" || !isset($_GET["side"])) { ?> checked <?php } ?> value="sea"> 바다쪽</label>&nbsp;&nbsp;&nbsp;
                            <label><input type="radio" name="side" <?php if(@$_GET["side"] == "land") { ?> checked <?php } ?> value="land"> 육지쪽</label>
                            <input type="submit" class="btn btn-success btn-block" value="조건 검색">
                            <?php if (isset($error) && $error): ?>
                                <p class="alert alert-danger">조건에 맞는 방이 없습니다.</p>
                            <?php endif ?>
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <p class="text-right">* 동일 조건으로 여러가지 검색된다면 최상층을 표시합니다. 동일층에서 여러조건을 만족시 객실번호가 빠른 순으로 표시합니다.</p>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h4>검색 결과</h4>
                                <?php if (isset($error) && !$error): ?>
                                    <?php foreach ($floors as $key => $floor): ?>
                                        <table class="table table-bordered hotel-view">
                                            <tr>
                                                <?php for ($i=1; $i <= 20; $i+=2) {  ?>
                                                    <?php
                                                        $number = $floor.sprintf("%02d", $i);
                                                        $class = "";

                                                        if(in_array($number, $reserve))
                                                            $class = "class='bg-primary'";

                                                        if(in_array($number, $resRoom))
                                                            $class = "class='bg-info'";
                                                    ?>
                                                    <td <?php echo $class ?>><?php echo $number ?></td>
                                                <?php } ?>
                                            </tr>
                                            <tr>
                                                <td colspan="10"><?php echo $floor ?>층</td>
                                            </tr>
                                            <tr>
                                                <?php for ($i=2; $i <= 20; $i+=2) {  ?>
                                                    <?php
                                                        $number = $floor.sprintf("%02d", $i);
                                                        $class = "";

                                                        if(in_array($number, $reserve))
                                                            $class = "class='bg-primary'";

                                                        if(in_array($number, $resRoom))
                                                            $class = "class='bg-info'";
                                                    ?>
                                                    <td <?php echo $class ?>><?php echo $number ?></td>
                                                <?php } ?>
                                            </tr>                                    
                                        </table><br>
                                    <?php endforeach ?>
                                <?php endif ?>
                                <form class="form-horizontal areserve-form" method="post" action="/reserve/reserve">
                                    <div class="input-group">
                                        <span class="input-group-addon">방 번호</span>
                                        <input type="text" class="form-control" value="<?php echo @join(",", $resRoom); ?>" name="number" readonly required>
                                        <input type="hidden" name="indate" value="<?php echo @$_GET["indate"] ?>">
                                        <input type="hidden" name="outdate" value="<?php echo @$_GET["outdate"] ?>">
                                    </div>
                                    <input type="submit" class="btn btn-success btn-block" value="예약하기" <?php if (!isset($resRoom) || count($resRoom) == 0): ?> disabled <?php endif ?>>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $(".date").on({
                change : function() {
                    var indate = $(".indate").val(),
                        outdate = $(".outdate").val();

                    if(indate == "" || outdate == "")
                        return false;

                    if(new Date(indate).getTime() > new Date(outdate).getTime()) {
                        $(".outdate").val("");

                        alert("입실이 퇴실보다 미래일 수는 없습니다.");
                    }
                },
            });
        })
    </script>
</body>
</html>