<div class="bar-title">phim</div>

<div id="featured-film">
	<a id="prev" href="#">Next</a>
	<ul id="myRoundabout">
	<?php 
foreach ($list as $value) {
	?>
	
	<li>
	<?php 
//	echo $value->title;
//	echo $value->field_dien_vien[0]['value'];
	//echo $value->field_thoi_luong[0]['value'];
	echo theme_imagecache('398X271', $value->field_hinh_dai_dien[0]['filepath']);
	?>
	</li>
	<?php 
}

?>
	   

	</ul> 
	<a id="next" href="#">Prev</a>
</div>
<script>
 $(document).ready(function() {
      $('ul#myRoundabout').roundabout({
         btnNext: '#next',
         btnPrev: '#prev',
         minOpacity: 0.7, // invisible!
         minScale: 0.7, // tiny!
         maxScale: 1
      });
   });
</script>
