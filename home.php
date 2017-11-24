<?php
	session_start();
	if(!isset($_SESSION['user']))
		header("location:index.php");
	require_once("config.php");



	if(isset($_POST['save']))
	{
		for($i=0; $i< count($_POST['id']); $i++)
		{
			$order = $_POST['order'][$i];
			$id = $_POST['id'][$i];
			$update = "UPDATE tbl_application set grid_order_id = '$order' WHERE id='$id'";
			mysql_query($update);
		}
	}

	if(isset($_POST['bulk_delete_submit']))
	{
        $idArr = $_POST['checkbox'];
        foreach($idArr as $id){
            echo $id;
	$delete = "DELETE FROM tbl_application where id = '$id'";
	mysql_query($delete);
	
        }
      header("location:home.php");    
       
        }
	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Admin Home Page</title>

    <!-- Bootstrap CSS -->    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <!-- date picker -->
    
    <!-- color picker -->
    
    <!-- Custom styles -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <script src="js/lte-ie7.js"></script>
    <![endif]-->

  </head>
  <body>

  <!-- container section start -->
  <section id="container" class="">
      <!--header start-->
      <header class="header dark-bg">
            <div class="toggle-nav">
                <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
            </div>
            <a href="index.php" class="logo">Nice <span class="lite">Admin</span></a>
      </header>      
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <ul class="sidebar-menu">                
                  <li class="active">
                      <a class="" href="home.php">
                          <i class="icon_house_alt"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
                  <li class="active">
                      <a class="" href="category.php">
                          <i class="fa fa-tag"></i>
                          <span>Category</span>
                      </a>
                  </li>
				  <!--	
		 <li class="active">
                      <a class="" href="anlytics.php">
                          <i class="fa fa-tag"></i>
                          <span>Analytics</span>
                      </a>
                  </li>
<li class="active">
                      <a class="" href="notification.php">
                          <i class="fa fa-tag"></i>
                          <span>Notification</span>
                      </a>
                  </li>
                  -->
              </ul>
          </div>
      </aside>
      <section id="main-content">
	  <div class="wrapper">
	  <div class="row">
		<?php
				$category = "select * from category";
				$result = mysql_query($category);
		  ?>
		 
			  <div class="col-sm-15">
				  <div class="col-sm-3">
					<a href="add.php" class="btn btn-primary">Add Item</a>
				  </div>
				<form>
			  <div class="col-sm-9">
				  <div class="col-sm-6">
					  <select class="form-control" name="id">
						<?php 
							while($row = mysql_fetch_array($result))
							{
								echo "<option value='$row[0]'>$row[1]</option>";
							}
						?>
					  </select>
				  </div>
				  <div class="col-sm-4">
			  <button type="submit" class="btn btn-primary">FILTER</button>

                               
			  </div>
			  </div>
 
			</form>	
<br/>
		  <hr/>		  
			 </div>
			 </div>
			 <form name="order" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
          <div class="col-sm-15">		  
          
                      <section class="panel">
                          <header class="panel-heading">
                              Item List
                          </header>
                          <table class="table">
                              <thead>
                              <tr>
				<th><input type="checkbox" id="select_all"/> Select All</th>
                                  <th>Id</th>
                                  <th>Item Name</th>
                                  
								  <th>Grid Order</th>
 								  <th>Like</th>
								
                                   <th>Icon</th>
								  <th colspan="2">Action</th>
                              </tr>
                              </thead>
                              <tbody>
    <?php
		if(isset($_GET['id']))
		{
			$id = $_GET['id'];
			$select = "select * from tbl_application where category_id LIKE '%$id%'  order by order_id";
		}
		else
		{
			$select = "select * from tbl_application  order by id desc";
		}
		$result = mysql_query($select);
		$i =1 ;
		while($row = mysql_fetch_array($result))
		{
	?>
                              <tr>

							      <input type="hidden" value="<?php echo $row['id']?>" name="id[]">

           
 <td align="center"><input type="checkbox" name="checkbox[]" class="checkbox" value="<?php echo $row['id']?>"/></td>
   											
                                  <td><?php echo $i?></td>
                                  <td><?php echo $row['name']?></td>

								  <td><input type="text" id="order" class="order_<?php echo $row['id']?>" name="order[]" value="<?php echo $row['grid_order_id'] ?>"></td>
								 <td><?php echo $row['click']?></td>
                                  <td><img src="<?php echo 'images/'.$row['icon']?>" height="50" width="50"/></td>
								  <td><a href="edit.php?id=<?php echo $row['id']?>">Edit</a></td>
								  
                                  <td><a href="delete.php?id=<?php echo $row['id']?>">Delete</a></td>
                              </tr>
<?php
 $i++;
 }
  ?>
                              </tbody>
                          </table>
                      </section>
                  </div>
				 <input type="submit" name="save" value="Save Order" class="btn btn-primary">
				  <input type="submit" name="bulk_delete_submit" value="Delete Selected " class="btn btn-primary"/>  
				  </form>
      </section>
  </section>



  <script src="js/jquery.js"></script>
	<script src="js/jquery-ui-1.10.4.min.js"></script>
    <script src="js/jquery-1.8.3.min.js"></script>
	<script>
		 $(document).ready(function() {
			$(".js-order").click(function(){
				var id = $(this).data('id');
				var order = $(".order_"+id).val();
				$.ajax({
					url: "updateorder.php?id="+id+"&order="+order,
					type: "GET",
					success: function(result)
					{
						location.reload();
					}});
				});
			});
	</script>

	<script>

$("#select_all").change(function(){  //"select all" change
    $(".checkbox").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
});

//".checkbox" change
$('.checkbox').change(function(){
    //uncheck "select all", if one of the listed checkbox item is unchecked
    if(false == $(this).prop("checked")){ //if this item is unchecked
        $("#select_all").prop('checked', false); //change "select all" checked status to false
    }
    //check "select all" if all checkbox items are checked
    if ($('.checkbox:checked').length == $('.checkbox').length ){
        $("#select_all").prop('checked', true);
    }
});
	</script>

  </body>
</html>
