

<!-- content -->
<section id="content">

    <div class="wrap mat50 tc">
    	<div class="title">기부현황</div>
    	<div class="flex mat50">
        	<div class="con"> 
            	<div class="img_box">
                	<img src="/assets/image/old_man.jpg" alt="독거노인돕기" class="<?php echo isset($login) && $login['id'] != "admin" ? 'give-image' : 'user-image' ?>">
                </div>
                <div class="ft23 mab10">독거노인돕기</div>	
                <div class="ft19"><span class="blue">총 기부 현황</span> : <span class="red"><?php echo number_format($give["old"]) ?></span> 포인트</div>	
            </div>
            
            
            <div class="con"> 
            	<div class="img_box">
                	<img src="/assets/image/child.jpg" alt="불우아동돕기" class="<?php echo isset($login) && $login['id'] != "admin" ? 'give-image' : 'user-image' ?>">
                </div>
                <div class="ft23 mab10">불우아동돕기</div>
                <div class=" ft19"><span class="blue">총 기부 현황</span> : <span class="red"><?php echo number_format($give["child"]) ?></span> 포인트</div>			
            </div>
            

        </div>
    </div>
    
    
    <div class="wrap mat80 tc">
    	<div class="title"><?php echo str_pad($event_time, 2, 0, STR_PAD_LEFT) ?>회 나눔로또 참여하기</div>
    	<div class="flex mat50">
            <?php foreach ($event_list as $key => $event): ?>
            	<div class="con"> 
                	<div class="img_box">
                    	<img src="/assets/image/<?php echo $event['image'] ?>" alt="<?php echo $event['kind'] ?>">
                    </div>
                    <div class=" ft23 mab10 red"><?php echo $event['kind'] ?>-<?php echo $event['count'] ?></div>	
                    <div class=" ft14 mab5">참여포인트(<?php echo number_format($event["use_point"]) ?>)</div>
                    <div class=" ft16 blue">참여인원 : <?php echo $event["people"] ?> / <?php echo $event["max_people"] ?> 명</div>
                    <div class="mat10">
                    	<button class="co1 ft15 fb" onclick="location.href='/event/attend/<?php echo $event['idx'] ?>'">참가하기</button>
                	</div>	
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <?php if ($event_time != 1): ?>
        <div class="wrap mat80 tc">
        	<div class="title"><?php echo str_pad($event_time - 1, 2, 0, STR_PAD_LEFT) ?>회 당첨자 명단</div>
        	
    		<table id="m_table" class="ww mat30">
            	<thead>
                	<tr>
                    	<td>참가구분 / 아이디</td>
                        <td style="width:35%;">참가번호</td>
                        <td>적중개수</td>
                        <td>차이값</td>
                        <td>당첨포인트</td>
                    </tr>
                </thead>
                
                <tbody>
                    <?php foreach ($numbers as $key => $number): ?>
                        <tr>
                            <td><?php echo $number['kind'] ?>-<?php echo $number['count'] ?> / <span class="blue"><?php echo $number['id'] ?></span> </td>
                            <td style="width:35%;">
                            	<div class="t_div" style="width:100%; min-height:1px;">
                                    <?php foreach (explode(",", $number["ok_number"]) as $key => $val): ?>
                                        <div>
                                            <img src="/assets/image/ball_<?php echo $val ?>.png" alt="ball">
                                            <?php if (!in_array($val, $number["success"])): ?>
                                                <span></span>
                                            <?php endif ?>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                                <div class="cl"></div>
                            </td>
                            <td><?php echo count($number["success"]) ?></td>
                            <td><?php echo $number["diff"] ?></td>
                            <td><?php echo number_format($number["point"] / 100 * 80) ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            
        </div>
    <?php endif ?>
    
</section>


<section id="review">

	<div class="re_title wrap tc">
    	공지사항
        <div><a href="#">+more</a></div>
    </div>
    
    <div class="wrap">
        <table class="table1">
            <tr>
                <td style="width:10%;">No</td>
                <td style="width:50%;">Title</td>
                <td style="width:25%;">Date</td>
                <td style="width:15%;">Writer</td>
            </tr>
        </table>
        
        <table class="table2">
            <?php foreach ($notices as $key => $notice): ?>
                <tr>
                    <td style="width:10%;"><?php echo $notice['idx'] ?></td>
                    <td style="width:50%;">
                        <a href="/notice/view/<?php echo $notice['idx'] ?>">
                            <?php echo mb_substr($notice["title"], 0, 26) ?>
                            <?php if (mb_strlen($notice["title"]) > 24): ?>
                                <?php echo "..." ?>
                            <?php endif ?>
                        </a>
                    </td>
                    <td style="width:25%;"><?php echo date("Y-m-d", strtotime($notice["date"])) ?></td>
                    <td style="width:15%;">관리자</td>
                </tr>                   
            <?php endforeach ?>
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

