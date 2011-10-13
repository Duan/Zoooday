<?php 



dpm($node);




//block orther event
$result = db_query('SELECT node.nid AS nid, node.title AS node_title, node_data_field_ngay_dien.field_ngay_dien_value AS node_data_field_ngay_dien_field_ngay_dien_value, node.type AS node_type, node.vid AS node_vid, node.created AS node_created FROM node node  LEFT JOIN content_field_ngay_dien node_data_field_ngay_dien ON node.vid = node_data_field_ngay_dien.vid WHERE (node.nid != %d) AND (node.type in ("music")) ORDER BY node_created DESC',$node->nid);
while ($rows = db_fetch_object($result)) {
	echo $rows->node_title;
	echo format_date($rows->node_data_field_ngay_dien_field_ngay_dien_value,'custom','h:iA, l d/m/Y');
}

//block map

?>