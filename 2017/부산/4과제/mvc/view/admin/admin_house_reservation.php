<div id="fh5co-main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    펜션 예약 목록
                </div>
                <select id="place">
                    <option value="">팬션 선택</option>
                    <?php foreach($houseList as $key => $value) { ?>
                        <?php $selected = ""; ?>
                        <?php if($value['name'] == $place) { ?>
                            <?php $selected = "selected"; ?>
                        <?php } ?>
                        <option <?php echo $selected ?>><?php echo $value['name'] ?></option>
                    <?php } ?>
                </select>
                <table class="table table-bordered">
                    <?php foreach($resList as $key => $res) { ?>
                        <tr>
                            <td>
                                <?php echo date("Y년m월d일", strtotime($res['startdate'])) ?>
                                <?php if(strtotime($res['startdate']) != strtotime($res['enddate']) - 86400) { ?>
                                    <?php echo " ~ ".date("Y년m월d일", strtotime($res['enddate'])) ?>
                                <?php } ?>
                            </td>
                            <td><?php echo $res["resname"] ?></td>
                            <td><?php echo $res["money"] ?></td>
                            <td>
                                <?php if($res['money'] == "입금확인") { ?>
                                    <button class="btn btn-danger btn-sm" onclick="location.href='/res/change/<?php echo $res['idx'] ?>?type=예약완료'">입금확인</button>
                                <?php } else if($res["money"] == "예약완료") { ?>
                                    <button class="btn btn-danger btn-sm" onclick="location.href='/res/change/<?php echo $res['idx'] ?>?type=환불대기'">취소하기</button>
                                <?php } else if($res["money"] == "환불대기") { ?>
                                    <button class="btn btn-danger btn-sm" onclick="location.href='/res/change/<?php echo $res['idx'] ?>?type=예약취소'">환불완료</button>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

        </div>
    </div>
</div>