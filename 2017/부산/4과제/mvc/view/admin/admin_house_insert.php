

<div id="fh5co-main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal" method="post" action="/house/addHouse" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="inputHouse">펜션명</label>
                        <div class="col-sm-6">
                            <input class="form-control" id="" type="text" placeholder="펜션명" name="name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="inputCost">가격</label>
                        <div class="col-sm-6">
                            <input class="form-control" id="" type="number" placeholder="가격" name="price" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="inputPasswordCheck">전화번호</label>
                        <div class="col-sm-6">
                            <input class="form-control" id="" type="tel" placeholder="010-0000-0000" name="phone" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 text-center">
                            <label for="exampleInputFile" class="col-sm-3 control-label">사진 업로드</label>
                            <input type="file" id="exampleInputFile" accept="image/*" name="file" required>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 text-center">
                            <button class="btn btn-primary" type="submit">펜션등록<i class="fa fa-check spaceLeft"></i></button>
                            <button class="btn btn-danger" type="reset">초기화<i class="fa fa-times spaceLeft"></i></button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

