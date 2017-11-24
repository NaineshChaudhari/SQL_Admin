<?php
	require_once("config.php");
	$select = "select * from category order by id desc";
	$result = mysql_query($select);
	//print_R($result);die;
	$return = array();
	while($row = mysql_fetch_assoc($result))
	{
		$return['info'][] = $row;
				
	}
	echo json_encode($return);
	
?>