
<div class="container-fluid p-3">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="/">홈</a>
    </li>
    <li class="breadcrumb-item active">물류배송신청</li>
  </ol>

  <!-- content-start -->
  <div class="card card-register mx-auto mt-5" style="max-width: 80rem">
    <div class="card-header">물류배송신청</div>
    <div class="card-body">
      <form method="post" action="/product/contract">
        <div class="form-group">
          <label for="id">아이디</label>
          <input class="form-control" name="user_id" id="id" type="email" aria-describedby="emailHelp" value="<?php echo USER['id'] ?>" readonly="readonly">
        </div>
        <div class="form-group">
          <label for="name">회사명</label>
          <input class="form-control" name="user_name" id="name" type="email" aria-describedby="emailHelp" value="<?php echo USER['name'] ?>" readonly="readonly">
        </div>
        <div class="form-group">
          <label for="tel">전화번호</label>
          <input class="form-control" name="user_phone" id="tel" type="email" aria-describedby="emailHelp" value="<?php echo USER['phone'] ?>" readonly="readonly">
        </div>
        <div class="form-group">
          <label for="weight">배송중량</label>
          <select name="weight" id="weight" class="form-control">
            <option value="">선택</option>
            <option value="1">1톤</option>
            <option value="4">4톤</option>
            <option value="8">8톤</option>
            <option value="15">15톤</option>
            <option value="24">24톤</option>
          </select>
        </div>
        <div class="form-group">
          <label for="location">배송지역</label>
          <select name="location" id="location" class="form-control">
            <option value="">선택</option>
            <option value="서울">서울</option>
            <option value="경기">경기</option>
            <option value="강원">강원</option>
            <option value="충북">충북</option>
            <option value="대전">대전</option>
            <option value="경남">경남</option>
            <option value="경북">경북</option>
            <option value="전남">전남</option>
            <option value="전북">전북</option>
            <option value="충남">충남</option>
          </select>
        </div>
        <div class="form-group">
          <label for="date">배송일</label>
          <input class="form-control" name="order_date" id="date" type="email" aria-describedby="emailHelp" placeholder="" readonly="readonly">
        </div>
        <button type="submit" class="btn btn-primary btn-block">배송신청</button>
      </form>
      
    </div>
  </div>
  <!-- content-end -->

</div>

<script type="text/javascript">
$(function(){
  $('#date').datepicker({
    dateFormat : 'yy년 mm월 dd일',
    minDate : +1
  });
});
</script>