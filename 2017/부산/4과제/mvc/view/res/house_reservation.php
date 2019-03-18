<?php
    $firstyoil = date("w", strtotime(date("Y-m", $strDate)."-01"));
    $lastDay = date("t", $strDate);

    $weekCount = ceil($lastDay / 7);
?>

<div id="fh5co-main">
    <div class="container">
        <div class="row">
            <div class="page-header col-md-offset-2 col-md-9">
                날짜 선택
            </div>
            <div class="col-md-12">
                <div class="col-md-offset-2 col-md-9">
                    <table class="table table-bordered" id="date_table">
                        <tr>
                            <th class="text-center" onclick="location.href='/house/house_reservation/<?php echo $houseidx ?>?moveMonth=<?php echo $moveMonth-1 ?>'"><</th>
                            <th colspan="5" class="text-center">
                                <?php echo date("Y", $strDate) ?>년
                                <?php echo date("m", $strDate) ?>월
                            </th>
                            <th class="text-center" onclick="location.href='/house/house_reservation/<?php echo $houseidx ?>?moveMonth=<?php echo $moveMonth+1 ?>'">></th>
                        </tr>
                        <tr>
                            <th class="text-center"><spqn style="color:red;">일</spqn></th>
                            <th class="text-center">월</th>
                            <th class="text-center">화</th>
                            <th class="text-center">수</th>
                            <th class="text-center">목</th>
                            <th class="text-center">금</th>
                            <th class="text-center">토</th>
                        </tr>

                        <?php for ($i=0; $i < $weekCount; $i++) { ?>
                            <tr>
                                <?php for ($j=1; $j <= 7; $j++) {  ?>
                                    <?php
                                        $day = $i * 7 + $j - $firstyoil;

                                        if($day <= 0 || $day > $lastDay)
                                            $day = "";

                                        $type = true;

                                        if(in_array(date("Y-m", $strDate)."-{$day}", $resDate)) {
                                            $type = false;
                                        };
                                    ?>

                                    <td class="text-center" <?php if(isset($_SESSION['id']) && $day != "" && $type) { ?> onclick="location.href='/house/house_reservation2/<?php echo $houseidx ?>?day=<?php echo date("Y-m", $strDate)."-".$day ?>'" <?php } ?>>
                                        <?php if($day != "") { ?>
                                            <?php echo $day ?><br>
                                            <?php if($type) { ?>
                                                예약가능
                                            <?php } else { ?>
                                                예약 불가능
                                            <?php } ?>
                                        <?php } ?>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php }; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
