
<div class="container-fluid p-3">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="/">홈</a>
    </li>
    <li class="breadcrumb-item active">물류배송추적</li>
  </ol>

  <!-- content-start -->
  <div class="card card-register mx-auto mt-5" style="max-width: 80rem">
    <div class="card-header">물류배송추적검색</div>
    <div class="card-body">
      <form class="form-inline my-2 my-lg-0 mr-lg-2">
        <div class="input-group col-12">
          <input class="form-control" type="text" value="<?php echo $_GET['code'] ?? ""; ?>" name="code" placeholder="배송번호">
          <span class="input-group-append">
            <button class="btn btn-primary" type="submit">
              <i class="fa fa-truck"></i>
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
        <table class="table card-table table-vcenter text-nowrap">
          <thead>
            <tr>
              <th class="w-1">No.</th>
              <th>배송번호</th>
              <th>배송지역</th>
              <th>배송상태</th>
              <th>배송경로</th>
              <th>배송일</th>
              <th>배송중량</th>
              <th>현위치</th>
              <th>신청일자</th>
              <th>차량정보</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($search_list as $key => $data): ?>
              <tr>
                <td class="w-1"><?php echo $key + 1 ?></td>
                <td><?php echo $data["code"] ?></td>
                <td><?php echo $data["location"] ?></td>
                <td><?php echo $data['state'] ?></td>
                <td>
                  <?php if ($data["truck"] != 0): ?>
                    <?php echo $data["user_loc"] ?>    
                  <?php endif ?>
                </td>
                <td><?php echo krDate($data["order_date"]) ?></td>
                <td><?php echo $data["weight"] ?>톤</td>
                <td>
                  <?php if ($data["truck"] != 0): ?>
                    <?php echo $data["user_now"] ?>
                  <?php endif ?>
                </td>
                <td><?php echo date("Y년 m월 j일", strtotime($data['create_date'])) ?></td>
                <td>
                  <?php $disabled = in_array($data["state"], ["배송중", "배송대기"]) ? "" : "disabled"; ?>
                  <button onclick="location.href='/truck/info/<?=$data['idx'] ?>'" <?php echo $disabled ?> class="btn btn-primary btn-sm">차량정보</button>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- content-end -->

</div>

