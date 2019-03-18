	<!-- content -->
<section id="content">
	<div id="title1">당첨자보기</div>
    
    <div class="wrap mat30 mab40">

		<div style="font-size:32px; font-weight:bold;  margin-top:40px;">
			※ <span class="red"><?php echo $time ?> 회 <span class="blue"><?php echo $kind ?>-<?php echo $count ?></span> &nbsp;&nbsp;
			<form method="get" style="display: inline-block;">
				<select id="vv_time" style="border:solid 1px #000; vertical-align:middle; font-size:17px; padding:3px;" name="time">
					<?php for ($i=$max; $i > 0; $i--) {  ?>
						<option value="<?php echo $i ?>" <?php echo $i == $time ? "selected" : ""; ?>><?php echo $i ?>회</option>
					<?php } ?>
				</select>&nbsp;

				<select id="vv_kind" style="border:solid 1px #000; vertical-align:middle; font-size:17px; padding:3px;" name="kind">
					<?php foreach ($rooms as $key => $room): ?>
						<option value="<?php echo $room['kind'] ?>-<?php echo $room['count'] ?>"
							<?php echo $room["kind"]."-".$room["count"] == $kind."-".$count ? "selected" : ""; ?>
							><?php echo $room['kind'] ?>-<?php echo $room['count'] ?></option>
					<?php endforeach ?>
				</select>&nbsp;
				<button class="n_btn" style="vertical-align:middle; font-weight:bold; ">보 기</button>
			</form>
		</div>

		<table id="m_table" style="width:100%; margin-top:40px;">
        	<thead>
            	<tr>
                    <td>아이디</td>
                    <td style="width:35%;">참가번호</td>
                    <td>적중개수/차이값</td>
                    <td>순위</td>
                </tr>
            </thead>
            
            <tbody>
            	<?php $overlap = 1; ?>
            	<?php foreach ($numbers as $key => $number): ?>
            		<?php $rank = 1; ?>
            		<?php
            			if($key > 0) {
            				if(
            					count($number["success"]) == count($numbers[$key - 1]["success"]) &&
            					$number["diff"] == $numbers[$key - 1]["diff"]
            				) {
            					$rank = $rank;
            					$overlap++;
            				} else {
            					$rank += $overlap;
            					$overlap = 1;
            				};
            			};
            		?>
					<tr>
						<td><span class="blue"><?php echo $number["id"] ?></span></td>
						<td style="width:35%;">
							<div class="t_div" style="width:100%; min-height:1px;">
								<?php
								    $ok_number = explode(",", $number["number"]);
								    sort($ok_number);
								?>

								<?php foreach ($ok_number as $key => $val): ?>
								    <div>
								        <img src="/assets/image/ball_<?php echo $val ?>.png">
								        <?php if (!in_array($val, explode(",", $number["ok_number"]))): ?>
								            <span></span>
								        <?php endif ?>
								    </div>
								<?php endforeach ?>
							</div>
							<div class="cl"></div>
						</td>
						<td><?php echo count($number["success"]) ?>/<?php echo $number["diff"] ?></td>
						<td><?php echo $rank ?>(<?php echo number_format($number["point"] / 100 * 80) ?>)</td>
					</tr>
            	<?php endforeach ?>

				<?php if (count($numbers) == 0): ?>
					<tr>
	                    <td colspan="6">내역이 없습니다.</td>                   
	                </tr>
				<?php endif ?>
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

