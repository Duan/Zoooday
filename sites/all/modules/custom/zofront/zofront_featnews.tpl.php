 <div class="bar-title">sự kiện mới</div>
                <div id="featured-new">               
                <?php         
                foreach ($list as $value) {
                	
                	?>
                	 <div class="item">
                    	<?php echo l(theme_imagecache('90X90', $value->field_hinh_dai_dien[0]['filepath']),'node/'.$value->nid,array('html'=>true));?>
                        <div class="content">
                        	<p><?php echo l('<strong>'.$value->title.'</strong>','node/'.$value->nid,array('html'=>true,'attributes' => array('class' => 'name'))); ?></p>
                            <div class="box">
                            	<div class="location"><?php $types = node_get_types(); echo $types[$value->type]->name;?></div>
                                <div class="time"><?php echo format_date($value->field_ngay_dien[0]['value'],'custom','h:iA, l d/m/Y');?></div>
                            </div>
                            <?php echo $value->field_tom_tat[0]['value'];?>
                        </div>
                    </div>
                	<?php
                    	
                }
                ?>                	
                    <div class="clear"></div>
                    <?php echo l('Xem tất cả', 'user/', array('attributes' => array('class' => 'more')));?>                
                </div>