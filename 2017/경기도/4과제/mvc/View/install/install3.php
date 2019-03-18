<!doctype html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <title>설치화면</title>
    <link rel="stylesheet" href="/css/theme2.min.css"/>
    <script src="/js/app.js"></script>
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="navbar-header">
          <a class="navbar-brand">관광지 관리 설치 프로그램</a>
        </div>
        <div class="progress" style="width: 60%; margin: 0; margin-top: 14px;">
            <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
            총 6단계중 3단계
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="page-header">
            <h3>관리자 정보 설정</h3>
        </div>

        <div class="row" style="margin-top:20px;">
            <div class="col-md-10 col-md-offset-1">
                <form class="form-horizontal"" method="post" action="/install/process/3">
                    <input type="hidden" name="_token" value="IBPgWszU42bXaZdP4rPKtAs6lTf4jG592AVQPYBN">
                    <div class="form-group">
                        <label for="email" class="col-md-2 control-label">관리자 email</label>
                        <div class="col-md-10">
                            <input type="email" class="form-control" id="email" name="email" placeholder="이메일 입력" value="">
                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pass" class="col-md-2 control-label">비밀번호</label>
                        <div class="col-md-10">
                            <input type="password" class="form-control" id="pass" name="password" placeholder="비밀번호 입력" value="">
                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="col-md-2 control-label">비밀번호 확인</label>
                        <div class="col-md-10">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="비밀번호 확인" value="">
                            
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" class="btn btn-default">관리자 입력</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>