
<div class="container-fluid p-3">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="/">홈</a>
    </li>
    <li class="breadcrumb-item active">차량정보</li>
  </ol>

  <!-- content-start -->
  
  <div class="mx-auto mt-5" style="max-width: 80rem">
    <h4>차량정보</h4>
    <table class="table card-table table-vcenter text-nowrap table-bordered text-center" style="border: 0 0 0 0 !important">
      <tr>
        <th style="width: 20%">아이디</th>
        <td class="text-left"><?php echo $user['id'] ?></td>
      </tr>
      <tr>
        <th>차량주명</th>
        <td class="text-left"><?php echo $user['name'] ?></td>
      </tr>
      <tr>
        <th>전화번호</th>
        <td class="text-left"><?php echo $user['phone'] ?></td>
      </tr>
      <tr>
        <th>차량적재량</th>
        <td class="text-left"><?php echo $user['weight'] ?>톤</td>
      </tr>
      <tr>
        <th>현차량전체경로</th>
        <td class="text-left"><?php echo $truck['location'] ?></td>
      </tr>
      <tr>
        <th>현위치</th>
        <td class="text-left"><?php echo $truck['now_location'] ?></td>
      </tr>
    </table>
    <div class="col-12 text-right">
      <a href="/product/delivery" class="btn btn-primary btn-sm">돌아가기</a>
    </div>
 
  </div>

  <!-- content-end -->

</div>