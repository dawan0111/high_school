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
            <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 33.333333333333%;">
            총 6단계중 2단계
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row" style="margin-top:20px;">
            <div class="col-md-10 col-md-offset-1">
                <div class="well">
                    웹사이트 구축에 사용할 MySQL 유저의 아이디와 비밀번호를 입력하세요<br/>
                    데이터베이스 이름은 MySQL유저의 이름과 동일하게 설정됩니다.
                </div>
                <form class="form-horizontal" method="post" action="/install/process/2">
                    <div class="form-group">
                        <label for="dbName" class="col-md-2 control-label">데이터베이스 계정명</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="dbName" placeholder="계정 이름" name="dbName">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pass" class="col-md-2 control-label">계정 비밀 번호</label>
                        <div class="col-md-10">
                            <input type="password" class="form-control" id="pass" placeholder="DB계정 비밀번호" name="dbpass">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="passc" class="col-md-2 control-label">계정 비밀 번호 확인</label>
                        <div class="col-md-10">
                            <input type="password" class="form-control" id="passc" placeholder="DB계정 비밀번호" name="dbpassc">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" class="btn btn-default">계정 생성</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>