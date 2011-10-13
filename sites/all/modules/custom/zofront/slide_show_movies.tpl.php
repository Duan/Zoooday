<div class="back">
	<div class="bar-title">sự kiện khác</div>
    <div class="content-subpage">
    	<?php $i=1 ;foreach ($list as $key=>$value) {?>
    			<?php  $types = node_get_types();?>
				<div class="item">
			    	<?php echo l(theme_imagecache('90X90', $value->field_hinh_dai_dien[0]['filepath']),'node/'.$value->nid,array('html'=>true));?>
			        <div class="content">
			        	<p>
			        		<strong><?php echo l($value->title,'node/'.$value->nid,array('attributes' => array('class' => 'name'), 'html' => 'true'))?></strong>
			        	</p>
			            <div class="box">
			            	<div class="location"><?php  echo $types[$value->type]->name; ?></div>
			                <div class="time"><?php echo format_date($value->field_ngay_dien[0]['value'],'custom','h:iA, l d/m/Y');?></div>
			            </div>
			            <?php  echo $value->field_tom_tat[0]['value']; ?>
			        </div>
		    	</div>
		    	<?php if($i%2==0){?>
		    			 <div class="clear"></div>
		    	<?php }?>
		    	<?php $i++?>
    	<?php }?>
        <div class="clear"></div>
    </div>
</div>