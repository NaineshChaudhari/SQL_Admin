<?php
	session_start();
	if(!isset($_SESSION['user']))
		header("location:index.php");
	require_once("config.php");
	
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



    <title>Notification</title>

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
  <?php
        // Enabling error reporting
        error_reporting(-1);
        ini_set('display_errors', 'On');
 
        require_once __DIR__ . '/firebase.php';
        require_once __DIR__ . '/push.php';
 
        $firebase = new Firebase();
        $push = new Push();
 
        // optional payload
        $payload = isset($_GET['vmessage']) ? $_GET['vmessage'] : '';
 
        // notification title
        $title = isset($_GET['title']) ? $_GET['title'] : '';
         
        // notification message
        $message = isset($_GET['message']) ? $_GET['message'] : '';
         
        // push type - single user / topic
        $push_type = isset($_GET['push_type']) ? $_GET['push_type'] : '';
         
       
 
        $push->setTitle($title);
        $push->setMessage($message);
       
 	
            $push->setImage('https://img.youtube.com/vi/'.$payload.'/hqdefault.jpg');
      
           
        $push->setIsBackground(FALSE);
        $push->setPayload($payload);
 
 





        $json = '';
        $response = '';
 
        if ($push_type == 'topic') {
            $json = $push->getPush();
            $response = $firebase->sendToTopic('global', $json);
        } else if ($push_type == 'individual') {
            $json = $push->getPush();
            $regId = isset($_GET['regId']) ? $_GET['regId'] : '';
            $response = $firebase->send($regId, $json);
        }
        ?>
  
 
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
                  </li>
              </ul>
          </div>
      </aside>
      <section id="main-content">
	  <div class="wrapper">
	  <div class="row">
	  
		</form>	
				  
			 </div>
			 </div>
			 
			 <form class="pure-form pure-form-stacked" method="get">
			 
                <fieldset>
                    <legend>Send to Topic Global</legend>
 
                    
                                 <div class="form-group">
                                      <label class="col-sm-2 control-label">Title</label>
                                      <div class="col-sm-6">
                                          <input type="text" class="form-control" id="title1" name="title" placeholder="Enter title">
                                      </div>
                                  </div>
<br/>

                                 <div class="form-group">
                                      <label class="col-sm-2 control-label">Message</label>
                                      <div class="col-sm-6">
                                          <input type="text" class="form-control" name="message" id="message1" rows="5" placeholder="Notification message!">
                                      </div>
                                  </div>

<br/>


 <div class="form-group">
                                      <label class="col-sm-2 control-label">Video ID</label>
                                      <div class="col-sm-6">
                                          <input type="text" class="form-control" name="vmessage" id="vmessage1" rows="5" placeholder="Video Id">
                                      </div>
                                  </div>

<br/>


                                <div class="form-group">

                                    <label class="col-sm-2 control-label"></label>

                                      <div class="col-sm-6">
                                      
                                        <input id="include_image1" class="pure-checkbox" name="include_image" type="checkbox">
                                        <label for="include_image1" class="control-label" > Include image </label>
                                        
                                       
                                      </div>
                                  </div>

                                


               
                    <input type="hidden" name="push_type" value="topic"/>
<br/>
 <hr/>					
                    <button type="submit" class="btn btn-primary">Send</button>
                </fieldset>
            </form>
			
			 <div class="fl_window">
                <div><img src="http://ndroid.hol.es/json/public_html/images/firebase_logo.png" width="200" alt="Firebase"/></div>
                <br/>
                <?php if ($json != '') { ?>
                    <label><b>Request:</b></label>
                    <div class="json_preview">
                        <pre><?php echo json_encode($json) ?></pre>
                    </div>
                <?php } ?>
                <br/>
                <?php if ($response != '') { ?>
                    <label><b>Response:</b></label>
                    <div class="json_preview">
                        <pre><?php echo json_encode($response) ?></pre>
                    </div>
                <?php } ?>
 
            </div>
			
			 
      </section>
  </section>

      	
  </body>
</html>
