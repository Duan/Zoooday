<div class="film">
	<div class="banner">
		<div class="top1">
			<div class="name-date">
				<div class="name">
					<?php echo $node->title?>
				</div>
				<div class="date">
					<?php echo format_date($node->created,'custom','h:iA, l d/m/Y');?>
				</div>
			</div>
			<div class="star-big" style="background-position:0 -17px;"></div>
		</div>
    	<a href="#" style="display: block;">
        	<?php echo theme_imagecache('600x286', $node->field_hinh_dai_dien[0]['filepath'])?>
        </a>
        <div class="description v3">
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td width="72">
						Thời lượng:
					</td>
					<td class="color">
						120 phút
					</td>
				</tr>
				<tr>
					<td>
						Thể loại:
					</td>
					<td class="color">
						Comedy
					</td>
				</tr>
			</table>
			<p class="inf">
				Journalist Mikael Blomkvist (Craig) is aided in his search for a woman who has bee
			 </p>
			

			<table cellpadding="0" cellspacing="0">
				<tr>
					<td width="72">
						Đạo diễn:
					</td>
					<td class="color">
						<?php echo $node->field_dao_dien[0]['value'];?>
					</td>
				</tr>
				<tr>
					<td>
						Diễn viên:
					</td>
					<td class="color">
						<?php echo $node->field_dien_vien[0]['value'];?>
					</td>
				</tr>
			</table>
			<a class="play1">
				<div class="play1_l"></div>
				<div class="play1_c">xem trailer</div>
				<div class="play1_r play_r_file"></div>
			</a>
        </div>
    </div>
    <div class="social v2">
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
//dpm(taxonomy_node_get_terms($node));
foreach ($node->taxonomy as $value) {
	//2D 3D
	$getparent[] = taxonomy_get_parents_all($value->tid);
	//H
}
$rapchieu = taxonomy_get_tree(2,0,-1,1);
?>

<div class="back" style="float: left;margin: 10px 0 0;width: 100%">
	<div class="white" style="padding-bottom:20px;">
        <div class="bar-title">xuất chiếu</div>
        <div class="showtime3">
        	<div class="other-film">
				<div class="each">
					<?php foreach ($rapchieu as $value) {?>
							<?php $ojectnow = new stdClass();?>
							<div class="name">
								<?php echo $value->name ?>
							</div>
							<div class="info">
								<div class="location">
									Tầng 7 - Hùng Vương Plaza, 126 Hùng Vương, Quận 5, Tp. Hồ Chí Minh
								</div>
								<div class="tel">
									(84-8) 2 2220 388
								</div>
							</div>
							<?php $getclientparent = db_query('SELECT * FROM term_hierarchy WHERE parent = %d',$value->tid);?>
							<?php while ($rowclinet = db_fetch_object($getclientparent)) {?>
									<?php $term3d2d = taxonomy_get_term($rowclinet->tid);?>
									<div class="time">
										<div class="type">
											<?php echo $term3d2d->name;?>
										</div>
										<div class="detail">
											<?php foreach ($getparent as $value2) {?>
													<?php if ($value2[2]->tid == $value->tid) {?>
															  <?php if ($value2[1]->tid == $term3d2d->tid){?>
															  			<span class="detail_each first">
															  					<?php echo $value2[0]->name.' ';?>
															  			</span>
															  <?php }?>
													<?php }?>
											<?php }?>
										</div>
									</div>
							<?php }?>
					<?php }?>
				</div>
			</div>
        </div>
    </div>
</div>
<div class="clear"></div>		
<?php 
	//dang chieu
	$today = getdate();
	
	$dayset = $today['year'].'-'.$today['mon'].'-'.$today['mday'];
	$resultdangchieu = db_query('SELECT node.nid AS nid,node.title AS node_title,node.created AS node_created FROM node node LEFT JOIN content_field_ngay_dien node_data_field_ngay_dien ON node.vid = node_data_field_ngay_dien.vid WHERE (DATE_FORMAT(ADDTIME(FROM_UNIXTIME(node_data_field_ngay_dien.field_ngay_dien_value), SEC_TO_TIME(25200)), "%%Y-%%m-%%d") <= "%s") AND (node.type in ("movies")) AND (node.nid != %d) ORDER BY node_created DESC',$dayset,$node->nid);
    while ($rowcs = db_fetch_object($resultdangchieu)) {
		$nodedangchieu = node_load($rowcs->nid);
		$listdangchieu[] = $nodedangchieu;
	}
    echo theme('show_trinhchieu',$listdangchieu,'ĐANG CHIẾU');
   	
   	$resultsapchieu = db_query('SELECT node.nid AS nid,node.title AS node_title,node.created AS node_created FROM node node LEFT JOIN content_field_ngay_dien node_data_field_ngay_dien ON node.vid = node_data_field_ngay_dien.vid WHERE (DATE_FORMAT(ADDTIME(FROM_UNIXTIME(node_data_field_ngay_dien.field_ngay_dien_value), SEC_TO_TIME(25200)), "%%Y-%%m-%%d") > "%s") AND (node.type in ("movies")) AND (node.nid != %d) ORDER BY node_created DESC',$dayset,$node->nid);
    while ($rowss = db_fetch_object($resultsapchieu)) {
		$nodesapchieu = node_load($rowss->nid);
		$listsapchieu[] = $nodesapchieu;
	}
   	echo theme('show_trinhchieu',$listsapchieu,'SẮP CHIẾU');
?>