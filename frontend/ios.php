<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <title> iOS Download</title>
	 	<?php require_once "head.php"; ?>
</head>
<body class="fixed-sn white-skin">
	<?php require_once "header.php"; ?>
    <main class="bd-masthead" id="content" role="main">
	  <div class="container">
	    <div class="row align-items-center">
	      <div class="col-6 mx-auto col-md-6 order-md-2">
	        <img class="img-fluid mb-3 mb-md-0" src="../images/ios.jpg" alt="" width="1024" height="860">
	      </div>
	      <div class="col-md-6 order-md-1 text-center text-md-left pr-md-5">
	      	<hr>
	        <h1 class="mb-3 bd-text-purple-bright">iOS Application</h1>

	        <p class="lead">
	          Display pH, temperature, liquid water level, dissolved oxygen, total dissolved solids, oxidation reduction potential chart. Data received from sensors and stored on the server.
	        </p>
	        <p class="lead mb-4">
	          iOS is a mobile operating system created and developed by Apple Inc. exclusively for its hardware. It is the operating system that presently powers many of the company's mobile devices, including the iPhone, iPad, and iPod Touch. It is the second most popular mobile operating system globally after Android. 
	        </p>
	        <div class="d-flex flex-column flex-md-row lead mb-3">
	          <a href="../app/ios.jpg" class="btn btn-lg btn-outline-secondary" onclick="ga('send', 'event', 'Jumbotron actions', 'Download', 'Download 4.1.3');">Download</a>
	        </div>
	      </div>
	    </div>
	  </div>
	</main>
	<?php require_once "footer.php";?>
	<script src="../script/canvasjs.min.js"></script>
	<script defer src="../font/js/all.js"></script>
	<script src="../script/jquery-3.2.1.slim.min.js"></script>
	<script src="../script/jquery-3.3.1.min.js"></script>
	<script src="../script/mbd.min.js"></script>
	<script src="../script/popper.min.js"></script>
	<script src="../script/bootstrap.min.js"></script>
	  <script>

         // SideNav Initialization
        $(".button-collapse").sideNav();
        
        new WOW().init();
    
    </script>
</body>
</html>