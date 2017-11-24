<?php
	session_start();
	if(!isset($_SESSION['user']))
		header("location:index.php");
	require_once("config.php");
	$id = $_GET['id'];
	$name= $_GET['name'];
	$dt1=date("y-m-d");
	$dt2=date("H:i:s");

	$query = "INSERT INTO tbl_analytics VALUES('','$name','$id','$dt1','$dt2') ";
		mysql_query($query);

        $result = "select * from tbl_application where id = '$id'";
	$res = mysql_query($result);
	$application = mysql_fetch_row($res);
	
		$updatedclick=$application[7]+1;
		
		$query = "UPDATE tbl_application SET click='$updatedclick' WHERE id = '$id' ";		
		
		mysql_query($query);
	
	
?>