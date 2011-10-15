<div class="back">
	<div class="bar-title">megastar</div>
    <div class="film-theater">
        <div class="date">
            <div class="wrapclear">
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
           		$weekconvertvn[] = 'Thứ 2';
           	}
            if ($value == 'Tuesday'){
           		$weekconvertvn[] = 'Thứ 3';
           	}
            if ($value == 'Wednesday'){
           		$weekconvertvn[] = 'Thứ 4';
           	}
            if ($value == 'Thursday'){
           		$weekconvertvn[] = 'Thứ 5';
           	}
            if ($value == 'Friday'){
           		$weekconvertvn[] = 'Thứ 6';
           	}
            if ($value == 'Saturday'){
           		$weekconvertvn[] = 'Thứ 7';
           	}
            if ($value == 'Sunday'){
           		$weekconvertvn[] = 'Chủ nhật';
           	}
   		
           }
 
            ?>
           
            	<a href="#" class="datepicker">
                        <p><?php echo $weekconvertvn[6]?></p><?php echo $weekdayss[6]?>
                </a>
                <a href="#" class="datepicker">
                   <p><?php echo $weekconvertvn[5]?></p><?php echo $weekdayss[5]?>
                </a>
                <a href="#" class="datepicker">
                   <p><?php echo $weekconvertvn[4]?></p><?php echo $weekdayss[4]?>
                </a>
                <a href="#" class="datepicker">
                    <p><?php echo $weekconvertvn[3]?></p><?php echo $weekdayss[3]?>
                </a>
                <a href="#" class="datepicker">
                   <p><?php echo $weekconvertvn[2]?></p><?php echo $weekdayss[2]?>
                </a>
                <a href="#" class="datepicker">
                   <p><?php echo $weekconvertvn[1]?></p><?php echo $weekdayss[1]?>
                </a>
                <a href="#" class="datepicker active">
                   <p><?php echo $weekconvertvn[0]?></p><?php echo $weekdayss[0]?>
                </a>
            </div>
        </div>
         <?php   foreach ($list as $value) {
         foreach ($value->taxonomy as $value6) {
	//2D 3D
	$getparent[] = taxonomy_get_parents_all($value6->tid);
	//H
}

         	?>
             	<div class="item-theater">
        	<div class="wrapclear">
        		<?php echo l(theme_imagecache('90X90', $value->field_hinh_dai_dien[0]['filepath']),'node/'.$value->nid,array('html'=>true));?>
                <div class="content">
                	<p class="name"><a href="#">Madagascar</a></p>
                    <div class="star-big" style="background-position:0 -17px;"></div>
                    
                    <?php $getclientparent = db_query('SELECT * FROM term_hierarchy WHERE parent = %d',arg(2));?>
                    <?php while ($rowclinet = db_fetch_object($getclientparent)) {
                     $term3d2d = taxonomy_get_term($rowclinet->tid);
                    	?>
                     <div class="line2">
                    	<div class="kind"><strong><?php echo $term3d2d->name;?> </strong></span></div>
                    </div>
                    <div class="showtime2">
                      <?php foreach ($getparent as $value2) {?>
													<?php if ($value2[2]->tid == arg(2)) {?>
															  <?php if ($value2[1]->tid == $term3d2d->tid){
														
															  	?>
														
															  					<?php echo $value2[0]->name.' ';?>
															  			<span>|</span>
															  <?php }?>
													<?php }?>
											<?php }?>
                   
                    
                    </div>
                    <?php 
                 
                    }
                    ?>
                   
                  
                </div>
            </div>
        </div>
         <?php
           unset($getparent); 
         }
         ?>


    </div>
</div>