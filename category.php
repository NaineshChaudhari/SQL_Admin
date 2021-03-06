<?php
	session_start();
	if(!isset($_SESSION['user']))
		header("location:index.php");
	require_once("config.php");

  if(isset($_POST['bulk_delete_submit']))
	{
        $idArr = $_POST['checkbox'];
        foreach($idArr as $id){
            echo $id;
	$delete = "DELETE FROM category where id = '$id'";
	mysql_query($delete);
	
        }
      header("location:category.php"); 
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
                  </li>
              </ul>
          </div>
      </aside>
      <section id="main-content">
	  <div class="wrapper">
	  <div class="row">
 <form name="order" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
          <div class="col-sm-12">
          <a href="addcategory.php" class="btn btn-primary">Add Category</a>
          <input type="submit" name="bulk_delete_submit" value="Delete Selected " class="btn btn-primary"/>
<hr/>
	
                      <section class="panel">
                          <header class="panel-heading">
                              Category List
                          </header>
                          <table class="table">
                              <thead>
                              <tr>
<th><input type="checkbox" id="select_all"/> Select All</th>
                                  <th>Id</th>
                                  <th>Category Name</th>
								  <th colspan="2">Action</th>
                              </tr>
                              </thead>
                              <tbody>
    <?php
		$select = "select * from category";
		$result = mysql_query($select);
		$i =1 ;
		while($row = mysql_fetch_array($result))
		{
	?>
                              <tr>
			<td align="center"><input type="checkbox" name="checkbox[]" class="checkbox" value="<?php echo $row['id']?>"/></td>
                                  <td><?php echo $i?></td>
                                  <td><?php echo $row['name']?></td>
                                  <td><a href="editcategory.php?id=<?php echo $row['id']?>">Edit</a></td>
                                  <td><a href="deletecategory.php?id=<?php echo $row['id']?>">Delete</a></td>
                              </tr>
<?php
 $i++;
 }
  ?>
                              </tbody>
                          </table>
                      </section>
                  </div>

				  </form>
      </section>
  </section>

<script src="js/jquery.js"></script>
	<script src="js/jquery-ui-1.10.4.min.js"></script>
    <script src="js/jquery-1.8.3.min.js"></script>


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
