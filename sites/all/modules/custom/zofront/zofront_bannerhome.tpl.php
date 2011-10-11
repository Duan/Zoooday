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
	var imgSrc = thisa.find('img').attr("src"); 	//Get HTML of block
	var imgDescHeight = $(".main_image").find('.block').height();	//Calculate height of block	
	
	if ($(this).is(".active")) {  //If it's already active, then...
		return false; // Don't click through
	} else {
		//$(".main_image .block .title").animate({ opacity: 0, marginBottom: -imgDescHeight }, 250 , function() {
			$(".main_image .block .title").html(imgAlt).animate({ opacity: 0.85 }, 250 );
			
			$(".main_image img").attr({ src: imgSrc , alt: imgAlt});
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
                    <div class="bar desc">
                    	<a class="name block" href="#">
                    		<table>
                                <tr>
                                    <td align="left" valign="top" class="title">
                                        Tangle
                                    </td>
                                </tr>
                            </table>
                        </a>
                    </div>
                	<div class="shadow"></div>
                	<img src="http://localhost/Zoooday/sites/all/themes/zen/zooday/images/images.jpg" width="700" height="324"/>
                </div>
                <div class="tab image_thumb">
                	<ul>
                		<li>
                			<a class="thum active" href="http://yahoo.com">
		                        <div class="each">
		                            <div class="bor">
		                                <div class="bor">
		                                    <div class="overlay"></div>
		                                    <img src="http://localhost/Zoooday/sites/all/themes/zen/zooday/images/images.jpg" width="60" height="60" alt="test" />
		                                </div>
		                            </div>
		                            <table>
		                                <tr>
		                                    <td>
		                                        How to train a dragon
		                                    </td>
		                                </tr>
		                            </table>
		                        </div>
		                    </a>
                		</li>
                		<li>
                			 <a class="thum" href="#">
		                        <div class="each">
		                            <div class="bor">
		                                <div class="bor">
		                                	<div class="overlay"></div>
		                                    <img src="http://localhost/Zoooday/sites/all/themes/zen/zooday/images/images1.jpg" width="60" height="60" alt="test2" />
		                                </div>
		                            </div>
		                            <table>
		                                <tr>
		                                    <td>
		                                        How to train a dragon
		                                    </td>
		                                </tr>
		                            </table>
		                        </div>
		                    </a>
                		</li>
                		<li>
                			 <a class="thum" href="#">
		                        <div class="each">
		                            <div class="bor">
		                                <div class="bor">
		                                	<div class="overlay"></div>
		                                    <img src="http://localhost/Zoooday/sites/all/themes/zen/zooday/images/images.jpg" width="60" height="60" alt="test3"/>
		                                </div>
		                            </div>
		                            <table>
		                                <tr>
		                                    <td>
		                                        How to train a dragon
		                                    </td>
		                                </tr>
		                            </table>
		                        </div>
		                    </a>
                		</li>
                		<li>
                			 <a class="thum" href="#">
		                        <div class="each">
		                            <div class="bor">
		                                <div class="bor">
		                                	<div class="overlay"></div>
		                                    <img src="http://localhost/Zoooday/sites/all/themes/zen/zooday/images/images1.jpg" width="60" height="60" alt="test4"/>
		                                </div>
		                            </div>
		                            <table>
		                                <tr>
		                                    <td>
		                                        How to train a dragon
		                                    </td>
		                                </tr>
		                            </table>
		                        </div>
		                    </a>
                		</li>
                	</ul>
                                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="bot"></div>
        </div>