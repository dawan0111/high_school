
  <div class="my-3 my-md-5">
    <div class="container">
      <div class="page-header">
        <!-- page title start-->
        <h1 class="page-title">
          피자스타 메뉴목록 
        </h1>
        <!-- page title end-->
      </div>

      <!-- contents start -->
      <div class="col-12">
        <div class="row">
          
          <div class="card" style="position: fixed; margin-left: 1180px; top: 210px; max-height: 600px; width: 350px; z-index: 900;">
            <div class="card-header">
              <h4 class="card-title" style="font-size: 1.2em; font-weight: bold;">주문함 (<?php echo count($baskets) ?>개)</h4>
            <div class="col text-right">
              <a href="/basket/clear" class="btn btn-sm btn-outline-primary">비우기</a>
            </div>
          
            </div>
            <div class="card-body1 o-auto p-3" style="height: 600px">
              <ul class="list-unstyled list-separated">
                <?php foreach ($baskets as $key => $data): ?>
                  <li class="list-separated-item">
                    <div class="row align-items-center">
                      <div class="col" style="word-break: break-all;">
                        <strong><?php echo $data["food_name"] ?></strong><br>
                        주문수량 : <?php echo number_format($data["quantity"]) ?> 개<br>
                        가 격 : <?php echo number_format($data["food_price"]) ?>원<br>
                        합 계 : (<?php echo number_format($data["total_price"]) ?>원)
                      </div>
                      <div class="col-auto">
                        <a href="/basket/delete/<?php echo $data['bidx'] ?>" class="icon"><i class="fe fe-x"></i></a>
                      </div>
                    </div>
                  </li>
                <?php endforeach ?>
              </ul>
            </div>
            <div class="text-right" style="border-top: #dfdfdf solid 1px">
              <div style="color: blue; font-size: 1.3em" class="mt-2 mr-3">총 주문금액 : <?php echo sum($baskets) ?>원</div>
                <button type="button" onclick="loc('/order/success')" class="btn btn-primary btn-space mt-3 mb-3 mr-3">결제하기</button>
            </div>
          </div>

          <div class="col-12">
          <div class="mb-2 text-right">
            <button type="submit" class="btn btn-primary" onclick="location.href='/review/index/<?php echo $store['user_idx'] ?>'">리뷰보기<span class="badge badge-primary"><?php echo $review ?>개</span></button>
          </div>
          <div class="card">
            <div class="table-responsive">
              <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                <thead>
                  <tr class="text-center">
                    <th><strong>메뉴이름</strong></th>
                    <th><strong>가격</strong></th>
                    <th><strong>수량</strong></th>
                    <th><strong>합계</strong></th>
                    <th><strong>주문함담기</strong></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($foods as $key => $food): ?>
                    <tr class="text-center">
                      <td>
                        <?php echo $food["food_name"] ?>
                      </td>
                      <td data-price="<?php echo $food['food_price'] ?>">
                        <?php echo number_format($food['food_price']) ?>원
                      </td>
                      <td style="width: 10%">
                        <input type="number" class="form-control qt" placeholder="1" min="1" value="1">
                      </td>
                      <td style="width: 20%">
                        <input type="text" class="form-control text-right price" readonly="readonly" value="<?php echo $food['food_price'] ?>">
                      </td>
                      <td>
                        <button type="button" data-idx="<?php echo $food['idx'] ?>" class="btn get-btn btn-secondary btn-space">주문함담기</button>
                      </td>
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
<script type="text/javascript">
  $(function(){
    qt();
    $(".get-btn").on("click", function() {
      var idx = $(this).data("idx");
      var quantity = $(this).parents("tr").find(".qt").val();

      $.ajax({
        url : "/basket/add",
        data : {
          food_idx : idx,
          quantity : quantity,
        },
        type : "POST",
        success : function() {
          location.reload();
        },
      })
    });
  })
</script>