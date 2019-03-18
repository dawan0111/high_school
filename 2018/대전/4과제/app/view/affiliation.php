
  <div class="my-3 my-md-5">
    <div class="container">
      <div class="page-header">
        <!-- page title start-->
        <h1 class="page-title">
           가맹회원
        </h1>
        <!-- page title end-->
      </div>

      <!-- contents start -->
      <div class="col-12">
        <div class="row">
          <?php if (USER["type"] != 3): ?>
            <?php
              $kind = $store ? $store["kind"] : "";
              $name = $store ? $store["store_name"] : "";
              $label = $store ? "수정" : "등록";
            ?>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="font-size: 1.2em; font-weight: bold;">가맹점<?=$label ?></h3>
              </div>
              <div class="card-body1 p-5">
                <form method="post" action="/store/action" enctype="multipart/form-data">
                  <?php if ($store): ?>
                    <input type="hidden" name="idx" value="<?php echo $store['idx'] ?>">
                  <?php endif ?>
                  <div class="form-group col-12">
                    <label class="form-label">가맹점분류</label>
                    <select class="custom-select col-2" name="kind">
                      <option value="">가맹점분류선택</option> 
                      <option value="한식" <?php echo $kind == "한식" ? "selected" : ""; ?>>한식</option> 
                      <option value="중식" <?php echo $kind == "중식" ? "selected" : ""; ?>>중식</option>
                      <option value="일식" <?php echo $kind == "일식" ? "selected" : ""; ?>>일식</option> 
                      <option value="치킨" <?php echo $kind == "치킨" ? "selected" : ""; ?>>치킨</option>
                      <option value="피자" <?php echo $kind == "피자" ? "selected" : ""; ?>>피자</option> 
                      <option value="야식" <?php echo $kind == "야식" ? "selected" : ""; ?>>야식</option>
                    </select>
                  </div>
                  <div class="form-group col-12">
                    <label class="form-label">가맹점로고</label>
                    <input type="file" name="file" class="form-control">
                  </div>

                  <div class="form-group col-12">
                    <label class="form-label">가맹점명</label>
                    <input type="text" name="store_name" class="form-control" value="<?php echo $name ?>">
                  </div>
                  <?php if ($store): ?>
                    <div class="col-12">
                      <img src="/upload/<?php echo $store['logo'] ?>">
                      <strong><?php echo $store['store_name'] ?></strong>
                    </div>
                  <?php endif ?>
                  <div class="form-footer col-12">
                    <button type="submit" class="btn btn-primary btn-block">가맹점<?=$label ?></button>
                  </div>
                </form>
              </div>
            </div>

            <?php if ($store): ?>
              <div class="card mt-7">
                <div class="card-header">
                  <h3 class="card-title" style="font-size: 1.2em; font-weight: bold;">메뉴등록</h3>
                </div>
                <div class="card-body1 p-5">
                  <form method="post" action="/food/add">
                    <div class="form-group col-12">
                      <label class="form-label">메뉴이름</label>
                      <input type="text" name="food_name" class="form-control">
                    </div>

                    <div class="form-group col-12">
                      <label class="form-label">가격</label>
                      <input type="text" name="food_price" class="form-control">
                    </div>
                    <div class="form-footer col-12">
                      <button type="submit" class="btn btn-primary btn-block">메뉴등록</button>
                    </div>
                  </form>
                </div>
              </div>
            <?php endif ?>

            <div class="card mt-7">
              <div class="card-header">
                <h3 class="card-title" style="font-size: 1.2em; font-weight: bold;">메뉴목록</h3>
              </div>
              <div class="card-body1 p-5">
                <div class="table-responsive">
                <table class="table table-bordered table-vcenter text-nowrap card-table menuTable" style="border-top: 1px solid rgba(0, 40, 100, 0.12)">
                  <thead>
                    <tr>
                      <th>메뉴이름</th>
                      <th>가격</th>
                      <th>판매수량</th>
                      <th>등록일</th>
                      <th>메뉴삭제</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($foods as $key => $food): ?>
                      <tr>
                        <td class="text-center">
                          <?php echo $food["food_name"] ?>
                        </td>
                        <td class="text-center">
                         <?php echo number_format($food["food_price"]) ?>원
                        </td>
                        <td class="text-center">
                          <?php echo number_format($food['quantity']) ?>개 
                        </td>
                        <td class="text-center">
                          <?php echo date("Y-m-d", strtotime($food["create_date"])) ?>
                        </td>
                        <td class="text-center">
                          <button type="button" onclick="location.href='/food/delete/<?php echo $food['idx'] ?>'" class="btn btn-secondary btn-space m-1">삭제</button>
                        </td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
              </div>
            </div>


            <div class="card mt-7">
              <div class="card-header">
                <h3 class="card-title" style="font-size: 1.2em; font-weight: bold;">주문목록</h3>
              </div>
              <div class="card-body1 p-5">
                <div class="table-responsive">
                <table class="table table-bordered table-vcenter text-nowrap card-table" style="border-top: 1px solid rgba(0, 40, 100, 0.12)">
                  <thead>
                    <tr>
                      <th>주문일자</th>
                      <th>아이디</th>
                      <th>성명</th>
                      <th>전화번호</th>
                      <th>위치정보</th>
                      <th>메뉴이름</th>
                      <th>수량</th>
                      <th>가격</th>
                      <th>총 합계</th>
                      <th>주문상태</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php foreach ($order_list as $key => $data): ?>
                      <tr>
                        <?php if (isset($data["member"])): ?>
                          <td rowspan="<?php echo $data['row'] ?>"><?php echo $data["date"] ?></td>
                          <td rowspan="<?php echo $data['row'] ?>"><?php echo $data['member']['id'] ?></td>
                          <td rowspan="<?php echo $data['row'] ?>"><?php echo $data['member']['name'] ?></td>
                          <td rowspan="<?php echo $data['row'] ?>"><?php echo $data['member']['phone'] ?></td>
                          <td rowspan="<?php echo $data['row'] ?>">(<?php echo $data['member']['offset'] ?>)</td>
                        <?php endif ?>
                        <td><?php echo $data["food_name"] ?></td>
                        <td><?php echo $data['quantity'] ?>개</td>
                        <td><?php echo number_format($data["food_price"]) ?>원</td>
                        <?php if (isset($data["member"])): ?>
                          <td rowspan="<?php echo $data['row'] ?>"><?php echo $data["row_sum"] ?>원</td>
                          <td rowspan="<?php echo $data['row'] ?>">
                            <?php if ($data["order_state"] == 1): ?>
                              <button type="button" onclick="location.href='/order/ok?user=<?php echo $data['member']['idx'] ?>&buy_date=<?php echo $data['buy_date'] ?>'" class="btn btn-secondary btn-space">배송</button>
                            <?php else: ?>
                              배송완료
                            <?php endif ?>
                          </td>
                        <?php endif ?>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
              </div>
            </div>
          <?php else: ?>

                  <!-- 관리자모드 -->
                  <div class="card mt-7">
                    <div class="card-header">
                      <h3 class="card-title" style="font-size: 1.2em; font-weight: bold;">가맹점 메뉴목록</h3>
                      <div class="col text-right">
                        <select class="custom-select col-2">
                          <option value="">가맹회원선택</option>
                          <?php foreach ($store as $key => $data): ?>
                            <?php $selected = $data["user_idx"] == $user ? "selected" : ""; ?>
                            <option value="<?php echo $data['user_idx'] ?>" <?php echo $selected ?>><?php echo $data['store_name'] ?></option>
                          <?php endforeach ?>
                        </select>
                        <button type="button" class="btn ok-btn btn-secondary btn-space">확인</button>
                      </div>
                    </div>
                    <div class="card-body1 p-5">
                      <div class="table-responsive">
                      <table class="table table-bordered table-vcenter text-nowrap card-table" style="border-top: 1px solid rgba(0, 40, 100, 0.12)">
                        <thead>
                          <tr>
                            <th>메뉴이름</th>
                            <th>가격</th>
                            <th>판매수량</th>
                           
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($foods as $key => $food): ?>
                            <tr>
                              <td class="text-center">
                                <?php echo $food['food_name'] ?>
                              </td>
                              <td class="text-center">
                               <?php echo number_format($food['food_price']) ?>원
                              </td>
                              <td class="text-center">
                                <?php echo number_format($food['quantity']) ?>개 
                              </td>
                            </tr>
                          <?php endforeach ?>
                        </tbody>
                      </table>
                    </div>
                    </div>
                  </div>

                  <div class="card mt-7">
                    <div class="card-header">
                      <h3 class="card-title" style="font-size: 1.2em; font-weight: bold;">메뉴랭킹</h3>
                    </div>
                    <div class="card-body1 p-5">
                      <div class="table-responsive">
                      <table class="table table-bordered table-vcenter text-nowrap card-table" style="border-top: 1px solid rgba(0, 40, 100, 0.12)">
                        <thead>
                          <tr>
                            <th>랭킹</th>
                            <th>가맹점명</th>
                            <th>메뉴이름</th>
                            <th>가격</th>
                            <th>판매수량</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($ranking as $key => $data): ?>
                            <tr>
                              <td class="text-center" style="width: 5%">
                                <?php echo $key + 1 ?>위
                              </td>
                              <td class="text-center">
                               <?php echo $data['store_name'] ?>
                              </td>
                              <td class="text-center">
                                <?php echo $data["food_name"] ?>
                              </td>
                              <td class="text-center">
                                <?php echo number_format($data['food_price']) ?>원
                              </td>
                              <td class="text-center">
                                <?php echo $data["quantity"] ?>개
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
          <?php endif ?>
      <!-- contents end -->
    </div>
    </div>
  </div>
</div>