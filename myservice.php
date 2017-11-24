<?php
	$host="mysql.hostinger.in";
	$username="u311694825_json";
	$password="1lvkzUcI1k";
	$db_name="u311694825_json";
	
	$con = new mysqli($host, $username, $password, $db_name);
	
	if(mysqli_connect_errno()) 
	{  
		echo "Error: Could not connect to database.";  
		exit;
	}
	
	if(isset($_REQUEST["selectall"]))
	{
		$sql = "select * from contact";
		$result = mysqli_query($con, $sql) or die("Error in Selecting " . mysqli_error($con));

		
		while($row =mysqli_fetch_assoc($result))
		{
			$contactArray['data'][] = $row;
		}
		echo json_encode($contactArray);
	}
	
	if(isset($_REQUEST["insertcontact"]))
	{
		$name=$_REQUEST['name'];
		$number=$_REQUEST['number'];
		$email=$_REQUEST['email'];
		
		
		$sql="insert into contact (name,email,number) values ('$name','$email','$number')";		
		echo $count=mysqli_query($con, $sql);
	}
	
	
?>