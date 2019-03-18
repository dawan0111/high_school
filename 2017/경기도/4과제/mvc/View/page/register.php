
    
    <div class="container">
         
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><h2>회원가입</h2></h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" action="/member/register">
                    <div class="form-group  ">
                        <label for="email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" id="email" placeholder="email@domain.com" value="" required>
                            
                        </div>
                    </div>
                    <div class="form-group  ">
                        <label for="name" class="col-sm-2 control-label">이름</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" placeholder="이름" value="" required>
                            
                        </div>
                    </div>                                              
                    <div class="form-group  ">
                        <label for="password" class="col-sm-2 control-label">비밀번호</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" id="password" placeholder="비밀번호" value="" required>
                            
                        </div>
                    </div>
                    <div class="form-group  ">
                        <label for="password_confirmation" class="col-sm-2 control-label">비밀번호확인</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="비밀번호 확인 " value="" required>
                            
                        </div>
                    </div>                                                                              
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">회원가입</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>