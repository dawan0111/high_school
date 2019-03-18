    <div class="container">
        <h3>포인트 지급</h3>
        <div class="panel panel-default">
            <div class="panel-body">
                <form class="admin-point-form" method="post" action="/admin/givePoint">
                    <div class="input-group">
                        <span class="input-group-addon">회원 아이디(이메일)</span>
                        <input type="email" class="form-control" placeholder="user10" name="id">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">포인트 금액</span>
                        <input type="number" class="form-control" placeholder="10000" name="point">
                    </div>
                    <button type="submit" class="btn btn-success">지급</button>
                </form>
            </div>
        </div>
        <h3>방 가격 설정</h3>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-4">
                        <h4>방 모두 변경</h4>
                        <form class="admin-point-form" method="post" action="/admin/roomPriceChange">
                            <div class="input-group">
                                <span class="input-group-addon">가격</span>
                                <input type="number" class="form-control" placeholder="가격을 입력하세요" name="price">
                            </div>
                            <button class="btn btn-success btn-block" type="submit">변경</button>
                        </form>
                        <hr>
                        <h4>선택방 변경</h4>
                        <form class="admin-point-form" method="post" action="/admin/roomPriceChange">
                            <select class="form-control" multiple name="idx[]">
                                <?php foreach ($rooms as $key => $room): ?>
                                    <option><?php echo $room["number"] ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="input-group">
                                <span class="input-group-addon">가격</span>
                                <input type="number" class="form-control" placeholder="가격을 입력하세요" name="price">
                            </div>
                            <button class="btn btn-success btn-block" type="submit">변경</button>
                        </form>
                    </div>
                    <div class="col-lg-8">
                        <h4>방 가격 목록</h4>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="admin-table">
                                    <table class="table table-bordered table-condensed">
                                        <thead>
                                            <tr>
                                                <th>층</th>
                                                <th>방번호</th>
                                                <th>가격</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($rooms as $key => $room): ?>
                                                <tr>
                                                    <td><?php echo $room["floor"] ?>층</td>
                                                    <td><?php echo $room["number"] ?></td>
                                                    <td><?php echo $room["price"] ?>원</td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>