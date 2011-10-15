<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<div class="music">
	<div class="banner">
    	<div class="top">
        	<div class="wrapclear">
            	<div class="boxday">
                	<div class="date">thứ 3</div>
                    <div class="num">20</div>
                </div>
                <div class="info">
                	<p class="name"><?php echo $node->title?></p>
                    <span class="loca"><?php echo format_date($node->field_ngay_dien[0]['value'],'custom','h:iA, l d/m/Y');?>, <?php $types = node_get_types(); echo $types[$value->type]->name;?></span> <a href="#" class="map">(bản đồ)</a>
                    <p class="post-on">Posted on Wed, March 9th, 2011</p>
                </div>
            </div>
        </div>
        <?php echo theme_imagecache('600x286',$node->field_hinh_dai_dien[0]['filepath'],$node->title)?>
        <div class="bot">
        <?php echo $node->field_tom_tat[0]['value']?><br />
        <?php echo $node->field_dien_vien [0]['value']?><br />
         <?php echo $node->field_gia_ve[0]['value']?>
        </div>
    </div>
    
    <div class="social">
    	<div class="wrapclear">
        	<a href="#">
                <div class="right-social"></div>
                <div class="mid-social">Nhắc nhở</div>
                <div class="left-remind"></div>
            </a>
            <a href="#">
                <div class="right-social"></div>
                <div class="mid-social">Gửi cho bạn bè</div>
                <div class="left-email"></div>
            </a>
            <a href="#">
                <div class="right-social"></div>
                <div class="mid-social">Chia sẻ</div>
                <div class="left-share"></div>
            </a>
        </div>
    </div>
</div>
<div class="clear"></div>
<?php
$result = db_query('SELECT node.nid AS nid, node.title AS node_title, node_data_field_ngay_dien.field_ngay_dien_value AS node_data_field_ngay_dien_field_ngay_dien_value, node.type AS node_type, node.vid AS node_vid, node.created AS node_created FROM node node  LEFT JOIN content_field_ngay_dien node_data_field_ngay_dien ON node.vid = node_data_field_ngay_dien.vid WHERE (node.nid != %d) AND (node.type in ("su_kien_khac")) ORDER BY node_created DESC',$node->nid);

?>
<div class="back music_detail">
	<div class="white">
        <div class="bar-title">các chương trình khác</div>
        <div class="content-subpage">
        	<div class="other-music">
        		<?php while ($rows = db_fetch_object($result)) {?>
			            	<div class=" wrapclear">
			                   <div class="left">
			                   		<strong><?php echo l($rows->node_title,'node/'.$rows->nid)?></strong>
			                   	</div>
			                    <div class="right"><?php echo format_date($rows->node_data_field_ngay_dien_field_ngay_dien_value,'custom','h:iA, l d/m/Y');?></div>
			                </div>
			                 <div class="dotted"></div>        			
        		<?php }?>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
<div class="music">
	<div id="map" class="map">

    </div>
    <div class="icon-location">
    	<strong>Sân khấu kịch Idecaf</strong><br />100, 3 Tháng 2, Quận 10, Tp. Hồ Chí Minh
    </div>
</div>
<script>
$(document).ready(function(){
// Creating an object literal containing the properties 
    // we want to pass to the map  
    var options = {
      zoom: 12,
      center: new google.maps.LatLng(40.7257, -74.0047),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
	  streetViewControl: false ,
	   navigationControl: true, 
	  navigationControlOptions: { 
		style: google.maps.NavigationControlStyle.SMALL 
	  } 
    };

    // Creating the map  
    var map = new google.maps.Map(document.getElementById('map'), options);
    
    // Adding a marker to the map
    var marker = new google.maps.Marker({
      position: new google.maps.LatLng(40.7257, -74.0047),
      map: map,
      title: 'Click me',
      icon: 'http://gmaps-samples.googlecode.com/svn/trunk/markers/blue/blank.png'
    });
	
})
</script>
