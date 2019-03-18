
    
    <div class="container">
        <div class="page-header">
            <h3>자유게시판</h3>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form class="form-horizontal" action="/post/normalwrite/<?php echo $idx ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" id="email" value="<?php echo $_SESSION['id']['id'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group  ">
                        <label for="writer" class="col-sm-2 control-label">작성자</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="writer" id="writer" value="<?php echo $_SESSION['id']['name'] ?>" readonly>
                            
                        </div>
                    </div>                          
                    <div class="form-group  ">
                        <label for="title" class="col-sm-2 control-label">제목</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" id="title" placeholder="글 제목" value="">
                            
                        </div>
                    </div>
                    <div class="form-group  ">
                        <label for="content" class="col-sm-2 control-label">글본문</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="8" name="content" id="content"></textarea>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">글쓰기</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>