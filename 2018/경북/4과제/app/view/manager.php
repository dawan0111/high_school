<script type="text/javascript">
  $(function(){
    var date = "<?= $_GET['date'] ?? "" ?>";
    $('#date').datepicker({
      dateFormat : 'yy년 mm월 dd일',
      minDate : +1
    });

    $("#searchForm").on("submit", function() {
      var date = $("#date").val();

      if(date == "") {
        alert("배송일을 선택해주세요.");
        return false;
      };

      $("body > *").hide();
      $("html").css("background", "url(/images/loding.gif) center center no-repeat");

      $.ajax({
        url : "/ajax/getData",
        data : {
          date : date,
        },
        type : "POST",
        success : function(e) {
          date = date.replace(/(년 |월 )/g, "-");
          date = date.replace("일", "");

          setTimeout(function() {
            history.pushState("", null, "/product/manager?date="+date);
            $("body > *:not(#ui-datepicker-div)").show();
            $("html").removeAttr('style');
          }, 500);
          $("#tbody").html(e);
        },
      });

      return false;
    });

    if(date != "") {
      $("#searchForm").trigger("submit");
    };
  });
</script>

<div class="container-fluid p-3">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="/">홈</a>
    </li>
    <li class="breadcrumb-item active">지입차량주POS</li>
  </ol>

  <!-- content-start -->
  <div class="card card-register mx-auto mt-5" style="max-width: 80rem">
    <div class="card-header">물류배송신청검색</div>
    <div class="card-body">
      <form class="form-inline my-2 my-lg-0 mr-lg-2" id="searchForm">
        <div class="input-group col-12">
          <input class="form-control" id="date" type="text" value="<?php echo isset($_GET['date']) ? krDate($_GET['date']) : ""; ?>" placeholder="배송일검색" readonly="readonly">
          <span class="input-group-append">
            <button class="btn btn-primary" type="submit">
              <i class="fa fa-search"></i>
            </button>
          </span>
        </div>
      </form>
    </div>
  </div>
  <div class="mx-auto mt-5" style="max-width: 80rem">
    <div class="card">
      <div class="card-header">물류배송신청목록</div>
      <div class="table-responsive">
        <form method="post" action="/product/ok">
          <table class="table card-table table-vcenter text-nowrap text-center table-bordered" >
            <thead>
              <tr>
                <th class="w-1">No.</th>
                <th>배송일</th>
                <th>배송정보</th>
                <th>배송지역</th>
                <th>총 배송중량</th>
                <th>총 배송거리</th>
                <th>배송경로</th>
                <th>Order인수</th>
              </tr>
            </thead>
            <tbody id="tbody">
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div>


   <div class="mx-auto mt-5" style="max-width: 80rem">
    <div class="card">
      <div class="card-header">배송리스트</div>
      <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap text-center table-bordered" >
          <thead>
            <tr>
              <th class="w-1">No.</th>
              <th>배송일</th>
              <th>배송정보</th>
              <th>배송지역</th>
              <th>총 배송중량</th>
              <th>총 배송거리</th>
              <th>배송경로</th>
              <th>배송상태</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($trucks as $key => $truck): ?>
              <?php $rowspan  ="rowspan='".count($truck["products"])."'"; ?>
              <?php foreach ($truck["products"] as $k => $product): ?>
                <tr>
                  <?php if ($k === 0): ?>
                    <td <?=$rowspan ?> class="w-1"><?php echo $key + 1 ?></td>
                    <td <?=$rowspan ?>><?php echo krDate($product['order_date']) ?></td>
                  <?php endif ?>
                  <td class="text-left">
                    <p class="m-0">배송번호 : <?php echo $product['code'] ?></p>
                    <p class="m-0">아이디 : <?php echo $product['user_id'] ?></p>
                    <p class="m-0">회사명 :<?php echo $product['user_name'] ?></p>
                    <p class="m-0">전화번호 : <?php echo $product['user_phone'] ?></p>
                    <p class="m-0">배송중량 : <?php echo $product['weight'] ?>톤</p>
                    <p class="m-0">신청일자 : <?php echo krDate($product['create_date']) ?></p>
                  </td>
                  <td><?php echo $product['location'] ?></td>
                  <?php if ($k === 0): ?>
                    <td <?=$rowspan ?>><?php echo $truck['weight'] ?>톤</td>
                    <td <?=$rowspan ?>><?php echo $truck['spend'] ?>km</td>
                    <td <?=$rowspan ?>>
                      <?php $locations = explode("-", $truck["location"]); ?>
                      <?php $now = array_find($truck["now_location"], $locations); ?>
                      <div class="selectgroup selectgroup-pills">
                        <?php foreach ($locations as $key => $location): ?>
                          <?php
                            $state = "";

                            if($key <= $now) {
                              $state = "checked disabled";
                            };

                            if($truck["state"] == "배송대기")
                              $state = "disabled";
                          ?>
                          <label class="selectgroup-item m-0">
                            <input type="checkbox" name="value" value="<?php echo $location ?>" data-idx="<?php echo $truck['idx'] ?>" class="selectgroup-input" <?php echo $state ?>>
                            <span class="selectgroup-button">
                              <p class="m-0"><?php echo $location ?></p>
                              <?php if ($truck['state'] != "배송대기"): ?>
                                배송완료
                              <?php endif ?>
                            </span>
                          </label>
                          <?php if ($location != end($locations)): ?>
                            <p class="m-0">▼</p>
                          <?php endif ?>
                        <?php endforeach ?>
                      </div>
                    </td>
                    <td <?=$rowspan ?>>
                      <?php
                        $now = strtotime(date("Y-m-d"));
                        $order = strtotime($truck["order_date"]);
                      ?>
                      <?php if ($now < $order && $truck["state"] == "배송대기"): ?>
                        배송대기
                      <?php endif ?>
                      <?php if ($now >= $order && $truck["state"] == "배송대기"): ?>                        
                        <button onclick="location.href='/truck/start/<?php echo $truck['idx'] ?>'" class="btn btn-primary btn-sm">배송하기</button>
                      <?php endif ?>

                      <?php if ($now >= $order && $truck['state'] != "배송대기"): ?>
                        <?php echo $truck['state'] ?>
                      <?php endif ?>
                    </td>
                  <?php endif ?>
                </tr>
              <?php endforeach ?>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- content-end -->

</div>

<script type="text/javascript">
  $(function() {
    $(".selectgroup-input").on("change", function() {
      var loc = $(this).val();
      var truck = $(this).data("idx");
      
      location.href= '/truck/move?location='+loc+'&truck='+truck;
    });
  });
</script>