<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>로그인 완료</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">
<script src="jquery-3.2.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="app.js"></script>
</head>

<body>
    <nav class="navbar navbar-default" style="margin-bottom:10px;">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Hotel Jeju</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="#">예약하기</a></li>
                <li><a href="#">문의하기</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="page-header">
            <h2>오늘의 예약 현황</h2>
        </div>
        <div class="row" style="margin-bottom:10px;">
            <div class="col-lg-6 col-lg-offset-6">
                <div class="input-group">
                    <span class="input-group-addon">오늘날짜</span>
                    <input type="date" class="form-control" value="2017-06-25">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">보기</button>
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
            <p>* 각 층별로 홀수실은 육지, 짝수실은 바다를 바라보고 있습니다.</p>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">1층
                <span class="label label-primary pull-right">사용중</span>
            </div>
            <div class="panel-body">
                <table class="table table-bordered hotel-view">
                    <tr>
                        <td>101</td>
                        <td>103</td>
                        <td class="bg-primary">105</td>
                        <td class="bg-primary">107</td>
                        <td class="bg-primary">109</td>
                        <td class="bg-primary">111</td>
                        <td>113</td>
                        <td>115</td>
                        <td>117</td>
                        <td>119</td>
                    </tr>
                    <tr>
                        <td colspan="10"></td>
                    </tr>
                    <tr>
                        <td>102</td>
                        <td>104</td>
                        <td>106</td>
                        <td>108</td>
                        <td class="bg-primary">110</td>
                        <td class="bg-primary">112</td>
                        <td class="bg-primary">114</td>
                        <td>116</td>
                        <td class="bg-primary">118</td>
                        <td class="bg-primary">120</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">2층
                <span class="label label-primary pull-right">사용중</span>
            </div>
            <div class="panel-body">
                <table class="table table-bordered hotel-view">
                    <tr>
                        <td>201</td>
                        <td>203</td>
                        <td class="bg-primary">205</td>
                        <td class="bg-primary">207</td>
                        <td class="bg-primary">209</td>
                        <td class="bg-primary">211</td>
                        <td>213</td>
                        <td>215</td>
                        <td>217</td>
                        <td>219</td>
                    </tr>
                    <tr>
                        <td colspan="10"></td>
                    </tr>
                    <tr>
                        <td>202</td>
                        <td>204</td>
                        <td>206</td>
                        <td>208</td>
                        <td class="bg-primary">210</td>
                        <td class="bg-primary">212</td>
                        <td class="bg-primary">214</td>
                        <td>216</td>
                        <td class="bg-primary">218</td>
                        <td class="bg-primary">220</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">3층
                <span class="label label-primary pull-right">사용중</span>
            </div>
            <div class="panel-body">
                <table class="table table-bordered hotel-view">
                    <tr>
                        <td>301</td>
                        <td>303</td>
                        <td class="bg-primary">305</td>
                        <td class="bg-primary">307</td>
                        <td class="bg-primary">309</td>
                        <td class="bg-primary">311</td>
                        <td>313</td>
                        <td>315</td>
                        <td>317</td>
                        <td>319</td>
                    </tr>
                    <tr>
                        <td colspan="10"></td>
                    </tr>
                    <tr>
                        <td>302</td>
                        <td>304</td>
                        <td>306</td>
                        <td>308</td>
                        <td class="bg-primary">310</td>
                        <td class="bg-primary">312</td>
                        <td class="bg-primary">314</td>
                        <td>316</td>
                        <td class="bg-primary">318</td>
                        <td class="bg-primary">320</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">4층
                <span class="label label-primary pull-right">사용중</span>
            </div>
            <div class="panel-body">
                <table class="table table-bordered hotel-view">
                    <tr>
                        <td>401</td>
                        <td>403</td>
                        <td class="bg-primary">405</td>
                        <td class="bg-primary">407</td>
                        <td class="bg-primary">409</td>
                        <td class="bg-primary">411</td>
                        <td>413</td>
                        <td>415</td>
                        <td>417</td>
                        <td>419</td>
                    </tr>
                    <tr>
                        <td colspan="10"></td>
                    </tr>
                    <tr>
                        <td>402</td>
                        <td>404</td>
                        <td>406</td>
                        <td>408</td>
                        <td class="bg-primary">410</td>
                        <td class="bg-primary">412</td>
                        <td class="bg-primary">414</td>
                        <td>416</td>
                        <td class="bg-primary">418</td>
                        <td class="bg-primary">420</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">5층
                <span class="label label-primary pull-right">사용중</span>
            </div>
            <div class="panel-body">
                <table class="table table-bordered hotel-view">
                    <tr>
                        <td>501</td>
                        <td>503</td>
                        <td class="bg-primary">505</td>
                        <td class="bg-primary">507</td>
                        <td class="bg-primary">509</td>
                        <td class="bg-primary">511</td>
                        <td>513</td>
                        <td>515</td>
                        <td>517</td>
                        <td>519</td>
                    </tr>
                    <tr>
                        <td colspan="10"></td>
                    </tr>
                    <tr>
                        <td>502</td>
                        <td>504</td>
                        <td>506</td>
                        <td>508</td>
                        <td class="bg-primary">510</td>
                        <td class="bg-primary">512</td>
                        <td class="bg-primary">514</td>
                        <td>516</td>
                        <td class="bg-primary">518</td>
                        <td class="bg-primary">520</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
