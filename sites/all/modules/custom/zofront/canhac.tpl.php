<div class="back">
	<div class="bar-title"><?php echo $type;?></div>
    <div class="music-theater">
    <?php   foreach ($list as $value) {?>
    
  
    	<div class="item-theater">
        	<div class="wrapclear">
        		<?php echo l(theme_imagecache('90X90', $value->field_hinh_dai_dien[0]['filepath']),'node/'.$value->nid,array('html'=>true));?>
                <div class="content">
                <?php echo l('<p class="name">'.$value->title.'</p>','node/'.$value->nid,array('html'=>true)); ?>
                	<strong>Ca sĩ:</strong> <?php echo $value->field_dien_vien [0]['value']?>
                    <div class="line"></div>
                    <div class="showtime"><?php echo format_date($value->field_ngay_dien[0]['value'],'custom','h:i A | d-m-Y');?></div>
                </div>
            </div>
        </div>
  <?php }?>
    </div>
</div>