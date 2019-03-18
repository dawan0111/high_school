
    
    <div class="container">
        <div class="page-header">
            <h3>관리자 도구</h3>
        </div>
        <div class="row">
            <div class="col-md-2">
                <ul class="nav nav-pills nav-stacked">
                    <li role="presentation"><a href="/page/admin">게시판 현황</a></li>
                    <li role="presentation" class="active"><a href="/page/boardsetting">게시판 관리</a></li>
                    <li role="presentation"><a href="/page/admintag">허용태그 관리</a></li>
                </ul>
            </div>
            <div class="col-md-10">
                    <div class="col-md-5" style="margin-top: 10px;">
                        <h2>일반 게시판</h2>
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <tr>
                                    <th>게시판 이름</th>
                                    <th>삭제</th>
                                </tr>
                                <?php foreach($nboard as $key => $board) { ?>
                                    <tr>
                                        <td><?php echo $board['boardname']; ?></td>
                                        <td><a href="/board/delete/<?php echo $board['id'] ?>">삭제</a></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>

                        <?php if(count($nboard) != 5) { ?>
                        <form class="form-horizontal" method="post" action="/board/adminAddn">
                            <div class="form-group col-md-12">
                                <div class="col-md-12 input-group">
                                    <input type="text" class="form-control" id="normalBoard" name="normalBoard"/>
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-default" id="addNBoard">게시판 추가</button>
                                    </span>
                                </div>
                            </div>
                        </form>
                        <?php } else { ?>
                            게시판은 5개 까지 추가 가능합니다.
                        <?php } ?>
                    </div>
                    <div class="col-md-5" style="margin-top: 10px;">
                        <h2>사진 게시판</h2>
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <tr>
                                    <th>게시판 이름</th>
                                    <th>삭제</th>
                                </tr>
                                <?php foreach($pboard as $key => $board) { ?>
                                    <tr>
                                        <td><?php echo $board['boardname']; ?></td>
                                        <td><a href="#">삭제</a></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                        <?php if(count($pboard) != 5) { ?>
                        <form class="form-horizontal" method="post" action="/board/adminAddp">
                            <div class="form-group col-md-12">
                                <div class="col-md-12 input-group">
                                    <input type="text" class="form-control" id="normalBoard" name="photoBoard" min="0" max="5" placeholder="사진게시판 이름을 입력"/>
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-default" id="addNBoard">게시판 추가</button>
                                    </span>
                                </div>
                            </div>
                        </form>
                        <?php } else { ?>
                            게시판은 5개 까지 추가 가능합니다.
                        <?php } ?>
                    </div>
            </div>
        </div>

    </div>
</body>
</html>