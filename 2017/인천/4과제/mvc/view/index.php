    <div class="container">
        <div class="page-header">
            <h2>오늘의 예약 현황</h2>
        </div>
        <div class="row" style="margin-bottom:10px;">
            <form method="get">
                <div class="col-lg-6 col-lg-offset-6">
                    <div class="input-group">
                        <span class="input-group-addon">오늘날짜</span>
                        <?php
                            $date = v($_GET["date"], date("Y-m-d"));
                        ?>
                        <input type="date" name="date" class="form-control" value="<?php echo $date ?>" required>
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">보기</button>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <p>* 각 층별로 홀수실은 육지, 짝수실은 바다를 바라보고 있습니다.</p>
        </div>
        <?php for ($floor=1; $floor <=5; $floor++) {  ?>
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $floor ?>층
                    <span class="label label-primary pull-right">사용중</span>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered hotel-view">
                        <tr>
                            <?php for ($i=1; $i <= 20; $i+=2) {  ?>
                                <?php
                                    $number = $floor.sprintf("%02d", $i);
                                    $class = "";

                                    if(in_array($number, $reserve))
                                        $class = "class='bg-primary'";
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
                                ?>
                                <td <?php echo $class ?>><?php echo $number ?></td>
                            <?php } ?>
                        </tr>
                    </table>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
</html>
