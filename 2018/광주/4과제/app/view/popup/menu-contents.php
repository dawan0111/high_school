<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>메인 페이지 컨텐츠 설정</title>

    <link rel="stylesheet" href="/css/default.css">

    <link rel="stylesheet" href="/css/popup.css">

    <link rel="stylesheet" href="/css/admin.css">

    <script src='/js/jquery.min.js'></script>

    <script src='/js/script.js'></script>
</head>

<body>
    <div id="menu-contents">
        <div class="page-title">
            메뉴별 컨텐츠
        </div>

        <div class="menu-type">
            <button type="button" data-loc="/admin/menuclear/<?php echo $idx ?>" >초기화</button>
            <button type="button" >HTML 입력</button>
            <button type="button" >게시판 연동</button>
        </div>

        <div class="board-connect">
            <form method="post" action="/admin/menuset/<?php echo $idx ?>" class="table2-frm" style="display:none;" >
                <input type="hidden" name="type" value="html">
                <table class="table1">
                    <thead>
                        <tr>
                            <th>현재설정 : 내용을 작성합니다.</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>
                                <textarea name="text"></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
            <form method="post" action="/admin/menuset/<?php echo $idx ?>" class="table3-frm active">
                <input type="hidden" name="type" value="board">
                <table class="table2">
                    <thead>
                        <tr>
                            <th>현재설정 : 게시판을 연동합니다.</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>
                                <select name="board" id="board">
                                    <option value="">선택하세요.</option>
                                    <?php foreach ($board as $key => $data): ?>
                                        <option value="<?php echo $data['idx'] ?>"><?php echo $data['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
            <div class="save-btn" data-type="3">
                <button type="button">변경사항 적용하기</button>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function() {
            set();
        });
    </script>
</body>

</html>
