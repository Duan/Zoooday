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

		var location =  $(this).find('.hide_location').html();
		var author =  $(this).find('.hide_author').html();
		var director =  $(this).find('.hide_director').html();
		var actor =  $(this).find('.hide_actor').html();
		var intro =  $(this).find('.hide_intro').html();

		if ($(this).is(".hover")) {  //If it's already active, then...
			return false; // Don't click through
		} else {
			$(".banner .description .name").html(imgAlt);
			$(".banner .stage").html(location);
			$(".banner .main_content").html(imgSrc);
			
			$(".banner .author").html(author);
			$(".banner .director").html(director);
			$(".banner .actor").html(actor);

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

	var location =  thisa.find('.hide_location').html();
	var author =  thisa.find('.hide_author').html();
	var director =  thisa.find('.hide_director').html();
	var actor =  thisa.find('.hide_actor').html();
	var intro = thisa.find('.hide_intro').html();
	
	if ($(this).is(".hover")) {  //If it's already active, then...
		return false; // Don't click through
	} else {
			$(".banner .description .name").html(imgAlt);
			$(".banner .main_content").html(imgSrc);
			
			$(".banner .stage").html(location);
			$(".banner .author").html(author);
			$(".banner .director").html(director);
			$(".banner .actor").html(actor);
	}
	$(".slide ul li").removeClass('hover'); //Remove class of 'active' on all lists
	$(".slide ul").find('.mask').show();
	thisa.find('.mask').hide();
	thisa.addClass('hover');
	$('.slide li:eq('+eq_new+') a').addClass('active');
	
	return false;
}
</script>

<div class="film">
	<div class="banner">
		<?php foreach($list as $key=>$row){?>
				 <?php if($key == 0){?>
				 		
				        <span class="main_content"><?php echo l(theme_imagecache('600x286',$row->field_hinh_dai_dien[0]['filepath'],$row->title),'node/'.$row->nid,array('attributes' => array('class' => 'main_img'),'html'=>TRUE))?></span>
				          <div class="description v2">
                        	<p class="name"><strong><?php echo $row->title?></strong></p>
							<p class="stage">
								<?php $types = node_get_types(); echo $types[$value->type]->name;?>
							</p>
							<table class="info2" cellspacing="0" cellpadding="0">
								<tr>
									<td width="72" valign="top">
										<strong>Thể loại:</strong>
									</td>
									<td class="type">
										Hài kịch
									</td>
								</tr>
								<tr>
									<td valign="top">
										<strong>Tác giả:</strong>
									</td>
									<td class="author">
										<?php echo $row->field_tac_gia[0]['value'];?>
									</td>
								</tr>
								<tr>
									<td valign="top">
										<strong>Đạo diễn:</strong>
									</td>
									<td class="director">
										<?php echo $row->field_dao_dien[0]['value'];?>
									</td>
								</tr>
								<tr>
									<td valign="top">
										<strong>Diễn viên:</strong>
									</td>
									<td class="actor">
										<?php echo $row->field_dien_vien[0]['value'];?>
									</td>
								</tr>
							</table>
							<a class="play1">
								<div class="play1_l"></div>
								<div class="play1_c"><?php echo l('xem trích đoạn','node/'.$row->nid);?></div>
								<div class="play1_r"></div>
							</a>
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
				                   	
				                   	<p class="hide_author">
				                   		<?php echo $row->field_tac_gia[0]['value'];?>
				                   	</p>
				                   	<p class="hide_director">
				                   		<?php echo $row->field_dao_dien[0]['value'];?>
				                   	</p>
				                   	 <p class="hide_time">
				                   		<?php echo format_date($value->field_ngay_dien[0]['value'],'custom','h:iA, l d/m/Y');?>
				                   	</p>
				                   	<p class="hide_actor">
				                   		<?php echo $row->field_dien_vien[0]['value'];?>
				                   	</p>
				                    <p class="hide_intro">
				                   		<?php echo $row->field_tom_tat[0]['value'];?>
				                   	</p>
				                   	<p class="hide_location">
				                   		<?php $types = node_get_types(); echo $types[$value->type]->name;?>
				                   	</p>
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
                