
    
    <div class="container">
        <div class="page-header">
        <h3>자유게시판</h3>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <table class="table table-striped">
                <tbody>
                        <tr>
                            <th>글번호</th><th width="60%">제목</th><th>작성일</th><th>작성자</th>
                        </tr>
                    <?php foreach($all_post as $key => $post) { ?> 
                        <tr>
                            <td><?php echo $post['idx'] ?></td>
                            <td> <a href="/page/normalboardView/<?php echo $post['idx'] ?>"><?php echo $post['title'] ?></a></td>
                            <td> <?php echo date("Y-m-d", strtotime($post['date'])) ?></td>
                            <td><?php echo $post['writer'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
            <div class="text-center">
                <ul class="pagination">
                    <?php $disabled = $pageing['page'] == 1 ? true : false; ?>
                    <?php if($disabled) { ?>
                        <li class="disabled"><span>«</span></li>
                    <?php } else { ?>
                        <li onclick="location.href='/page/normalboard/<?php echo $idx ?>?page=<?php echo $pageing['page']-1 ?>'"><span>«</span></li>
                    <?php } ?>
                    <?php for ($i=1; $i <= $pageing['block_end']; $i++) {  ?>
                        <?php $selected = $i == $pageing['page'] ? "active" : ""; ?>


                        <li class="<?php echo $selected ?>"
                            <?php if($i <= $pageing['total_page']) { ?>
                            onclick="location.href='/page/normalboard/<?php echo $idx ?>?page=<?php echo $i ?>'"
                            <?php } ?>  
                        ><span><?php echo $i ?></span></li>
                    <?php } ?>

                    <?php if($pageing['total_page'] == $pageing['page']) { ?>
                        <li class="disabled"><span>»</span></li>
                    <?php } else {  ?>
                        <li onclick="location.href='/page/normalboard/<?php echo $idx ?>?page=<?php echo $pageing['page']+1 ?>'"><span>»</span></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 col-md-offset-10">
                <?php if(isset($_SESSION['id'])) { ?>
                    <a href="/page/normalboardWrite/<?php echo $idx ?>" class="btn btn-primary">글작성</a>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>