<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <title> About us</title>
        <?php require_once "head.php"; ?>
</head>
<body class="fixed-sn white-skin">
    <?php require_once "header.php";?>
    <main>
    <div class="container-fluid text-center">
    <div class="container-fluid no-gutters">
       <div class="d-flex justify-content-center align-items-center row no-gutters mt-4" style="height: 400px">
           <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
                <div>
                    <a href="http://aao.hcmut.edu.vn/"><img src="../images/bk.png" alt="logo" class="mx-auto d-block"></a>
                    <p class="d-flex justify-content-center"> Conputer Science &amp; Engineering</p>
                    <p class="d-flex justify-content-center"> Bach Khoa University</p>
                </div>
                <div class="pt-3 d-flex justify-content-center">
                    Follow us: 
                    <span> <a href="https://www.facebook.com/"> <img src="../images/facebook.png" alt="facebook icon" width="40" height="40"> </a></span>
                    <span> <a href="https://github.com/"> <img src="../images/github.png" alt="github icon" width="40" height="40"></a></span>
                </div>
                <div class="form-inline pt-3 d-flex justify-content-center">
                  <a href="https://www.youtube.com/"><button class="btn btn-outline-success" type="submit"><i class="fas fa-dollar-sign"></i> Donate</button></a>
                </div>
           </div>
           <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12" >
            <hr>
			   <h3> Instructor </h3> TS. Lê Trọng Nhân <br> 
               <h3> Developer </h3>
                   Lê Phương Nam <br>
                   Nguyễn Văn Minh
           </div>
       </div>
    </div>
    <div class="container-fluid no-gutters">
        <div class="row no-gutters">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
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
