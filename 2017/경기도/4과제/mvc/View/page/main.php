    
    <div class="container">
        <div class="well">
            <?php echo $webSite['description'] ?>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div id="titleSlide" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <?php foreach($webSite['slideImage'] as $key => $image) { ?>
                            <li data-target="#titleSlide" data-slide-to="<?php echo $key ?>" class="<?php echo $key == 0 ? "active" : "" ?>"></li>
                        <?php } ?>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <?php foreach($webSite['slideImage'] as $key => $image) { ?>
                                <div class="item <?php echo $key == 0 ? "active" : "" ?> ">
                                    <img src="/upload/<?php echo $image ?>">
                                </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php if(isset($normalBoard['id'])) { ?>
            <div class="row" style="margin-top:20px;">
                <h3>자유게시판</h3>
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th>글번호</th><th width="60%">제목</th><th>작성일</th><th>작성자</th>
                        </tr>
                        <?php foreach($main_post as $key => $value) { ?>
                            <tr>
                                <td><?php echo $value['idx'] ?></td>
                                <td> <a href="/page/normalboardView/<?php echo $value['idx'] ?>"><?php echo $value['title'] ?></a> </td>
                                <td><?php echo date("Y-m-d", strtotime($value['date'])) ?></td>
                                <td><?php echo $value['writer'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>

        <div class="row" style="margin-top:20px;">
            <h3>사진자랑</h3>
            <div class="col-md-8 col-md-offset-2">
                <div id="pSlide" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php foreach($image_post as $key => $value) { ?>
                            <?php $select = $key == 0 ? "active" : ""; ?>
                            <li data-target="#pSlide" data-slide-to="<?php echo $key ?>" class="<?php echo $select ?>"></li>
                        <?php } ?>
                    </ol>

                    <div class="carousel-inner" role="listbox">
                        <?php foreach($image_post as $key => $value) { ?>
                            <?php $active = $key == 0 ? "active" : "" ?>
                            <div class="item <?php echo $active ?>">
                                <img class="img-responsive" style="width:700px; max-height:350px;" src="/upload/<?php echo $value['image'] ?>">
                                <div class="carousel-caption">
                                    <?php $title = $value['title']; ?>
                                    <?php $content = $value['content']; ?>

                                    <?php if(mb_strlen($value['title']) > 20) { ?>
                                        <?php $title = mb_substr($title, 0, 20)."..."; ?>
                                    <?php } ?>
                                    <?php if(mb_strlen($value['content']) > 100) { ?>
                                        <?php $content = mb_substr($content, 0, 100)."..."; ?>
                                    <?php } ?>
                                    
                                    <h3>제목 : <?php echo $title ?> </h3>
                                    <p>5번사진 작성자 : <?php echo $content ?></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>