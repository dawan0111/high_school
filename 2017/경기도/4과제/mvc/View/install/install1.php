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
            <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 16.666666666667%;">
            총 6단계중 1단계
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="jumbotron">
            <h1>관광지 관리 설치 프로그램</h1>
            <p>관광지 관리 설치 프로그램에 오신 것을 환영합니다. 본 프로그램은 MySQL과 Apache가 설치된 환경에서 정상적으로 작동합니다. 아래의 입력창에 사이트의 이름과 MySQL의 root 비밀번호를 입력하고 설치 시작 버튼을 누르세요.</p>
        </div>

        <div class="row" style="margin-top:20px;">
            <div class="col-md-10 col-md-offset-1">
                <form class="form-horizontal" method="post" action="/install/process/1">
                    <div class="form-group">
                        <label for="siteName" class="col-md-2 control-label">웹사이트의 이름</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="siteName" name="siteName" placeholder="사이트 이름">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="mysqlPass" class="col-md-2 control-label">MySQL의 루트 비밀번호</label>
                        <div class="col-md-10">
                            <input type="password" class="form-control" id="mysqlPass" name="mysqlPass" placeholder="MySQL root 비밀번호">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" class="btn btn-default">사이트 작성</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>