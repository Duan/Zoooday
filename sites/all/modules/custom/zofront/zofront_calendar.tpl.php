<div class=" calendar">
	<div class="today">Hôm nay: <?php $today = getdate(); echo $today['weekday'].','.$today['mday'].'-'.$today['mon'].'-'.$today['year']; ?></div>
    <div class="title"><strong>XEM SỰ KIỆN THEO NGÀY</strong></div>
    <div class="content">
                <?php 
            $datefirt = format_date(strtotime('this week', time())-(3600*24),'custom','d');
            $mounthfirt = format_date(strtotime('this week', time()-(3600*24)),'custom','m');
            $yearfirt = format_date(strtotime('this week', time()-(3600*24)),'custom','Y');
            for($i=1;$i<8;$i++){
            	$weekdayss [] = date("d",mktime(0,0,0,$mounthfirt,$datefirt,$yearfirt)+$i * (3600*24));
            	$weekdays [] = date("l",mktime(0,0,0,$mounthfirt,$datefirt,$yearfirt)+$i * (3600*24));
            }

           foreach ($weekdays as $value) {
           	if ($value == 'Monday'){
           		$weekconvertvn[] = 'mon';
           	}
            if ($value == 'Tuesday'){
           		$weekconvertvn[] = 'tue';
           	}
            if ($value == 'Wednesday'){
           		$weekconvertvn[] = 'wed';
           	}
            if ($value == 'Thursday'){
           		$weekconvertvn[] = 'thu';
           	}
            if ($value == 'Friday'){
           		$weekconvertvn[] = 'fri';
           	}
            if ($value == 'Saturday'){
           		$weekconvertvn[] = 'sat';
           	}
            if ($value == 'Sunday'){
           		$weekconvertvn[] = 'sun';
           	}
   		
           }
 
            ?>
    	<a href="#"><span class="normal-day"><?php echo $weekconvertvn[0]?><br /><strong><?php echo $weekdayss[0]?></strong></span></a>
        <a href="#"><span class="weekend"><?php echo $weekconvertvn[1]?><br /><strong><?php echo $weekdayss[0]?></strong></span></a>
	    <a href="#"><span class="normal-day"><?php echo $weekconvertvn[2]?><br /><strong><?php echo $weekdayss[2]?></strong></span></a>
        <a href="#"><span class="normal-day"><?php echo $weekconvertvn[3]?><br /><strong><?php echo $weekdayss[3]?></strong></span></a>
        <a href="#"><span class="normal-day"><?php echo $weekconvertvn[4]?><br /><strong><?php echo $weekdayss[4]?></strong></span></a>
        <a href="#"><span class="normal-day"><?php echo $weekconvertvn[5]?><br /><strong><?php echo $weekdayss[5]?></strong></span></a>
       	<a href="#"><span class="normal-day"><?php echo $weekconvertvn[6]?><br /><strong><?php echo $weekdayss[6]?></strong></span></a>
        <div class="clear"></div>
        <div class="left" style="width:180px;">
        <a href="#" class="day">Hôm nay</a> <span style="color:#FFF">|</span> <a href="#" class="day">Tuần này</a> <span style="color:#FFF">|</span> <a href="#" class="day">Cuối tuần</a>
        </div>
        <a href="#" class="range">Chọn ngày</a>
        <div class="clear"></div>
        <div class="select">
            <div class="clear"></div>
            <div class="label">Từ</div>
            <div class="line">
                <input type="text" />
            </div>
           
            <div class="but_calen"></div>
            <div class="label">đến</div>
            <div class="line">
                <input type="text" />
            </div>
            <div class="but_calen"></div>
            <div class="clear"></div>
        </div>
        <a href="#" class="cancel"><strong>Hủy</strong></a>
        <a href="#" class="search"><strong>Tìm</strong></a>
        <div class="clear"></div>
    </div>
    <div class="newsletter">
    	<div class="box1"><div class="box2">
        	<div class="title"><strong>Đăng ký nhận bản tin events</strong></div>
            <div class="content">
            	<input type="text" />
                <a href="#" class="send">Gửi</a>
            	<div class="clear"></div>
            </div>
        </div></div>
    </div>
    <div class="clear"></div>
</div>