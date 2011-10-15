  <div class="box-right">
	<div class="top"><div class="left"><div class="right">
    	<strong>PHIM</strong>
    </div></div></div>
    <div class="content" style="height:200px;">
    <?php 
    foreach ($list as $value) {
    	?>
    	 <div class="item-sma">
           <p><?php echo l('<strong>'.$value->title.'</strong>','node/'.$value->nid,array('html'=>true,'attributes' => array('class' => 'name'))); ?></p>
            <div class="info">
                <div class="location"><?php $types = node_get_types(); echo $types[$value->type]->name;?></div>
                <div class="time"><?php echo format_date($value->field_ngay_dien[0]['value'],'custom','h:iA, l d/m/Y');?></div>
            </div>
        </div>
         <div class="dotted"></div>
    	<?php 

    }
    
    ?>
       
       
      
    </div>
    <div class="bottom"><div class="left"><div class="right">
    	<?php echo l('xem tất cả','movies',array('attributes' => array('class' => 'more')));?>
    </div></div></div>
</div>