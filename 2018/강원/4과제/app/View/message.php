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

<div style="width:880px; min-height:400px;">
    
    <table class="mess_table" style="border-collapse:collapse; width:100%; margin-bottom:20px; margin-top:5px; ">
    	<tr>
        	<td colspan="4" style="border:none;">
				<span style="font-size:30px; font-weight:bold;"><?php echo $login["id"] ?>님 알림</span>
			</td>
    	</tr>
        
         <tr>
            	<td class="fb" style="width:15%;"><span style="font-size:16px; color:#000;">보낸 사람</span></td>
				<td class="fb" style="width:50%;"><span style="font-size:16px; color:#000;">제 목</span></td>
                <td class="fb" style="width:25%;"><span style="font-size:16px; color:#000;">보낸 날짜</span></td>
                <td class="fb" style="width:10%;"><span style="font-size:16px; color:#000;">읽 음</span></td>
        </tr>

        <?php foreach ($messages as $key => $message): ?>
			<tr>
				<td>
					관리자
				</td>
				<td>
					<a style=" color:#7d6c27;" class=" cu" href="/message/view/<?php echo $message['idx'] ?>">
						<?php echo $message["title"] ?>
					</a>
				</td>
				<td>
					<?php echo $message["date"] ?>
				</td>
				<td>
				
					<span class="blue"><?php echo $message["view"] ? "O" : "X" ?></span>
			   
			 
				</td>
			</tr>
        <?php endforeach ?>

        	<?php if (count($messages) == 0): ?>
		        <tr>
		        	<td colspan="4" style="font-size:13px;">
		            	알림이 없습니다.
		        	</td>
		        </tr>
        	<?php endif ?>
       
        	</table>
	</div>
</body>
</html>

