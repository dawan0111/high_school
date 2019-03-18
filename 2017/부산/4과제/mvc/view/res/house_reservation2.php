


<div id="fh5co-main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal" method="post" action="/res/addres">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="inputHouse">펜션명</label>
                        <div class="col-sm-6">
                            <input class="form-control" id="" type="text" placeholder="예약자명" name="housename" value="<?php echo $house['name'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="inputDate">예약날짜</label>
                        <div class="col-sm-6">
                            <input type="hidden" name="resdate" value="<?php echo $_GET['day'] ?>">
                            <input class="form-control" id="" type="text" placeholder="예약자명" value="<?php echo date("Y년m월d일", strtotime($_GET['day'])) ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="inputCost">가격</label>
                        <div class="col-sm-6">
                            <input class="form-control" id="" type="text" placeholder="가격" name="price" value="<?php echo $house['price'] ?>원" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="inputCost">예약일수</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="" name="resday">
                                <?php for ($i=1; $i <= $applyCount; $i++) { ?> 
                                    <option value="<?php echo $i ?>"><?php echo $i ?>일</option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="inputName">예약자성명</label>
                        <div class="col-sm-6">
                            <input class="form-control" id="" type="txt" placeholder="예약자성명" name="resname" value="<?php echo $_SESSION['id']['name'] ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="inputPasswordCheck">휴대폰번호</label>
                        <div class="col-sm-6">
                            <input class="form-control" id="" type="tel" placeholder="010-0000-0000" name="phone" value="<?php echo $_SESSION['id']['phone'] ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12 text-center">
                            <button class="btn btn-primary" type="submit">예약하기<i class="fa fa-check spaceLeft"></i></button>
                            <a href="/"><button class="btn btn-danger" type="button">취소하기<i class="fa fa-times spaceLeft"></i></button></a>
                        </div>
                    </div>
                </form>
                <hr>
            </div>
        </div>
    </div>
</div>