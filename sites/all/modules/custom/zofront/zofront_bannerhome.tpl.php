<script type="text/javascript">
var ex_headline_count;
var ex_current_headline=0;

$(document).ready(function() {	

	//Click and Hover events for thumbnail list
	$(".image_thumb ul li:first").addClass('active'); 
	$(".image_thumb ul li").click(function(){ 
		var imgAlt = $(this).find('img').attr("alt"); //Get Alt Tag of Image
		var imgTitle = $(this).find('a').attr("href"); //Get Main Image URL
		var imgDesc = $(this).find('.block').html(); 	//Get HTML of block
		var imgSrc = $(this).find('img').attr("src"); 	//Get HTML of block
		
		if ($(this).is(".active")) {  //If it's already active, then...
			return false; // Don't click through
		} else {
			//Animate the Teaser				
			//$(".main_image .block .title").animate({ opacity: 0, marginBottom: -imgDescHeight }, 250 , function() {
				$(".main_image .block .title").html(imgAlt);
				$(".main_image img").attr({ src: imgSrc , alt: imgAlt});
			//});
		}
		$(".image_thumb ul li").removeClass('active hover'); //Remove class of 'active' on all lists
		$(".image_thumb ul li a").removeClass('active'); //Remove class of 'active' on all lists
		$(this).find('a').addClass('active');
		$(this).addClass('hover');  //add class of 'active' on this list only
		return false;
		
	}) .hover(function(){
		$(this).addClass('hover');
		}, function() {
		$(this).removeClass('hover');
	});


	ex_headline_count = $(".image_thumb li").size();
	ex_headline_interval = setInterval(ex_headline_rotate,5000);	
	
});//Close Function

function ex_headline_rotate() {
  ex_old_headline = ex_current_headline % ex_headline_count;
  ex_new_headline = ++ex_current_headline % ex_headline_count;
  ex_change_image(ex_new_headline,ex_old_headline);
}
	
function ex_change_image(eq_new,eq_old){
	
	 thisa = $('.image_thumb li:eq('+eq_new+')');
	 var imgAlt = thisa.find('img').attr("alt"); //Get Alt Tag of Image
	var imgTitle = thisa.find('a').attr("href"); //Get Main Image URL
	var imgDesc = thisa.find('.block').html(); 	//Get HTML of block
	var imgSrc = thisa.find('.hide_img img').attr("src"); 	//Get HTML of block
	var imgDescHeight = $(".main_image").find('.block').height();	//Calculate height of block	
	
	if ($(this).is(".active")) {  //If it's already active, then...
		return false; // Don't click through
	} else {
		//$(".main_image .block .title").animate({ opacity: 0, marginBottom: -imgDescHeight }, 250 , function() {
			$(".main_image .block .title").html(imgAlt).animate({ opacity: 0.85 }, 250 );
			
			$(".main_image img").attr({ src: imgSrc , alt: imgAlt});
			$(".main_image a").attr({ href: imgTitle});
		//});
	}
	$(".image_thumb ul li").removeClass('active hover'); //Remove class of 'active' on all lists
	
	$(".image_thumb ul li a").removeClass('active'); 
	thisa.addClass('hover');
	$('.image_thumb li:eq('+eq_new+') a').addClass('active');
	return false;
}


</script>
<div class="banner-home">
            <div class="top"></div>
            <div class="line">
            	<div class="left main_image">
            		<?php  foreach($list as $key=>$row){?>
            			 	<?php if($key==0){?>
            			 			<div class="bar desc">
				                    	<a class="name block" href="#">
				                    		<table>
				                                <tr>
				                                    <td align="left" valign="top" class="title">
				                                         <?php echo $row->title?>
				                                    </td>
				                                </tr>
				                            </table>
				                        </a>
				                    </div>
				                	<div class="shadow"></div>
				                	<?php echo theme_imagecache('700x324',$row->field_hinh_dai_dien[0]['filepath'],$row->title)?>
            			 	<?php }?>
            		<?php }?>
                </div>
                <div class="tab image_thumb">
                	<ul>
                		<?php foreach($list as $key=>$row){?>
                				<li>
		                			<a class="thum active" href="<?php echo $row->field_link[0]['value']?>">
				                        <div class="each">
				                            <div class="bor">
				                                <div class="bor">
				                                    <div class="overlay"></div>
				                               		<div class="hide_img" style="display:none">
				                               			<?php echo theme_imagecache('700x324',$row->field_hinh_dai_dien[0]['filepath'],$row->title)?>
				                               		</div>
				                                    <?php echo theme_imagecache('60x60',$row->field_hinh_dai_dien[0]['filepath'],$row->title)?>
				                                </div>
				                            </div>
				                            <table>
				                                <tr>
				                                    <td>
				                                         <?php echo $row->title?>
				                                    </td>
				                                </tr>
				                            </table>
				                        </div>
				                    </a>
		                		</li>
                		<?php }?>
                	</ul>
                                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="bot"></div>
        </div>