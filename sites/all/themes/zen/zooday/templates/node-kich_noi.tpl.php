<?php 

//noi dung
dpm($node);

//get xuat dien
foreach ($node->field_xuat_dien_kich['data'] as $value) {
	if ($value[0] != 0 && $value[1] != 0 && $value[2] != 0) {
		echo 'Thứ '.$value[0].' Ngày '.$value[1].': '.$value[2].'<br>';
	}
}

//dang trinh dien
	$today = getdate();
	
	$dayset = $today['year'].'-'.$today['mon'].'-'.$today['mday'];
	$resultdangchieu = db_query('SELECT node.nid AS nid,node.title AS node_title,node.created AS node_created FROM node node LEFT JOIN content_field_ngay_dien node_data_field_ngay_dien ON node.vid = node_data_field_ngay_dien.vid WHERE (DATE_FORMAT(ADDTIME(FROM_UNIXTIME(node_data_field_ngay_dien.field_ngay_dien_value), SEC_TO_TIME(25200)), "%%Y-%%m-%%d") <= "%s") AND (node.type in ("kich_noi")) AND (node.nid != %d) ORDER BY node_created DESC',$dayset,$node->nid);
    while ($rowcs = db_fetch_object($resultdangchieu)) {
		$nodedangchieu = node_load($rowcs->nid);
		$listdangchieu[] = $nodedangchieu;
	}
   	echo theme('show_trinhchieu',$listdangchieu);
   	
   	$resultsapchieu = db_query('SELECT node.nid AS nid,node.title AS node_title,node.created AS node_created FROM node node LEFT JOIN content_field_ngay_dien node_data_field_ngay_dien ON node.vid = node_data_field_ngay_dien.vid WHERE (DATE_FORMAT(ADDTIME(FROM_UNIXTIME(node_data_field_ngay_dien.field_ngay_dien_value), SEC_TO_TIME(25200)), "%%Y-%%m-%%d") > "%s") AND (node.type in ("kich_noi")) AND (node.nid != %d) ORDER BY node_created DESC',$dayset,$node->nid);
    while ($rowss = db_fetch_object($resultsapchieu)) {
		$nodesapchieu = node_load($rowss->nid);
		$listsapchieu[] = $nodesapchieu;
	}
   	echo theme('show_trinhchieu',$listsapchieu);
//View gmap

   	

?>