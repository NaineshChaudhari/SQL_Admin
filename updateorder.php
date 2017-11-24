<?php
	require_once("config.php");
	$id = $_GET['id'];
	$order =  $_GET['order'];
	$query = "Update tbl_application set order_id = '$order' where id= '$id'";
	mysql_query($query);
?>