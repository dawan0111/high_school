        <div id="contents" class="main-image">
            <div class="wrap">
                <div class="page-title">
                    <h3>애니메이션 구성</h3>
                </div>

                <form class="main-image-frm" enctype="multipart/form-data" action="/admin/ani" method="post" >
                    <table>
                        <colgroup>
                            <col style="width:17%;">
                            <col style="width:22%;">
                            <col style="width:22%;">
                            <col style="width:22%;">
                            <col style="width:17%;">
                        </colgroup>

                        <thead>
                            <tr>
                                <th>좌측배경 (옵션)</th>
                                <th>이미지1</th>
                                <th>이미지2</th>
                                <th>이미지3</th>
                                <th>우측배경 (옵션)</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    <span>배경색 : #<input type="text" name="l_bg" maxlength="6" value="<?php echo $ani['l_bg'] ?>"><div class="btn" ><button type="button" class="bc-remove c-remove" data-col="l_bg" >삭제</button></div>
                                   </span>
                                </td>
                                <td>
                                    <span >
                                        <button type="button" class="f_find" style="float:left;">파일 선택</button> <span class="f_name" style="width:auto;"><?php echo fm($ani["img1"]) ?></span><input type="file" name="img1" class="file" name="m_img" style="float:left; width:180px; display:none;">
                                    <div class="btn"><button type="button" data-col="img1" class="bc-remove i-remove" >삭제</button></div>
                                    </span>
                                </td>
                                <td>
                                    <span >
                                        <button type="button" class="f_find" style="float:left;">파일 선택</button> <span class="f_name" style="width:auto;"><?php echo fm($ani["img2"]) ?></span><input type="file" name="img2" class="file" name="m_img" style="float:left; width:180px; display:none;">
                                    <div class="btn"><button type="button" data-col="img2" class="bc-remove i-remove" >삭제</button></div>
                                    </span>
                                </td>
                                <td>
                                    <span >
                                        <button type="button" class="f_find" style="float:left;">파일 선택</button> <span class="f_name" style="width:auto;"><?php echo fm($ani["img3"]) ?></span><input type="file" name="img3" class="file" name="m_img" style="float:left; width:180px; display:none;">
                                    <div class="btn"><button type="button" data-col="img3" class="bc-remove i-remove" >삭제</button></div>
                                    </span>
                                </td>

                                <td>
                                    <span>
                                       배경색 : #<input type="text" name="r_bg" maxlength="6" value="<?php echo $ani["r_bg"] ?>"><div class="btn" ><button type="button" data-col="r_bg" class="bc-remove c-remove" >삭제</button></div>
                                   </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="rotaction-sec">
                        <input type="text" name="delay" value="<?php echo $ani['delay'] ?>">
                        <p>초(Sec.) 마다 대표이미지를 변경합니다.</p>
                    </div>

                    <div class="save-btn">
                        <button type="submit" >변경사항 적용하기</button>
                    </div>
                </form>


            </div>
        </div>

        <div id="footer">
            <div class="copy">
                <p>COPYRIGHT (c) 2018 ALL RIGHTS RESERVED.</p>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function() {
            mainVisual();
        });
    </script>
</body>

</html>
