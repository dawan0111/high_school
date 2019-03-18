
    
    <div class="container">
        <div class="page-header">
            <h3>관리자 도구</h3>
        </div>
        <div class="row">
            <div class="col-md-2">
                <ul class="nav nav-pills nav-stacked">
                    <li role="presentation"><a href="/page/admin">게시판 현황</a></li>
                    <li role="presentation"><a href="/page/boardsetting">게시판 관리</a></li>
                    <li role="presentation" class="active"><a href="/page/admintag">허용태그 관리</a></li>
                </ul>
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">일반 게시판에 허용할 태그를 체크하세요</div>
                    <div class="panel-body">
                        <form class="form-inline" method="post" action="/board/tagSetup">
                            <div class="form-group">
                                <?php foreach(['A', 'B', 'I', 'Img'] as $key => $value) { ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="tag[]" value="<?php echo $value ?>" <?php echo in_array($value, $tag) ? "checked" : "" ?> /> <?php echo $value ?> 태그
                                        </label>
                                    </div>
                                <?php } ?>
                            </div>
                            <button type="submit" class="btn btn-default">설정하기</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>