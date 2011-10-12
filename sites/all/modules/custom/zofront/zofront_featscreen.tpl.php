<script>
$(document).ready(function(){
	$("#amazon_scroller2").amazon_scroller({
                    scroller_title_show: 'enable',
                    scroller_time_interval: '3000',
                    scroller_window_background_color: "none",
                    scroller_window_padding: '10',
                    scroller_images_width: '170',
                    scroller_images_height: '272',
                    scroller_show_count: '3',
                    directory: 'images'
        });
})
</script>
<div class="bar-title">kịch</div>
<div id="featured-screenplay">
	
     <div id="amazon_scroller2" class="amazon_scroller">
           <div class="amazon_scroller_mask">
               <ul>
                   <?php 
                   foreach ($list as $value){
                   ?>
                   <li>
						<?php 
                   		   echo l(theme_imagecache('276X170', $value->field_hinh_dai_dien[0]['filepath']),'node/'.$value->nid,array('html'=>TRUE));
                   		?>
                   			<div class="bot_bottom">
               					<div class="title">
		                   				<?php echo l($value->title,'node/'.$value->nid);?>
	                   			</div>
 								<div class="place">
 								<?php
									foreach ($value->taxonomy as $value) {
										echo $value->name;
									}
 								?>
		                   				
	                   			</div>
                   			</div>
                   			
                   
                   	</li>
                <?php }?>
               </ul>
           </div>
           <ul class="amazon_scroller_nav">
               <li class="left"></li>
               <li class="right"></li>
           </ul>
           <div style="clear: both"></div>
    </div>
    
</div>
