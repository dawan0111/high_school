
    
    <div class="container">
        <div class="page-header">
            <h3>사진자랑</h3>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <ul class="media-list">
                    <?php foreach($all_post as $key => $post) { ?>
                        <li class="media">
                            <div class="media-left">
                                <a href="/page/pictureboardView/<?php echo $post['idx'] ?>">
                                    <img class="media-object" src="/upload/<?php echo "somenail_".$post['image'] ?>" width="64" height="64">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $post['title'] ?></h4>
                                <?php echo $post['content'] ?>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="text-center">
                <ul class="pagination">
                    <?php $disabled = $pageing['page'] == 1 ? true : false; ?>
                    <?php if($disabled) { ?>
                        <li class="disabled"><span>«</span></li>
                    <?php } else { ?>
                        <li onclick="location.href='/page/pictureboard/<?php echo $idx ?>?page=<?php echo $pageing['page']-1 ?>'"><span>«</span></li>
                    <?php } ?>
                    <?php for ($i=1; $i <= $pageing['block_end']; $i++) {  ?>
                        <?php $selected = $i == $pageing['page'] ? "active" : ""; ?>


                        <li class="<?php echo $selected ?>"
                            <?php if($i <= $pageing['total_page']) { ?>
                            onclick="location.href='/page/pictureboard/<?php echo $idx ?>?page=<?php echo $i ?>'"
                            <?php } ?>  
                        ><span><?php echo $i ?></span></li>
                    <?php } ?>

                    <?php if($pageing['total_page'] == $pageing['page']) { ?>
                        <li class="disabled"><span>»</span></li>
                    <?php } else {  ?>
                        <li onclick="location.href='/page/pictureboard/<?php echo $idx ?>?page=<?php echo $pageing['page']+1 ?>'"><span>»</span></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="row">
            <?php if(isset($_SESSION['id'])) { ?>
                <div class="col-md-2 col-md-offset-10">
                    <a href="/page/pictureboardWrite/<?php echo $idx ?>" class="btn btn-primary">글작성</a>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>