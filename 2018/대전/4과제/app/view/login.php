
  <div class="my-3 my-md-5">
    <div class="container">
      <div class="page-header">
        <!-- page title start-->
        <h1 class="page-title">
           로그인
        </h1>
        <!-- page title end-->
      </div>

      <!-- contents start -->
      <div class="col-6 mx-auto mt-9">
        <div class="row">
      
          <form class="card" action="/member/login" method="post">
            <div class="card-body p-6 col-12">
              <div class="card-title">회원로그인</div>
              <div class="form-group">
                <label class="form-label">아이디</label>
                <input type="text" name="id" class="form-control" placeholder="ID">
              </div>
              <div class="form-group">
                <label class="form-label">비밀번호</label>
                <input type="password" name="pw" class="form-control" placeholder="PASSWORD">
              </div>       
              <div class="form-footer">
                <button type="submit" class="btn btn-primary btn-block">로그인</button>
              </div>
            </div>
          </form>
          
        </div>
      </div>
      <!-- contents end -->

    </div>
  </div>
</div>