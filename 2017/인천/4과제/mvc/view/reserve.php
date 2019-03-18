    <div class="container">
        <div class="page-header">
            <h3>예약 결제</h3>
        </div>
        <div class="row" style="margin-bottom:10px;">
            <div class="col-lg-4">
                <div class="input-group">
                    <span class="input-group-addon">입실</span>
                    <input type="date" class="form-control" value="<?php echo $_POST["indate"] ?>" readonly>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="input-group">
                    <span class="input-group-addon">퇴실</span>
                    <input type="date" class="form-control" value="<?php echo $_POST["outdate"] ?>" readonly>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <?php foreach ($floors as $key => $floor): ?>
                        <div class="col-lg-6">
                            <table class="table table-bordered hotel-view">
                                <tr>
                                    <?php for ($i=1; $i <= 20; $i+=2) {  ?>
                                        <?php
                                            $number = $floor.sprintf("%02d", $i);
                                            $class = "";

                                            if(in_array($number, $reserve))
                                                $class = "class='bg-primary'";

                                            if(in_array($number, $_POST["number"]))
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

                                            if(in_array($number, $_POST["number"]))
                                                $class = "class='bg-info'";
                                        ?>
                                        <td <?php echo $class ?>><?php echo $number ?></td>
                                    <?php } ?>
                                </tr>
                            </table>
                        </div>
                    <?php endforeach ?>
                    <div class="col-lg-12">
                        <form class="form-inline reserve-form" method="post" action="/reserve/reserveRoom">
                            <div class="input-group">
                                <span class="input-group-addon">방 번호</span>
                                <input type="text" class="form-control" name="number" value="<?php echo implode(",", $_POST["number"]) ?>" readonly>
                            </div>
                            <div class="input-group">
                                <span class="btn btn-warning">총합 : <span class="badge"><?php echo number_format($totalPrice) ?>원</span></span>
                            </div>
                            <input type="hidden" name="indate" value="<?php echo $_POST['indate'] ?>">
                            <input type="hidden" name="outdate" value="<?php echo $_POST['outdate'] ?>">
                            <input type="hidden" name="price" value="<?php echo $totalPrice ?>">
                            <div class="input-group pull-right">
                                <button class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> 결제하기</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>