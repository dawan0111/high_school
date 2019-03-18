    <div class="container">
        <div class="col-lg-6 col-lg-offset-3">
            <h2>Hotel Jeju</h2>
            <div class="panel"></div>
            <form class="form-horizontal join-form" method="post" action="/member/loginAction?prevPage=<?php echo $_GET["prevPage"] ?>">
                <input type="text" class="form-control" name="id" placeholder="Enter Email">
                <input type="password" class="form-control" name="pw" placeholder="Enter Password">
                <input type="submit" value="로그인" class="btn btn-success btn-block">
                <label><input type="checkbox" name="auto"> 자동 로그인</label>
            </form>
        </div>
    </div>
</body>
</html>