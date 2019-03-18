<!-- content -->
<section id="content">
	<div id="title1">공지사항</div>
    
    <div class="wrap mat30 mab40">


		<table id="m_table" style="width:100%; margin-top:40px;">
        	<thead>
            	<tr>
                    <td>번 호</td>
                    <td style="width:35%;">제 목</td>
                    <td>작성자</td>
                    <td>작성일</td>
                </tr>
            </thead>
            
            <tbody>
                <?php foreach ($notices as $key => $notice): ?>
    				<tr>
    					<td><?php echo $notice["idx"] ?></td>
    					<td style="width:35%;"><a href="/notice/view/<?php echo $notice['idx'] ?>"><?php echo $notice["title"] ?></a></td>
    					<td>관리자</td>
    					<td><?php echo $notice["date"] ?></td>
    				</tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <?php if (isset($login) && $login["id"] == "admin"): ?>
            <div style="width:100%; text-align:right; margin-top:30px;">
            	<input type="button" class="n_btn" value="글쓰기" onclick="location.href='/notice/write'">
            </div>
        <?php endif ?>
     
    </div>
    
</section>

<!-- footer -->

<footer>
    <div class="wrap">
    	<i>Copyright ⓒ 2018 nanum-lotto All Rights Reserved.</i>
    </div>
</footer>


</body>
</html>

