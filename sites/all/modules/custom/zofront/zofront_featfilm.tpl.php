<div class="bar-title">phim</div>

<div id="featured-film">
	<a id="prev" href="#"></a>
	<ul id="myRoundabout">
	<?php 
foreach ($list as $value) {
	     $node = node_load($value->nid);
     node_invoke_nodeapi($node, 'view');
	?>
	
	<li>
	<?php 
//	echo $value->title;
//	echo $value->field_dien_vien[0]['value'];
	//echo $value->field_thoi_luong[0]['value'];
	echo theme_imagecache('398X271', $value->field_hinh_dai_dien[0]['filepath']);
	?>
	<div class="description" style="display: none">
    	<div class="left">
        	<p class="name"><strong>How to train a dragon</strong></p>
            <p class="info"><span style="color:#fff">Diễn viên:</span> Jolie, July<br /><span style="color:#fff">Thời lượng:</span> 120 phút</p>
        </div>
        <div class="right">
        	<div class="star"><?php echo $node->rate_rate['#value'];?></div>
            <?php echo l('<div class="play"></div>','node/'.$value->nid,array('html'=>TRUE));?>
        </div>
    </div>
	</li>
	<?php 
}

?>
	   

	</ul> 
	<a id="next" href="#"></a>
</div>
<script>
 $(document).ready(function() {
 	var interval;
 	//startAutoPlay()
      $('ul#myRoundabout').roundabout({
         btnNext: '#next',
         btnPrev: '#prev',
         minOpacity: 0.7, // invisible!
         minScale: 1, // tiny!
         maxScale: 1
      }).hover(
			function() {
				// oh no, it's the cops!
				//clearInterval(interval);
			},
			function() {
				// false alarm: PARTY!
			//	interval = startAutoPlay();
			}
		);
   });
   
   function startAutoPlay() {
		return setInterval(function() {
			$('ul#myRoundabout').roundabout_animateToNextChild();
		}, 5000);
	}
</script>
