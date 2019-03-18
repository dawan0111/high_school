    <div class="container">
        <div class="page-header">
            <h3>문의 확인하기</h3>
        </div>
        <div class="row">
            <table class="table table-striped">
                <tr>
                    <th width="20%">이름</th><th width="70%">내용</th><th>메뉴</th>
                </tr>
                <?php foreach ($faqs as $key => $value): ?>
                    <tr>
                        <td><?php echo $value["fromname"] ?></td>
                        <td><?php echo $value["content"] ?></td>
                        <td><a class='btn btn-primary' href="/faq/index?toid=<?php echo $value['fromid'] ?>">답변하기</a></td>
                    </tr>
                <?php endforeach ?>
            </table>

            <ul class="pagination">
                <?php for ($i=1; $i <= $blockend; $i++) {  ?>
                    <?php $selected = $i == $page ? "class='active'" : ""; ?>
                    <li <?php echo $selected ?>><a href="/admin/faq?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</body>
</html>