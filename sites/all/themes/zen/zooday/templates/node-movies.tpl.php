<?php 



dpm($node);




foreach ($node->taxonomy as $value) {
	//2D 3D
	$get2d3d = taxonomy_get_parents($value->tid);
	foreach ($get2d3d as $value2) {
		echo $value2->name;
		$parent_total = $value2->tid;
	}
	$parent_get_total = taxonomy_get_parents($parent_total);
	dpm($parent_get_total);
	//H
	
	echo $value->name;
	
}



//dang chieu sap chieu


	//dang chieu
	$today = getdate();
	
	$dayset = $today['year'].'-'.$today['mon'].'-'.$today['mday'];
	$resultdangchieu = db_query('SELECT node.nid AS nid,node.title AS node_title,node.created AS node_created FROM node node LEFT JOIN content_field_ngay_dien node_data_field_ngay_dien ON node.vid = node_data_field_ngay_dien.vid WHERE (DATE_FORMAT(ADDTIME(FROM_UNIXTIME(node_data_field_ngay_dien.field_ngay_dien_value), SEC_TO_TIME(25200)), "%%Y-%%m-%%d") <= "%s") AND (node.type in ("movies")) AND (node.nid != %d) ORDER BY node_created DESC',$dayset,$node->nid);
    while ($rowcs = db_fetch_object($resultdangchieu)) {
		$nodedangchieu = node_load($rowcs->nid);
		$listdangchieu[] = $nodedangchieu;
	}
    echo theme('show_trinhchieu',$listdangchieu);
   	
   	$resultsapchieu = db_query('SELECT node.nid AS nid,node.title AS node_title,node.created AS node_created FROM node node LEFT JOIN content_field_ngay_dien node_data_field_ngay_dien ON node.vid = node_data_field_ngay_dien.vid WHERE (DATE_FORMAT(ADDTIME(FROM_UNIXTIME(node_data_field_ngay_dien.field_ngay_dien_value), SEC_TO_TIME(25200)), "%%Y-%%m-%%d") > "%s") AND (node.type in ("movies")) AND (node.nid != %d) ORDER BY node_created DESC',$dayset,$node->nid);
    while ($rowss = db_fetch_object($resultsapchieu)) {
		$nodesapchieu = node_load($rowss->nid);
		$listsapchieu[] = $nodesapchieu;
	}
   	echo theme('show_trinhchieu',$listsapchieu);
?>