<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");  //include connection file
error_reporting(0);  // using to hide undefine undex errors
session_start(); //start temp session until Logout/browser closed

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Starter Template for Bootstrap</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="home">
<include src="./admin/menu.php"></include>
    <!-- header starts-->
    <!-- .navbar -->
     <header id="header" class="header-scroll top-header headrom">
        
        <nav class="navbar navbar-dark">
            <div class="container">
                <button class="navbar-toggler hidden-lg-up" type="button"
                    data-toggle="collapse"
                    data-target="#mainNavbarCollapse">&#9776;</button>
                <a class="navbar-brand" href="index.php"> <img
                        class="img-rounded" src="images/logotruong.png" alt=""> </a>
                <div class="collapse navbar-toggleable-md  float-lg-right"
                    id="mainNavbarCollapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"> <a class="nav-link active"
                                href="index.php">Trang Chủ <span
                                    class="sr-only">(current)</span></a> </li>
                        <li class="nav-item"> <a class="nav-link active"
                                href="restaurants.php">Nhà Hàng <span
                                    class="sr-only"></span></a> </li>


                        <?php
                    if(empty($_SESSION["user_id"])) // if user is not login
                        {
                            echo '<li class="nav-item"><a href="login.php" class="nav-link active">Đăng Nhập</a> </li>
                        <li class="nav-item"><a href="registration.php" class="nav-link active">Đăng Ký</a> </li>';
                        }
                    else
                        {
                                //if user is login
                                
                                echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">Đơn Đặt</a> </li>';
                                echo '<li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle active" href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> '.$_SESSION["username"].'</a>
                                <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                    <ul class="dropdown-user" style="
                                    background-color: white !important;">
                                    <li> <a class="dropdown-item" href="change_password.php"><i class="fa fa-gear"></i> Đổi mật khẩu</a> </li>
                                    <li> <a class="dropdown-item" href="Logout.php"><i class="fa fa-power-off"></i> Đăng Xuất </a> </li>
                                    
                                    </ul>
                                </div>
                              </li>';
                        }

                    ?>
                        <li class="nav-item">
                            <form action="search.php" method="get">
                                <input type="text" name="key" />
                                <button type="submit" >Tìm kiếm</button>
                            </form>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
       
    </header>
    <!-- /.navbar -->
    <!-- banner part starts -->
 
    
    <!-- end:Footer -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
</body>

</html>