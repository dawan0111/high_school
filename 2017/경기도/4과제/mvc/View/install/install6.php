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
            <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
            총 6단계중 6단계
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="page-header">
            <h3>타이틀 화면과 테마 선택하기.</h3>
        </div>

        <div class="row">
            <form method="post" action="/install/createSite">
                <div class="form-group">
                    <label for="description">웹사이트의 소개글</label>
                    <textarea class="form-control" rows="3" id="description" style="resize:none;" name="description"></textarea>
                    <span id="helpBlock" class="help-block">여기에 작성된 글은 웹사이트의 메인화면에 노출됩니다.</span>
                </div>
                <div class="row" style="margin-top:20px;">
                    <div class="col-md-12">
                        <label>웹사이트 테마 선택</label>
                    </div>
                    <div class="col-md-4">
                        <input type="radio" name="themes" value=1 checked="checked"> 블랙
                        <a class="thumbnail">
                            <img src="/imgs/black.png">
                        </a>
                    </div>
                    <div class="col-md-4">
                        <input type="radio" name="themes" value=2> 모래
                        <a class="thumbnail">
                            <img src="/imgs/sandstone.png">
                        </a>
                    </div>
                    <div class="col-md-4">
                        <input type="radio" name="themes" value=3> 화이트
                        <a class="thumbnail">
                            <img src="/imgs/white.png">
                        </a>
                    </div>
                </div>
                <button type="submit" class="btn btn-default">전송</button>
            </form>
        </div>
    </div>
</body>
</html>