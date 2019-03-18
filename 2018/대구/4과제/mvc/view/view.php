			<div class="mail-content">
				<div class="mail-title">메일 보기</div>
				<div class="mail-write">
					<div class="form-group input-group">
						<h3 class="content-title"><?php echo $mail["title"] ?></h3>
					</div>
					<div class="form-group input-group">
                        <p class="content-title"><?php echo $mail["date"] ?></p>
					</div>
					<div class="form-group">
						<p class="highrights">
							<?php
								$img = "/\&lt\;img (.+?)\/?\&gt\;/";
								$a = "/\&lt\;a (.*?)\&gt\;(.+?)\&lt\;\/a\&gt\;/";
								$span = "/\&lt\;span class\=\'highright\'\&gt\;(.+?)\&lt\;\/span\&gt\;/";

								echo preg_replace_callback([$img, $a, $span], function($a) {
								   return htmlspecialchars_decode($a[0]);
								}, nl2br(htmlspecialchars($mail["content"], ENT_NOQUOTES)));
							?>
						</p>
						<br><br><br><br><br>
						<strong>파일 :</strong><br>
						<?php foreach ($mail["files"] as $key => $file): ?>
							<a href="/mail/download?idx=<?php echo $file['idx'] ?>" class="download-file"><?php echo $file["filename"] ?> (<?php echo $file["filesize"] ?>MB)</a>
						<?php endforeach ?>
					</div>
				</div>
			</div>
		</section>
		<aside class="search-aside">
		</aside>
	</article>

	<script type="text/javascript">
		let $ = document.querySelectorAll.bind(document);
		let reg = new RegExp("<?php echo $_GET['search'] ?>", "g");
		let ltReg = new RegExp("\&lt;", "g");
		let gtReg = new RegExp("\&gt;", "g");

		$(".highrights")[0].childNodes.forEach( function(ele, index) {
		   if (ele.nodeName == "#text" && ele.data.trim() != "") {
		      ele.data = ele.data.trim().replace(reg, "<span class='highright'>$&</span>");
		   }
		});
		$(".highrights a").forEach(function(ele, index) {
		   ele.innerText = ele.innerText.replace(reg, "<span class='highright'>$&</span>")
		});

		$(".highrights")[0].innerHTML = $(".highrights")[0].innerHTML.replace(ltReg, '<').replace(gtReg, ">");
	</script>
</body>
</html>