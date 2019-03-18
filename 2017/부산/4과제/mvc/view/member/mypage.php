
<div id="fh5co-main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    펜션 예약 목록
                </div>
                <table class="table table-bordered">
                    <tr>
                        <td>펜션명</td>
                        <td>날짜</td>
                        <td>예약자명</td>
                        <td>상태</td>
                    </tr>
                    <?php foreach($resList as $key => $value) { ?>
                        <tr>
                            <td><?php echo $value["housename"] ?></td>
                            <td>
                                <?php echo date("Y년m월d일", strtotime($value['startdate'])) ?>
                                <?php if(strtotime($value['startdate']) != strtotime($value['enddate']) - 86400) { ?>
                                    <?php echo " ~ ".date("Y년m월d일", strtotime($value['enddate'])) ?>
                                <?php } ?>        
                            </td>
                            <td><?php echo $value["resname"] ?></td>
                            <td>
                                <?php echo $value["money"] ?>
                                <?php if($value['money'] == "예약완료") { ?>
                                    <button class="btn btn-danger btn-sm" onclick="location.href='/res/memberChange/<?php echo $value['idx'] ?>?type=환불대기'">취소하기</button>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

        </div>
    </div>
</div>
