<!DOCTYPE html>
<?php
	require_once("config.php");
?>
<html>

<head>
    <title>Page Title</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>

        table.roundedCorners {
        table-layout: fixed; width: 100%;
        border: 1px ;
        border-style: solid;
        border-color: #E4E0D5;
        border-radius: 13px;
        border-spacing: 0;

        border-collapse: separate;
        }
        table.roundedCorners td,
        table.roundedCorners th {
        border-style: solid;
        border-color: #E4E0D5;
        table-layout:auto;
        border-bottom: 15px ;
        padding: 4px;
        border-collapse: separate;
        }

        div {

        border-radius: 8px;
        }


        img {


        border-radius: 4px;
        padding: 5px;
        }
        .button {
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 08px 27px;
        text-align: center;

        border-radius: 8px;
        text-decoration: none;
        display: inline-block;
        font-size: 11px;
        margin: 4px 2px;
        cursor: pointer;
        -webkit-transition-duration: 0.4s; /* Safari */
        transition-duration: 0.4s;
        }

        .button1 {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
        }

        .button2:hover {
        box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
        }
        div.img {
			background-color: #ffffff;
			text-align: center;
			border: 1px solid #ccc;
			display: inline-block;
			width: 100%;
        }

        div.img:hover {
        border: 1px solid #777;
        }

        div.img img {

        width: 90px;
        height: 90px;
        }

        div.desc {


        text-align: center;
        }


        * {
        padding:2px;
        box-sizing: border-box;
        }

        .responsive {
        padding: 0 6px;
        float: left;
        width: 24.99999%;
        }

        @media only screen and (max-width: 700px){
        .responsive {
        width: 49.99999%;
        margin: 6px 0;
        }
        }

        @media only screen and (max-width: 500px){
        .responsive {
        width: 100%;
        }
        }

        .clearfix:after {
        content: "";
        display: table;
        clear: both;
        }

        h1
        {
        font-size: 10px;
        text-align: center;
        font-style: normal;
        font-weight: normal;

        }

        h2
        {
        font-size:16px;
        text-align:left;
        }

        .col {
		width:33.33%;
		float:left;
        flex: 1; /* additionally, equal width */
		
        }

    </style>
</head>
<body   bgcolor="#E4E0D5" >

<?php
$id = $_GET['id'];
			$select = "select * from tbl_application where category_id LIKE '%$id%' order by grid_order_id";
			$result = mysql_query($select);
		$i = 0;
		
	//	echo ">>> ".$id;
		while($row = mysql_fetch_array($result))
		{
	
	
			 if ($i%3==0)
			 {
?>			
<!-- POST 1 -->	 

	
	<TABLE width="100%">
	 <Td>
	<div class="img" style="position:relative;">
	<div class="col"  id="<?php echo $row['id']?>"  value="<?php echo $row['name']?>" name="<?php echo $row['url']?>" >
       
            <img src="<?php echo 'images/'.$row['icon']?>" alt="ICON" width="116" height="92">


        <h1><?php echo $row['name']?></h1>


        <button class="button button2">Install</button>
	</div>
	
<?php				 
			 }
			 else
			 {
				 
				if($i%3==1)
				{
?>

<!-- POST 2 -->

			<div class="col"  id="<?php echo $row['id']?>"  value="<?php echo $row['name']?>" name="<?php echo $row['url']?>"  style="">
              
                    <img src="<?php echo 'images/'.$row['icon']?>" alt="ICON" width="116" height="92">
			

                <h1><?php echo $row['name']?></h1>
                <button class="button button2">Install</button>
               
            </div>

<?php								
				}
				else
				{
?>
<!-- POST 3 -->

				<div class="col" id="<?php echo $row['id']?>" value="<?php echo $row['name']?>"  name="<?php echo $row['url']?>" style="">
               
                    <img src="<?php echo 'images/'.$row['icon']?>" alt="ICON" width="116" height="92">

					
				
                <h1><?php echo $row['name']?></h1>
               			  <button class="button button2">Install</button>
               
				</div>
				
				</div>
   </Td>
   

<?php		
				}
						
			 }
 $i++;
		
 }
  ?>
       
	<script src="js/jquery.js"></script>
	<script src="js/jquery-ui-1.10.4.min.js"></script>
    <script src="js/jquery-1.8.3.min.js"></script>
	<script>
		 $(document).ready(function() {
			$(".col").click(function(event){
				
				 var id=$(this).attr('id');
				 var value=$(this).attr('value');
				 var myUrl = $(this).attr('name');
				 
             //alert("ID: "+id+" Value: "+value);  
		
				
				$.ajax({
					url: "mobclick.php?id="+id+"&name="+value,
					type: "GET",
					success: function(result)
					{
						alert(myUrl);
						//location.reload();
					}});
				});
			});
	</script>
	   
	   
</body>

</html>


