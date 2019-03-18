<!-- content -->
<section id="content">
	<div id="title1">참가내역</div>
    
    <div class="wrap mat30 mab40">
      <table id="m_table" style="width:100%;">
        	<thead>
            	<tr>
                	<td>참가구분</td>
                    <td>참가회차</td>
                    <td style="width:35%;">참가번호</td>
                    <td>적중개수/차이값</td>
                    <td>참가일자</td>
                </tr>
            </thead>
            
            <tbody>

            <?php foreach ($join_list as $key => $join): ?>
                <tr>
                    <td><span class="blue"><?php echo $join["kind"] ?>-<?php echo $join['count'] ?></span></td>
                    <td><span class="red"><?php echo $join['time'] ?> 회</td>
                    <td style="width:35%;">
                        <?php if ($join["end"]): ?>
                        <?php
                            $result = getGood($join["number"], $join['ok_number']);
                            $ok = $result["ok"];
                        ?>
                        <?php else: ?>
                        <?php
                            $ok = range(1, 45);
                        ?>
                        <?php endif; ?>

                        <div class="t_div" style="width:100%; min-height:1px;">
                            <?php
                                $number = explode(",", $join["number"]);
                                sort($number);
                            ?>

                            <?php foreach ($number as $key => $val): ?>
                                <div>
                                    <img src="/assets/image/ball_<?php echo $val ?>.png">
                                    <?php if (!in_array($val, $ok)): ?>
                                        <span></span>
                                    <?php endif ?>
                                </div>
                            <?php endforeach ?>

                        </div>
                        <div class="cl"></div>
                    </td>
                    <td>
                        <span style='font-size:17px;'>
                            <?php if ($join["end"]): ?>
                                <?php echo count($result["ok"])."/".$result["diff"] ?>
                            <?php else: ?>
                                미추첨
                            <?php endif ?>
                        </span>
                    </td>

                    <td><?php echo $join["date"] ?></td>
                </tr>                
            <?php endforeach ?>
<!--
				<tr>
                    <td colspan="6">참가 내역이 없습니다.</td>                   
                </tr>
-->
            </tbody>
        </table>
        
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

