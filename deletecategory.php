<?php
	require_once("config.php");
	$id = $_GET['id'];

	$delete = "DELETE FROM category where id = '$id'";
	mysql_query($delete);
	header("location:category.php");


?>