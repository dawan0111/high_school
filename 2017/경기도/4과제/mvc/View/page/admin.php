
    <div class="container">
        <div class="page-header">
            <h3>관리자 도구</h3>
        </div>
        <div class="row">
            <div class="col-md-2">
                <ul class="nav nav-pills nav-stacked">
                    <li role="presentation" class="active"><a href="/page/admin">게시판 현황</a></li>
                    <li role="presentation"><a href="/page/boardsetting">게시판 관리</a></li>
                    <li role="presentation"><a href="/page/admintag">허용태그 관리</a></li>
                </ul>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="com-md-10">
                        <form class="form-inline" method="get">
                            <div class="form-group">
                                <label for="bid">게시판</label>
                                <select class="form-control" name="bid" id="bid">
                                    <?php foreach($board as $key => $value) { ?>
                                        <option value="<?php echo $value['id'] ?>" <?php echo $value['id'] == $bid ? "selected" : "" ?>><?php echo $value['boardname'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group" style="margin-left:20px;">
                                <label for="bid">그래프 단위</label>
                                <div class="radio" style="margin-left:20px;">
                                    <label>
                                        <input type="radio" name="term" id="term" value="min" <?php echo $unit == "min" ? "checked" : "" ?> >분
                                    </label>
                                </div>
                                <div class="radio" style="margin-left:20px;">
                                    <label>
                                        <input type="radio" name="term" id="term" value="hour" <?php echo $unit == "hour" ? "checked" : "" ?> >시
                                    </label>
                                </div>
                                <div class="radio" style="margin-left:20px;">
                                    <label>
                                        <input type="radio" name="term" id="term" value="day" <?php echo $unit == "day" ? "checked" : "" ?> >일
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-default">그래프 보기</button>
                        </form>
                    </div>
                </div>
                <div class="row" style="margin-top:20px;">
                    <h3>자유게시판 의 글 작성 개수 </h3>
                    <?php echo $image ?>
                </div>
            </div>
        </div>
    </div>

</body></html>