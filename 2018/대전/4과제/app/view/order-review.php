
  <div class="my-3 my-md-5">
    <div class="container">
      <div class="page-header">
        <!-- page title start-->
        <h1 class="page-title">
          <?php echo $store['store_name'] ?> 리뷰
        </h1>
        <!-- page title end-->
      </div>

      <!-- contents start -->
      <div class="col-12">
        <div class="row">
            <div class="col-12">
              <div class="mb-2 text-right">
                <button type="submit" class="btn btn-primary" onclick="loc('/order/menu/<?php echo $store['user_idx'] ?>')">메뉴목록</button>
              </div>
            </div>

            <?php foreach ($reviews as $key => $review): ?>
              <div class="card">
                <div class="card-body1 p-5">
                  <article class="media">
                    <div class="media-body">
                      <div class="content">
                        <p class="h5">
                          <small><?php echo $review['user_name'] ?> (<?php echo str_pad(mb_substr($review['user_id'], 0, 3), mb_strlen($review["user_id"]), "*") ?>)</small> 
                          <small>평점 : <?php echo $review['star'] ?>점</small> 
                          <small class="float-right text-muted"><?php echo date("Y. m. d", strtotime($review["create_date"])) ?></small>
                        </p>
                        <p>
                          <?php echo nl2br($review['content']) ?>
                        </p>
                      </div>
                    </div>
                  </article>
                </div>
              </div>
            <?php endforeach ?>

        </div>
      </div>
      <!-- contents end -->

    </div>
  </div>
</div>