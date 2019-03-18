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
            <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 83.333333333333%;">
            총 6단계중 5단계
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="page-header">
            <h3>게시판 생성하기</h3>
        </div>

        <div class="row">
            <form class="form-horizontal" method="post" action="/install/addBoard">
                <div class="col-md-5" style="margin-top: 10px;">
                    <div class="form-group">
                        <label for="normalBoard" class="control-label col-md-3">일반게시판 수</label>
                        <div class="col-md-9 input-group">
                            <input type="number" class="form-control" id="normalBoard" name="normalBoard" min="0" max="5" placeholder="일반게시판 숫자를 입력"/>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default" id="addNBoard">게시판 추가</button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group" id="normalAppend" style="margin-top:30px;">
                    </div>
                </div>
                <div class="col-md-5 col-md-offset-1" style="margin-top: 10px;">
                    <div class="form-group">
                        <label for="pictureBoard" class="control-label col-md-3">사진게시판 수</label>
                        <div class="col-md-9 input-group">
                            <input type="number" class="form-control" id="pictureBoard" name="pictureBoard" min="0" max="5" placeholder="사진 게시판 숫자를 입력"/>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default" id="addPicBoard">게시판 추가</button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group" id="picAppend" style="margin-top:30px;">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-offset-10 col-md-2">
                            <button id="createBtn" disabled="disabled" type="submit" class="btn btn-default">생성하기</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
<script>
    function addDiv(target, val, type){
        target.html("");
        var div = "<div class='col-md-12'>";
            for(var i = 0; i <= val-1; i++) {
                div += "<div class='form-group'>";
                    div += "<label for='boardName' class='control-label col-md-2'>이름</label>";
                    div += "<div class='col-md-6'>"
                        div += "<input class='form-control' id='boardName' type='text' name='" + type + "board[]' placeholder='게시판 이름' required>";
                    div += "</div>";
                    div += "<div class='col-md-4'>";
                        div += "<div class='radio'><label><input id='mainDisplay' type='radio' value=" + i +" name='main" + type + "' " + (i == 0 ? "checked" : "") + ">메인화면 표시</label></div>";
                    div += "</div>";
                div += "</div>";
            }
        div += "</div>";
        target.append(div);

        $("#createBtn").removeAttr("disabled");
    }
    $("#addNBoard").on("click", function(){
        var val = $("#normalBoard").val();
        var target = $("#normalAppend");
        if(val) {
            addDiv(target, val, "n");
        } else {
            alert("내용을 입력해주세요.");
        }
    });

    $("#addPicBoard").on("click", function(){
        var val = $("#pictureBoard").val();
        var target = $("#picAppend");
        if(val) {
            addDiv(target, val, "p");
        } else {
            alert("내용을 입력해주세요.");
        }
    });

</script>
    </div>
</body>
</html>