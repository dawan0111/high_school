	<div class="mail-content">
		<div class="mail-title">
			<div>휴지통</div>
			<div>
				<span>휴지통 전체 메일 개수 : <?php echo $fullCount ?>개</span>
			</div>
		</div>
		<form method="post" action="/mail/action">
			<div class="mail-skill-btn-group">
				<div class="btn-group">
					<button class="btn btn-default" name="veryDelete">영구삭제</button>
				</div>
				<div class="btn-group">
					<button class="btn btn-default" name="restore">복구</button>
				</div>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th><input type="checkbox"></th>
						<th>보낸사람</th>
						<th>제목</th>
						<th>날짜</th>	
						<th>크기</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($mailList as $key => $mail): ?>
						<?php
							if($mail["target"] == $login["email"]) {
								$read = $mail["t_read"] ? "read" : "";
							} else {
								$read = $mail["s_read"] ? "read" : "";
							};
						?>
						<tr class="<?php echo $read ?>">
							<td><input type="checkbox" name="midx[]" value="<?php echo $mail['idx'] ?>"></td>
							<td><?php echo $mail["send_name"] ?></td>
							<td><a href="/mail/view/<?php echo $mail['idx'] ?>?search=<?php echo $search ?>"><?php echo $mail["title"] ?></a></td>
							<td><?php echo date("Y-m-d", strtotime($mail["date"])) ?></td>	
							<td><?php echo $mail["filesize"] ?>KB</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</form>
	</div>
</section>