
  <div class="my-3 my-md-5">
    <div class="container">
      <div class="page-header">
        <!-- page title start-->
        <h1 class="page-title">
           리뷰작성
        </h1>
        <!-- page title end-->
      </div>

      <!-- contents start -->
      <div class="col-12">
        <div class="row">
          
          <div class="card">
            <div class="card-header">
              <h3 class="card-title" style="font-size: 1.2em; font-weight: bold;"><?php echo $store['store_name'] ?> 리뷰작성</h3>
            </div>
            <div class="card-body1 p-5">
              <form method="post" action="/review/write">
                <input type="hidden" name="s_user_idx" value="<?php echo $store['user_idx'] ?>">
                <input type="hidden" name="buy_date" value="<?php echo $_GET['buy_date'] ?>">
                <div class="form-group col-2">
                  <label class="form-label">평점</label>
                  <select class="custom-select" name="star">
                    <option value="">선택</option>
                    <option value="1">1점</option>
                    <option value="2">2점</option>
                    <option value="3">3점</option>
                    <option value="4">4점</option>
                    <option value="5">5점</option>
                  </select>
                </div>


                <div class="form-group col-12">
                  <label class="form-label">리뷰내용</label>
                  <textarea class="form-control" name="content" rows="3"></textarea>
                </div>

                <div class="form-footer col-12">
                  <button type="submit" class="btn btn-primary btn-block">리뷰작성</button>
                </div>
              </form>
            </div>
          </div>
          
          
        </div>
      </div>
      <!-- contents end -->

    </div>
  </div>
</div>