<script type="text/javascript">
var ex_headline_count_music;
var ex_current_headline_music=1;

$(document).ready(function() {	

	//Click and Hover events for thumbnail list
	//$(".slide ul li:first").addClass('active'); 
	$(".slide ul li:first").find('.mask').hide();
	$(".slide ul li:first").addClass('hover'); 
	$(".slide ul li").click(function(){ 
		var imgAlt = $(this).find('img').attr("alt"); //Get Alt Tag of Image
		var imgTitle = $(this).find('a').attr("href"); //Get Main Image URL
		var imgDesc = $(this).find('.block').html(); 	//Get HTML of block
		var imgSrc = $(this).find('.hide_img').html(); 	//Get HTML of block

		var info =  $(this).find('.hide_info').html();
		var location =  $(this).find('.hide_location').html();

		if ($(this).is(".hover")) {  //If it's already active, then...
			return false; // Don't click through
		} else {
			$(".banner .description .name").html(imgAlt);
			$(".banner .description .info").html(info);
			$(".banner .right").html(location);
			$(".banner .main_content").html(imgSrc);
		}
		$(".slide ul li").removeClass('hover'); //Remove class of 'active' on all lists
		$(".slide ul").find('.mask').show();
		//$(".slide ul li a").removeClass('active'); //Remove class of 'active' on all lists
		$(this).find('.mask').hide();
		$(this).addClass('hover');  //add class of 'active' on this list only
		return false;
		
	});


	ex_headline_count_music = $(".slide li").size();
	ex_current_headline_music = setInterval(ex_headline_rotate_music,5000);	
	
});//Close Function

function ex_headline_rotate_music() {
  ex_old_headline = ex_current_headline_music % ex_headline_count_music;
  ex_new_headline = ++ex_current_headline_music % ex_headline_count_music;
  ex_change_image_music(ex_new_headline,ex_old_headline);
}
	
function ex_change_image_music(eq_new,eq_old){
	thisa = $('.slide li:eq('+eq_new+')');
	
	var imgAlt = thisa.find('img').attr("alt"); //Get Alt Tag of Image
	var imgTitle = thisa.find('a').attr("href"); //Get Main Image URL
	var imgDesc = thisa.find('.block').html(); 	//Get HTML of block
	var imgSrc = thisa.find('.hide_img').html(); 	//Get HTML of block
	var info =  thisa.find('.hide_info').html();
	var location =  thisa.find('.hide_location').html();
	
	if ($(this).is(".hover")) {  //If it's already active, then...
		return false; // Don't click through
	} else {
			$(".banner .description .name").html(imgAlt);
			$(".banner .description .info").html(info);
			$(".banner .right").html(location);
			$(".banner .main_content").html(imgSrc);
	}
	$(".slide ul li").removeClass('hover'); //Remove class of 'active' on all lists
	$(".slide ul").find('.mask').show();
	thisa.find('.mask').hide();
	thisa.addClass('hover');
	$('.slide li:eq('+eq_new+') a').addClass('active');
	
	return false;
}
</script>
<div class="music">
	<div class="banner">
		<?php foreach($list as $key=>$row){?>
				 <?php if($key == 0){?>
				 		
				        <span class="main_content"><?php echo l(theme_imagecache('600x286',$row->field_hinh_dai_dien[0]['filepath'],$row->title),'node/'.$row->nid,array('attributes' => array('class' => 'main_img'),'html'=>TRUE))?></span>
				        <div class="description">
				        	<div class="left">
				            	<p class="name"><?php echo $row->title ?></p>
				                <p class="info"><?php echo format_date($value->field_ngay_dien[0]['value'],'custom','h:iA, l d/m/Y');?></p>
				            </div>
				            <div class="right"><?php $types = node_get_types(); echo $types[$value->type]->name;?></div>
				        </div>		
				 <?php break;}?>
		<?php }?>
    </div>
    <div class="slide">
    	<div class="wrapclear">
    		<ul>
    			<?php foreach($list as $key=>$row){?>
    					<li>
		    				<a href="#">
				                <div class="thum">
				                  
				                   <?php echo theme_imagecache('147x56',$row->field_hinh_dai_dien[0]['filepath'],$row->title)?>
				                    <div class="hide_img">
				                    	<?php echo l(theme_imagecache('600x286',$row->field_hinh_dai_dien[0]['filepath'],$row->title),'node/'.$row->nid,array('attributes' => array('class' => 'main_img'),'html'=>TRUE))?>
				                   	</div>
				                   	<p class="hide_info"><?php echo format_date($value->field_ngay_dien[0]['value'],'custom','h:iA, l d/m/Y');?></p>
				                   	<p class="hide_location"><?php $types = node_get_types(); echo $types[$value->type]->name;?></p>
				                    <div class="mask">
				                    	<table width="147" height="56">
				                        	<tr>
				                            	<td align="center" valign="middle">
				                                	<?php echo $row->title?>
				                                </td>
				                            </tr>
				                        </table>
				                    </div>
				                </div>
				            </a>
		    			</li>	
    			<?php }?>
    		</ul>
        </div>
    </div>
</div>
<div class="clear"></div>
                