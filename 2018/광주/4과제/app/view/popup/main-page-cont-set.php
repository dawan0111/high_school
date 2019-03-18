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
            메인페이지 컨텐츠
        </div>
        
        <div class="menu-type">
            <button type="button" data-loc="/admin/dancontclear/<?php echo $idx ?>" >초기화</button>
            <button type="button" >배너 연동</button>
            <button type="button" >게시판 연동</button>
        </div>
        
        <div class="board-connect">
            <form method="post" enctype="multipart/form-data" action='/admin/maincontset/<?php echo $idx ?>' class="table2-frm" style="display:none;">
                 <table class="table2">
                     <thead>
                         <tr>
                             <th>현재설정 : 배너를 연동합니다.</th>
                         </tr>
                     </thead>

                     <tbody>
                         <tr>
                             <td>
                                 <table>
                                     <tbody>
                                         <tr>
                                             <td>기본 이미지 (필수사항)</td>
                                             <td>
                                                 <input type="hidden" name="type" value="banner">
                                                 <ul>
                                                     <li>
                                                        <?php if ($cont["def_img"] == ""): ?>
                                                            설정된 이미지가 없습니다.(GIF, JPG, PNG 파일만 업로드 가능합니다)
                                                        <?php else: ?>
                                                            <?php echo fm($cont["def_img"]) ?>
                                                        <?php endif ?>
                                                     <li><input type="file" name="def_img"></li>
                                                 </ul>
                                             </td>
                                         </tr>

                                         <tr>
                                             <td>오버 이미지 (선택사항)</td>
                                             <td>
                                                 <ul>
                                                     <li>
                                                        <?php if ($cont["over_img"] == ""): ?>
                                                            설정된 이미지가 없습니다.(GIF, JPG, PNG 파일만 업로드 가능합니다)
                                                        <?php else: ?>
                                                            <?php echo fm("over_img") ?>
                                                        <?php endif ?>
                                                     <li><input type="file" name="over_img"></li>
                                                 </ul>
                                             </td>
                                         </tr>

                                         <tr>
                                             <td>링크 URL</td>
                                             <td>
                                                 <input type="text" name="link" value="">
                                                 <select name="link_type" id="">
                                                     <option value="1">현재창(_SELF)</option>
                                                     <option value="2">새창(_blank)</option>
                                                 </select>
                                             </td>
                                         </tr>
                                     </tbody>
                                 </table>
                             </td>
                         </tr>
                     </tbody>
                 </table>
             </form>

            <form method="post" enctype="multipart/form-data" action='/admin/maincontset/<?php echo $idx ?>' class="table1-frm active">
                <table class="table1">
                    <thead>
                        <tr>
                            <th>현재설정 : 게시판을 연동합니다.</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>
                                <input type="hidden" name="type" value="board">
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
        
            <div class="save-btn" >
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