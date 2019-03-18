


<div id="fh5co-main">
    <div class="container">

        <div class="row">

            <div id="fh5co-board" data-columns>
                <?php foreach($houses as $key => $house) { ?>
                    <div class="item">
                        <div class="animate-box">
                            <a href="/upload/<?php echo $house['image'] ?>" class="image-popup fh5co-board-img"><img src="/upload/<?php echo $house['image'] ?>" ></a>
                        </div>
                        <div class="fh5co-desc">
                            <p>
                                이름 : <?php echo $house['name'] ?><br>
                                가격 : <?php echo $house['price'] ?>원<br>
                                전화번호:<?php echo $house['phone'] ?><br>
                                <button class="btn btn-link" onclick="location.href='/house/delete/<?php echo $house['idx'] ?>'">삭제하기</button>
                            </p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>