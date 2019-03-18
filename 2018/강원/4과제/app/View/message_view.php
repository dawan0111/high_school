<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta content="" name="keywords">
<meta content="" name="description">
<title>:: 불우이웃돕기 ::</title>
<link href="/assets/css/style.css" rel="stylesheet" type="text/css">

<script src="/assets/jquery/jquery-3.3.1.js"></script>
<script src="/assets/jquery/jquery-ui-1.12.1/jquery-ui.js"></script>
<script src="/assets/js/app.js"></script>
</head>

<body>

<div style="width:800px; min-height:400px;">
    

    
		<table class="mess_table" style="border-collapse:collapse; width:99%; margin-top:10px;">

			<tr>
                <td colspan="2" style="border:none;"><span style="font-size:30px; font-weight:bold;"><?php echo $login['id'] ?> 님 알림</span></td>
            </tr>

			<tr style="border-top:solid 2px #000; border-bottom:solid 1px #ccc;">
				<td style=" width:120px; font-weight:bold;">보낸 사람</td>
				<td style=" text-align:left;">
					관리자
				 </td>
			</tr>

			<tr>
				<td style=" width:120px; font-weight:bold;">보낸 날짜</td>
				<td style=" text-align:left;">
					<?php echo $message["date"] ?>
				 </td>
			</tr>
			
			<tr>
				<td style=" width:120px; font-weight:bold;">제 목</td>
				<td style="text-align:left;">
					<?php echo $message["title"] ?>
				 </td>
			</tr>
			
			<tr>
				<td style=" width:120px; font-weight:bold;">내 용</td>
				<td style="text-align:left;">
					<div style="width:96%; min-height:100px; padding:10px; border:solid 1px #000;">
						<?php echo $message["content"] ?>
					</div>
				
				 </td>
			</tr>
			
			<tr>
				<td colspan="2" style="border:none;">
					<input class="n_btn" type="button" value="목록으로" onclick="location.href='/message/index'">
					<input class="n_btn" type="button" value="삭제" onclick="location.href='/message/delete/<?php echo $message['idx'] ?>'">
				</td>
			</tr>
			
			
		</table>
	</div>
</body>
</html>

