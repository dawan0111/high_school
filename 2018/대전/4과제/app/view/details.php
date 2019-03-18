
  <div class="my-3 my-md-5">
    <div class="container">
      <div class="page-header">
        <!-- page title start-->
        <h1 class="page-title">
           주문내역
        </h1>
        <!-- page title end-->
      </div>

      <!-- contents start -->
      <div class="col-12">
        <div class="row">
          <div class="col-6 mb-2 text-left">
            <h3 style="color: red;">총 결제금액 : <?php echo sum($baskets) ?>원</h3> 
          </div>
          <!-- 관리자모드 -->
          <?php if (USER['type'] == 3): ?>
            <div class="col-6 mb-2 text-right">
              <select class="custom-select col-4">
                <option value="">회원검색</option>
                <?php foreach ($members as $key => $data): ?>
                  <?php $selected = $data["idx"] == $user ? "selected" : ""; ?>
                  <option value="<?php echo $data['idx'] ?>" <?php echo $selected ?>><?php echo $data['name'] ?>[<?php echo $data['id'] ?>]</option>
                <?php endforeach ?>
              </select>
              <button type="button" class="ok-btn btn btn-secondary btn-space">확인</button>
            </div>
          <?php endif ?>

          <div class="col-12">
            <div class="card">
              <div class="table-responsive">
                <table class="table table-bordered table-vcenter text-nowrap card-table">
                  <thead>
                    <tr>
                      <th>결제일자</th>
                      <th>가맹점정보</th>
                      <th>메뉴이름</th>
                      <th>가격</th>
                      <th>수량</th>
                      <th>주문상태</th>
                      <th>총 합계</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($baskets as $key => $data): ?>
                      <tr>
                        <?php if (isset($data["ymd_count"])): ?>
                          <td class="text-center"  rowspan="<?php echo $data['ymd_count'] ?>">
                            <?php echo $data["date"] ?>
                          </td>
                        <?php endif ?>
                        <?php if (isset($data["store_count"])): ?>
                          <td class="text-center" rowspan="<?php echo $data['store_count'] ?>">
                            <img src="/upload/<?php echo $data['logo'] ?>" alt="">
                            <p class="m-0">
                              <small><?php echo $data['store_name'] ?></small>
                            </p>
                          </td>
                        <?php endif ?>
                        <td class="text-center">
                          <?php echo $data['food_name'] ?>
                        </td>
                        <td class="text-center">
                          <?php echo number_format($data["food_price"]) ?>원
                        </td>
                        <td class="text-center">
                          <?php echo $data['quantity'] ?>개
                        </td>
                        <?php if (isset($data["store_count"])): ?>
                          <td class="text-center" rowspan="<?php echo $data['store_count'] ?>">
                            <?php if ($data["order_state"] == 1): ?>
                              배송중
                            <?php else: ?>
                              배송완료
                              <?php if (USER['type'] != 3): ?>
                                <p class="m-0">
                                  <a href="/review/write?s_user_idx=<?php echo $data['s_user_idx'] ?>&buy_date=<?php echo $data['buy_date'] ?>" class="btn btn-sm btn-outline-primary">리뷰작성</a>
                                </p>
                              <?php endif ?>
                            <?php endif ?>
                          </td>
                        <?php endif ?>
                        <?php if (isset($data["order_count"])): ?>
                          <td class="text-center" rowspan="<?php echo $data['order_count'] ?>">
                            <?php echo $data['order_sum'] ?>원
                          </td>
                        <?php endif ?>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          
        </div>
      </div>
      <!-- contents end -->

    </div>
  </div>
</div>