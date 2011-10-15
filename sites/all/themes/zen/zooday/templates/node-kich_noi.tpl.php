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
			<a class="play1">
				<div class="play1_l"></div>
				<div class="play1_c">xem trích đoạn</div>
				<div class="play1_r kich_detail"></div>
			</a>
		</div>
		<?php echo theme_imagecache('600x286', $node->field_hinh_dai_dien[0]['filepath'])?>
		<div class="bot">
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td width="72" valign="top">
						<span style="color: #ff7a00; font-weight: bold;">Thể loại:</span>
					</td>
					<td valign="top">
						Hài kịch
					</td>
				</tr>
				<tr>
					<td valign="top">
						<span style="color: #ff7a00; font-weight: bold;">Tác giả:</span>
					</td>
					<td valign="top">
						<?php echo $node->field_tac_gia[0]['value'];?>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<span style="color: #ff7a00; font-weight: bold;">Đạo diễn:</span>
					</td>
					<td valign="top">
						<?php echo $node->field_dao_dien[0]['value'];?>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<span style="color: #ff7a00; font-weight: bold;">Diễn viên:</span>
					</td>
					<td valign="top">
						<?php echo $node->field_dien_vien[0]['value'];?>
					</td>
				</tr>
			</table>
			<?php echo $node->field_tom_tat[0]['value']?>
		</div>
    </div>
</div>
<div class="clear"></div>
<div class="back back_screen_detail">
	<div class="white" style="padding-bottom:20px;">
		<div class="bar-title">xuất diễn</div>
		<div class="other-screenplay-content">
			<?php foreach ($node->field_xuat_dien_kich['data'] as $value) {?>
					<div class="wrapclear">
	                    <div class="other-screenplay">
	                        <strong>Thứ <?php echo $value[0]?> ngày <?php echo $value[1]?>:</strong> <?php echo $value[2]?>
	                    </div>
	                </div>
			<?php }?>
		</div>
	</div>
</div>
<div class="clear"></div>
<?php 
//dang trinh dien
	$today = getdate();
	
	$dayset = $today['year'].'-'.$today['mon'].'-'.$today['mday'];
	$resultdangchieu = db_query('SELECT node.nid AS nid,node.title AS node_title,node.created AS node_created FROM node node LEFT JOIN content_field_ngay_dien node_data_field_ngay_dien ON node.vid = node_data_field_ngay_dien.vid WHERE (DATE_FORMAT(ADDTIME(FROM_UNIXTIME(node_data_field_ngay_dien.field_ngay_dien_value), SEC_TO_TIME(25200)), "%%Y-%%m-%%d") <= "%s") AND (node.type in ("kich_noi")) AND (node.nid != %d) ORDER BY node_created DESC',$dayset,$node->nid);
    while ($rowcs = db_fetch_object($resultdangchieu)) {
		$nodedangchieu = node_load($rowcs->nid);
		$listdangchieu[] = $nodedangchieu;
	}
   	echo theme('show_trinhchieu',$listdangchieu,'ĐANG DIỄN');
   	
   	$resultsapchieu = db_query('SELECT node.nid AS nid,node.title AS node_title,node.created AS node_created FROM node node LEFT JOIN content_field_ngay_dien node_data_field_ngay_dien ON node.vid = node_data_field_ngay_dien.vid WHERE (DATE_FORMAT(ADDTIME(FROM_UNIXTIME(node_data_field_ngay_dien.field_ngay_dien_value), SEC_TO_TIME(25200)), "%%Y-%%m-%%d") > "%s") AND (node.type in ("kich_noi")) AND (node.nid != %d) ORDER BY node_created DESC',$dayset,$node->nid);
    while ($rowss = db_fetch_object($resultsapchieu)) {
		$nodesapchieu = node_load($rowss->nid);
		$listsapchieu[] = $nodesapchieu;
	}
   	echo theme('show_trinhchieu',$listsapchieu,'SẮP DIỄN');
//View gmap

   	

?>