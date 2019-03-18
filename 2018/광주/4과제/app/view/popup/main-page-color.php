<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>메인 페이지 라인 및 배경색 설정</title>
    
    <link rel="stylesheet" href="/css/default.css">
    
    <link rel="stylesheet" href="/css/popup.css">
    
    <link rel="stylesheet" href="/css/admin.css">
    
    <script src='/js/jquery.min.js'></script>
    
    <script src='/js/script.js'></script>
</head>
<body>
    <div class="popup">
        <div class="page-title">
            메인페이지 구성
        </div>

        <form method="post" action="/admin/maincolor/<?php echo $idx ?>" >
            <table class="main-content">
                <colgroup>
                    <col style="width:20%;">
                    <col style="width:80%;">
                </colgroup>

                <tbody>
                    <tr>
                        <td>영역 상단 라인색 (Border Color)</td>
                        <td>
                            <input type="text" name="top" value="<?php echo $dan['top'] ?>" readonly>
                            <span class="prv-color" style="display:inline-block; vertical-align:middle; width:25px; height:25px; border:1px solid #ccc; "></span>
                            <img src="/images/color.gif" alt="color">(R, G, B 색상코드 선택)
                            <div class="color-picker"></div>
                        </td>
                    </tr>

                    <tr>
                        <td>영역 하단 라인색 (Border Color)</td>
                        <td>
                            <input type="text" name="bottom" value="<?php echo $dan['bottom'] ?>" readonly>
                            <span class="prv-color" style="display:inline-block; vertical-align:middle; width:25px; height:25px; border:1px solid #ccc; "></span>
                            <img src="/images/color.gif" alt="color">(R, G, B 색상코드 선택)
                            <div class="color-picker"></div>
                        </td>
                    </tr>

                    <tr>
                        <td>영역 배경색 (Background Color)</td>
                        <td>
                            <input type="text" name="bg" value="<?php echo $dan['bg'] ?>"  readonly>
                            <span class="prv-color" style="display:inline-block; vertical-align:middle;width:25px; height:25px; border:1px solid #ccc; "></span>
                            <img src="/images/color.gif" alt="color">(R, G, B 색상코드 선택)
                            <div class="color-picker"></div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="save-btn">
                <button type="submit">변경사항 적용하기</button>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        $(function() {
            $("img").on("click", function() {
                colorPicker(this);
            });

            viewColor();
        });
    </script>
</body>
</html>