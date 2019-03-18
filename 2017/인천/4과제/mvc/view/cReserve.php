    <div class="container">
        <h3>예약하기</h3>
        <ul class="nav nav-pills nav-justified">
            <li class="active"><a href="/reserve/c">수동 예약</a></li>
            <li><a href="/reserve/a">자동 예약</a></li>
        </ul>
        <div class="panel"></div>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                    <p>
                        예약된 방 : <spaa class="label label-primary"> 방 번호 </spaa> 
                        <span class="pull-right">* 각 층별로 홀수실은 육지, 짝수실은 바다를 바라보고 있습니다.</span>
                    </p>
                    </div>
                    <div class="col-lg-4">
                        <form class="form-horizontal creserve-form" method="post" action="/reserve/reserve">
                            <div class="input-group">
                            <span class="input-group-addon">입실</span>
                                <input type="date" class="form-control date indate" name="indate" required>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">퇴실</span>
                                <input type="date" class="form-control date outdate" name="outdate" required>
                            </div>
                            <label for="number">방리스트</label>
                            <select multiple class="form-control" id="number" name="number[]" disabled required>
                                <?php foreach ($rooms as $key => $room): ?>
                                    <option><?php echo $room["number"] ?></option>
                                <?php endforeach ?>
                            </select>
                            <input type="submit" class="btn btn-success btn-block" value="예약하기">
                        </form>
                    </div>
                    <div class="col-lg-8">
                        <table class="table table-bordered hotel-view">
                            <tr>
                                <td>101</td>
                                <td>103</td>
                                <td>105</td>
                                <td>107</td>
                                <td>109</td>
                                <td>111</td>
                                <td>113</td>
                                <td>115</td>
                                <td>117</td>
                                <td>119</td>
                            </tr>
                            <tr>
                                <td colspan="10">1층</td>
                            </tr>
                            <tr>
                                <td>102</td>
                                <td>104</td>
                                <td>106</td>
                                <td>108</td>
                                <td>110</td>
                                <td>112</td>
                                <td>114</td>
                                <td>116</td>
                                <td>118</td>
                                <td>120</td>
                            </tr>
                        </table><br>
                        <table class="table table-bordered hotel-view">
                            <tr>
                                <td>201</td>
                                <td>203</td>
                                <td>205</td>
                                <td>207</td>
                                <td>209</td>
                                <td>211</td>
                                <td>213</td>
                                <td>215</td>
                                <td>217</td>
                                <td>219</td>
                            </tr>
                            <tr>
                                <td colspan="10">2층</td>
                            </tr>
                            <tr>
                                <td>202</td>
                                <td>204</td>
                                <td>206</td>
                                <td>208</td>
                                <td>210</td>
                                <td>212</td>
                                <td>214</td>
                                <td>216</td>
                                <td>218</td>
                                <td>220</td>
                            </tr>
                        </table><br>
                        <table class="table table-bordered hotel-view">
                            <tr>
                                <td>301</td>
                                <td>303</td>
                                <td>305</td>
                                <td>307</td>
                                <td>309</td>
                                <td>311</td>
                                <td>313</td>
                                <td>315</td>
                                <td>317</td>
                                <td>319</td>
                            </tr>
                            <tr>
                                <td colspan="10">3층</td>
                            </tr>
                            <tr>
                                <td>302</td>
                                <td>304</td>
                                <td>306</td>
                                <td>308</td>
                                <td>310</td>
                                <td>312</td>
                                <td>314</td>
                                <td>316</td>
                                <td>318</td>
                                <td>320</td>
                            </tr>
                        </table><br>
                        <table class="table table-bordered hotel-view">
                            <tr>
                                <td>401</td>
                                <td>403</td>
                                <td>405</td>
                                <td>407</td>
                                <td>409</td>
                                <td>411</td>
                                <td>413</td>
                                <td>415</td>
                                <td>417</td>
                                <td>419</td>
                            </tr>
                            <tr>
                                <td colspan="10">4층</td>
                            </tr>
                            <tr>
                                <td>402</td>
                                <td>404</td>
                                <td>406</td>
                                <td>408</td>
                                <td>410</td>
                                <td>412</td>
                                <td>414</td>
                                <td>416</td>
                                <td>418</td>
                                <td>420</td>
                            </tr>
                        </table><br>
                        <table class="table table-bordered hotel-view">
                            <tr>
                                <td>501</td>
                                <td>503</td>
                                <td>505</td>
                                <td>507</td>
                                <td>509</td>
                                <td>511</td>
                                <td>513</td>
                                <td>515</td>
                                <td>517</td>
                                <td>519</td>
                            </tr>
                            <tr>
                                <td colspan="10">5층</td>
                            </tr>
                            <tr>
                                <td>502</td>
                                <td>504</td>
                                <td>506</td>
                                <td>508</td>
                                <td>510</td>
                                <td>512</td>
                                <td>514</td>
                                <td>516</td>
                                <td>518</td>
                                <td>520</td>
                            </tr>
                        </table>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
    
    <script src="/js/app.js"></script>
    <script src="/js/creserve.js"></script>
</body>
</html>