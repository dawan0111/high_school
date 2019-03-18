
    <div class="container">
        <div class="page-header">
            <h3>자유게시판 의 <?php echo $post['idx'] ?>번 글 </h3>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $post['title'] ?></h3>
            </div>
            <div class="panel-body">
                <p id="content">                       
                    <?php echo $post['content'] ?>
                </p>
            </div>
            <div class="panel-footer">
                <div class="row">
                <div class="col-md-6"><span class="writer"><?php echo $post['writer'] ?></span>&nbsp;&nbsp;<span class="date"><?php echo $post['date'] ?></span></div>
                <div class="col-md-6 btns text-right">
                    <?php if(isset($_SESSION['id'])) { ?>
                        <?php if($_SESSION['id']['id'] == $post['id']) { ?>
                            <a href="/page/boardModify/<?php echo $post['idx'] ?>" class="btn btn-success">수정</a>
                            <a href="/post/delete/<?php echo $post['idx'] ?>" onclick="return confirm('정말 삭제할까요?') ? true : false;" class="btn btn-danger">삭제</a>
                        <?php } ?>
                    <?php } ?>
                    <a href="/page/normalboard/<?php echo $post['boardidx'] ?>" class="btn btn-primary">목록으로</a>                    
                </div>
            </div>                         
            </div>
        </div>
    </div>
</body>
</html>