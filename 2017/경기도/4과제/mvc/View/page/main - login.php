<!DOCTYPE html>
<!-- saved from url=(0026)http://localhost:8000/home -->
<html lang="ko"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <title>곤돌관광</title>
    <link rel="stylesheet" href="./css/theme2.min.css">
    <script src="./js/app.js"></script>
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="#" class="navbar-brand">곤돌관광</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">게시판<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">자유게시판</a></li>
                            <li><a href="#">QA게시판</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">사진 게시판<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">사진자랑</a></li>
                        </ul>
                    </li>
                </ul>
                
                <ul class="nav navbar-nav navbar-right">
                    <li><a>관리자 님</a></li>
                    <li><a href="#">관리메뉴</a></li>
                    <li><a href="#">로그아웃</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
        
    </nav>
    
    <div class="container">
        <div class="well">
            이 사이트는 곤돌관광의 소개 사이트입니다. 반갑습니다.
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div id="titleSlide" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#titleSlide" data-slide-to="0" class="active"></li>
                        <li data-target="#titleSlide" data-slide-to="1" class=""></li>
                        <li data-target="#titleSlide" data-slide-to="2" class=""></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item">
                            <img src="./imgs/1.jpg">
                        </div>
                        <div class="item">
                            <img src="./imgs/2.jpg">
                        </div>
                        <div class="item active">
                            <img src="./imgs/3.jpg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top:20px;">
            <h3>자유게시판</h3>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th>글번호</th><th width="60%">제목</th><th>작성일</th><th>작성자</th>
                    </tr>
                    <tr>
                        <td>19</td><td> <a href="#">글작성 글작성</a> </td> <td> 2017-06-12 </td> <td> 관리자 </td>
                    </tr>
                    <tr>
                        <td>18</td><td> <a href="#">다시 글을 쓰자</a> </td> <td> 2017-06-12 </td> <td> 관리자 </td>
                    </tr>
                    <tr>
                        <td>17</td><td> <a href="#">30분임</a> </td> <td> 2017-06-12 </td> <td> 관리자 </td>
                    </tr>
                    <tr>
                        <td>16</td><td> <a href="#">19분임</a> </td> <td> 2017-06-12 </td> <td> 관리자 </td>
                    </tr>
                    <tr>
                        <td>15</td><td> <a href="#">19분임</a> </td> <td> 2017-06-12 </td> <td> 관리자 </td>
                    </tr>
                </tbody>
            </table>
        </div>
    
        <div class="row" style="margin-top:20px;">
            <h3>사진자랑</h3>
            <div class="col-md-8 col-md-offset-2">
                <div id="pSlide" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#pSlide" data-slide-to="0" class="active"></li>
                        <li data-target="#pSlide" data-slide-to="1" class=""></li>
                        <li data-target="#pSlide" data-slide-to="2" class=""></li>
                        <li data-target="#pSlide" data-slide-to="3" class=""></li>
                        <li data-target="#pSlide" data-slide-to="4" class=""></li>
                    </ol>

                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img class="img-responsive" style="width:700px; max-height:350px;" src="./imgs/3_10_jeju1.jpg">
                            <div class="carousel-caption">
                                <h3>제목 : 5번 사진 </h3>
                                <p>5번사진 작성자 : 관리자</p>
                            </div>
                        </div>
                        <div class="item">
                            <img class="img-responsive" style="width:700px; max-height:350px;" src="./imgs/3_9_jeju3.jpg">
                            <div class="carousel-caption">
                                <h3>제목 : 4번 사진입니다. </h3>
                                <p>4번 사진 작성자 : 관리자</p>
                            </div>
                        </div>
                        <div class="item">
                            <img class="img-responsive" style="width:700px; max-height:350px;" src="./imgs/3_8_jeju4.jpg">
                            <div class="carousel-caption">
                                <h3>제목 : 이번에도 하루방 사진 </h3>
                                <p>안녕하세요. 작성자 : 관리자</p>
                            </div>
                        </div>
                        <div class="item">
                            <img class="img-responsive" style="width:700px; max-height:350px;" src="./imgs/3_7_jeju4.jpg">
                            <div class="carousel-caption">
                                <h3>제목 : 직접찍은 사진입니다. </h3>
                                <p>안녕하세요. 작성자 : 관리자</p>
                            </div>
                        </div>
                        <div class="item">
                            <img class="img-responsive" style="width:700px; max-height:350px;" src="./imgs/3_6_jeju6.jpg">
                            <div class="carousel-caption">
                                <h3>제목 : 하루방 사진입니다. </h3>
                                <p>하루방은 거꾸로하면 방루하 사진을 올려봅니다. 작성자 : 관리자</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>