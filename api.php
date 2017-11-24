<?php
	require_once("config.php");
        $category_id = $_REQUEST['category_id'];

$select = "select * from tbl_application where  category_id LIKE '%$category_id%' order by grid_order_id ASC";

	$result = mysql_query($select);
	//print_R($result);die;
	$return = array();
	while($row = mysql_fetch_assoc($result))
	{
		$return['info'][] = $row;
				
	}
	echo json_encode($return);
	
?>