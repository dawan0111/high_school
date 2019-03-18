
  <div class="my-3 my-md-5">
    <div class="container">
      <div class="page-header">
        <!-- page title start-->
        <h1 class="page-title">
           주문하기
        </h1>
        <!-- page title end-->
      </div>

      <!-- contents start -->
      <div class="col-12">
        <div class="row">
          
          <div class="form-group col-12">
            <div class="selectgroup w-100">
              <label class="selectgroup-item">
                <input type="radio" name="value" value="50" class="selectgroup-input" onclick="loc('/order/index')" <?php echo $kind == "" ? "checked" : ""; ?>>
                <span class="selectgroup-button">전체보기</span>
              </label>
              <label class="selectgroup-item">
                <input type="radio" name="value" value="100" class="selectgroup-input" onclick="loc('/order/index?kind=한식')" <?php echo $kind == "한식" ? "checked" : ""; ?> >
                <span class="selectgroup-button">한식</span>
              </label>
              <label class="selectgroup-item">
                <input type="radio" name="value" value="100" class="selectgroup-input" onclick="loc('/order/index?kind=중식')" <?php echo $kind == "중식" ? "checked" : ""; ?> >
                <span class="selectgroup-button">중식</span>
              </label>
              <label class="selectgroup-item">
                <input type="radio" name="value" value="100" class="selectgroup-input" onclick="loc('/order/index?kind=일식')" <?php echo $kind == "일식" ? "checked" : ""; ?> >
                <span class="selectgroup-button">일식</span>
              </label>
              <label class="selectgroup-item">
                <input type="radio" name="value" value="100" class="selectgroup-input" onclick="loc('/order/index?kind=치킨')" <?php echo $kind == "치킨" ? "checked" : ""; ?> >
                <span class="selectgroup-button">치킨</span>
              </label>
              <label class="selectgroup-item">
                <input type="radio" name="value" value="100" class="selectgroup-input" onclick="loc('/order/index?kind=피자')" <?php echo $kind == "피자" ? "checked" : ""; ?> >
                <span class="selectgroup-button">피자</span>
              </label>
              <label class="selectgroup-item">
                <input type="radio" name="value" value="100" class="selectgroup-input" onclick="loc('/order/index?kind=야식')" <?php echo $kind == "야식" ? "checked" : ""; ?> >
                <span class="selectgroup-button">야식</span>
              </label>
            </div>
          </div>
          <div class="form-group col-4">
            <form method="get">
              <div class="row gutters-xs">
                <div class="col">
                  <input type="hidden" name="sort" value="<?php echo $sort ?>">
                  <input type="hidden" name="kind" value="<?php echo $kind ?>">
                  <input type="text" name="keyword" class="form-control" placeholder="가맹점검색" value="<?php echo $keyword ?>">
                </div>
                <span class="col-auto">
                  <button class="btn btn-secondary" type="submit"><i class="fe fe-search"></i></button>
                </span>
              </div>
            </form>
          </div>
          <?php
            $link = "/order/index?keyword=".$keyword."&kind=".$kind."&sort=";
          ?>
          <div class="form-group col-8 mt-2">
            <div class="custom-controls-stacked">
              <label class="custom-control custom-radio custom-control-inline">
                <input 
                  type="radio"
                  class="custom-control-input"
                  name="example-inline-radios"
                  onclick="loc('<?=$link?>star')" 
                  <?php echo $sort == "star" ? "checked" : ""; ?>
                >
                <span class="custom-control-label">평점순</span>
              </label>
              <label class="custom-control custom-radio custom-control-inline">
                <input 
                  type="radio"
                  class="custom-control-input"
                  name="example-inline-radios"
                  onclick="loc('<?=$link?>review')" 
                  <?php echo $sort == "review" ? "checked" : ""; ?>
                >
                <span class="custom-control-label">리뷰순</span>
              </label>
              <label class="custom-control custom-radio custom-control-inline">
                <input 
                  type="radio"
                  class="custom-control-input"
                  name="example-inline-radios"
                  onclick="loc('<?=$link?>dir')" 
                  <?php echo $sort == "dir" ? "checked" : ""; ?>
                >
                <span class="custom-control-label">가까운지점</span>
              </label>
            </div>
          </div>
          <?php
            $user_idx = array_column($store_list, "user_idx");
            $map_loc = "/order/map?user_idx=".join(",", $user_idx);
          ?>
          <div class="col-12">
            <div class="card">
                <div class="card-map card-map-placeholder">
                    <div id="map"  style="float: left" data-loc="<?php echo $map_loc ?>">
                      <img src="<?php echo $map_loc ?>">
                    </div>
                    <h3 class="text-center mt-6">전체보기</h3>
                    <table style="width: 433px; height: 220px;">
                      <tr>
                        <td style="vertical-align: middle;" class="text-left">
                          <p><img src="/assets/images/red_map_marker.png" style="vertical-align: bottom; margin-left: 150px;"> &nbsp;&nbsp;회원위치</p>
                          <p><img src="/assets/images/blue_map_marker.png" style="vertical-align: bottom; margin-left: 150px;"> &nbsp;&nbsp;가맹점위치</p>  
                          <p><img src="/assets/images/pink_map_marker.png" style="vertical-align: bottom; margin-left: 150px;"> &nbsp;&nbsp;위치표시 가맹점</p>
                        </td>
                      </tr>
                    </table>
                </div>
            </div>
          </div>

          <div class="col-12">
            <div class="card">
              <table class="table card-table table-vcenter affiliationList">
                <tbody>
                  <?php foreach ($store_list as $key => $store): ?>
                    <tr title="<?php echo $store['store_name'] ?>">
                      <td style="width: 10%;"><img src="/upload/<?php echo $store['logo'] ?>" alt="" class="h-8"></td>
                      <td>
                        <a href="/order/menu/<?php echo $store['user_idx'] ?>" title="<?php echo $store['store_name'] ?> 메뉴주문 페이지">
                          <h5><?php echo $store["store_name"] ?></h5>
                          <ul class="list">
                            <li>
                              <span class="title">평점</span>  
                              <span class="badge badge-primary"><?php echo $store['star'] ?>점</span>
                            </li>
                            <li>
                              <span class="title">리뷰</span>  
                              <span class="badge badge-primary"><?php echo $store['review'] ?>개</span>
                            </li>
                          </ul>
                        </a>
                      </td>
                      <td>
                        가맹점위치<br>
                        회원위치정보(<?php echo USER["offset"] ?>), 가맹점위치정보(<?php echo $store["offset"] ?>)<br>
                        회원위치와 가맹점간의 거리 = <?php echo $store['dir'] ?>
                      </td>
                      <td class="text-right">
                        <label class="custom-switch">
                          <input type="radio" name="option" value="<?php echo $store['user_idx'] ?>" class="custom-switch-input">
                          <span class="custom-switch-indicator"></span>
                          <span class="custom-switch-description">위치표시</span>
                        </label>
                      </td>
                    </tr>
                  <?php endforeach ?>
              </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
      <!-- contents end -->

    </div>
  </div>
</div>

<script type="text/javascript">
  $(function() {
    $(".custom-switch-input").on("change", function() {
      var chk = $(".custom-switch-input:checked").val() || false;
      var src = $("#map").data("loc");

      if(chk === false) {
        $("#map img").attr("src", src);
      } else {
        $("#map img").attr("src", src+"&chk="+chk);
      };
    });
  })
</script>