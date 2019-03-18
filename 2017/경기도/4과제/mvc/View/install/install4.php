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
            <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 66.666666666667%;">
            총 6단계중 4단계
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="page-header">
            <h3>사이트 로고 슬라이드 생성.</h3>
        </div>

        <div class="row" style="margin-top:20px;">
            <div class="alert alert-success" role="alert"><strong>주의사항 </strong> 로고화면의 슬라이드로 사용할 그림을 업로드하세요. 그림은 자동으로 700 X 350 사이즈로 리사이즈 됩니다.</div>
            <div class="col-md-10 col-md-offset-1">
                
                <form method="post" enctype="multipart/form-data" action="/install/fileUpload">
                    <div class="form-group">
                        <label for="uploadData">File input</label>
                        <input type="file" multiple="multiple" id="uploadData" name="photo[]">
                        <p class="help-block">*.png, jpg, jpeg 파일만을 업로드하세요.</p>
                    </div>
                    <button type="submit" class="btn btn-default">전송</button>
                </form>
            </div>

        </div>

    </div>
</body>
</html>