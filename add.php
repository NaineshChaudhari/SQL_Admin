<?php
	session_start();
	if(!isset($_SESSION['user']))
		header("location:index.php");
	require_once("config.php");
	if(isset($_POST['submit']))
	{
		$imageName = '';
		if(isset($_FILES['icon']['name']) && !empty($_FILES['icon']['name']))
		{
			$imageName = time().$_FILES['icon']['name'];
			move_uploaded_file($_FILES['icon']['tmp_name'],'images/'.$imageName);
		}
	
		$category = implode(',',$_POST['category']);
		$name = $_POST['name'];
		$url = $_POST['url'];
	
		
		$query = "INSERT INTO tbl_application VALUES('','$name','$url','$category',0,'$imageName','','') ";
		mysql_query($query);
		$query = "update tbl_application set order_id = order_id + 1";
		mysql_query($query);
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

    <title>Add Application Information</title>

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
		
<!--		
                  </li>
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
		<div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             Add Information
                          </header>
                          <div class="panel-body">
                              <form class="form-horizontal " method="POST" action="<?php $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
							  <?php
								$category = "select * from category";
								$result = mysql_query($category);
							  ?>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Category</label>
                                      <div class="col-sm-6">
											<?php
												while($row = mysql_fetch_array($result))
												{
											?>
											<input type="checkbox" name="category[]" value="<?php echo $row['id']?>"><?php echo $row['name'] ?>
											<?php 
											}
											?>
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">Blog Name</label>
                                      <div class="col-sm-6">
                                          <input type="text" class="form-control" name="name">
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">Blog URL</label>
                                      <div class="col-sm-6">
                                          <input type="text" class="form-control" name="url">
                                      </div>
                                  </div>
								 
							
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Blog Icon</label>
                                      <div class="col-sm-6">
                                          <input type="file"  name="icon">
                                      </div>
                                  </div>
								  
								  <div class="form-group">
                                      <label class="col-sm-2 control-label"></label>
                                      <div class="col-sm-6">
                                          <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                      </div>
                                  </div>
								  
								  </form>
								 </div>
								 </div>
	  </div> 
      </section>
  </section>
  </body>
</html>
