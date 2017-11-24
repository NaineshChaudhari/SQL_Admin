<?php
	require_once("config.php");
	$id = $_GET['id'];

	$delete = "DELETE FROM tbl_application where id = '$id'";
	mysql_query($delete);
	header("location:home.php");
?>