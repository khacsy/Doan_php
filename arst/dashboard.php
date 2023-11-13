<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

if(empty($_SESSION["user_id_restaurant"]))
{
	header('location:index.php');
}
else
{
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Restaurant Panel</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="fix-header">

    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none"
                stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>

    <div id="main-wrapper">

        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">

                <div class="navbar-header">
                    <a class="navbar-brand" href="dashboard.php">

                        <span><img src="images/logotruong.png" alt="homepage"
                                class="dark-logo" style="width: 70px" /></span>
                    </a>
                </div>

                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                    </ul>




                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted  "
                            href="#" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"><img
                                src="images/bookingSystem/user-icn.png"
                                alt="user" class="profile-pic" /></a>
                        <div
                            class="dropdown-menu dropdown-menu-right animated zoomIn">
                            <ul class="dropdown-user">
                                <li><a href="logout.php"><i
                                            class="fa fa-power-off"></i>
                                        Logout</a></li>
                            </ul>
                        </div>
                    </li>
                    </ul>
                </div>
            </nav>
        </div>

        <?php
    include("menu.php")
?>

        <div class="page-wrapper">



            <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="card card-outline-primary">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white">Restaurant Dashboard</h4>
                        </div>
                        <div class="row">

                            <div class="col-md-3">
                                <div class="card p-30">
                                    <div class="media">
                                        <div
                                            class="media-left meida media-middle">
                                            <span><i
                                                    class="fa fa-home f-s-40 "></i></span>
                                        </div>
                                        <div
                                            class="media-body media-text-right">
                                            <h2><?php $sql="select * from restaurant where restaurant_id =". $_SESSION["user_id_restaurant"];
												$result=mysqli_query($db,$sql); 
													$rws=mysqli_num_rows($result);
													
													echo $rws;?></h2>
                                            <p class="m-b-0">Nhà Hàng</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card p-30">
                                    <div class="media">
                                        <div
                                            class="media-left meida media-middle">
                                            <span><i class="fa fa-cutlery f-s-40"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <div
                                            class="media-body media-text-right">
                                            <h2><?php 
                                            $sql = "SELECT d.* FROM dishes d
                                            JOIN restaurant r ON d.rs_id = r.rs_id
                                            WHERE r.restaurant_id = " . $_SESSION["user_id_restaurant"];
                                            $result=mysqli_query($db,$sql); 
                                                $rws=mysqli_num_rows($result);
                                                
                                                echo $rws;?></h2>
                                            <p class="m-b-0">Món Ăn</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="col-md-3">
                                <div class="card p-30">
                                    <div class="media">
                                        <div
                                            class="media-left meida media-middle">
                                            <span><i
                                                    class="fa fa-users f-s-40"></i></span>
                                        </div>
                                        <div
                                            class="media-body media-text-right">
                                            <h2><?php $sql="select * from users";
												$result=mysqli_query($db,$sql); 
													$rws=mysqli_num_rows($result);
													
													echo $rws;?></h2>
                                            <p class="m-b-0">Tài Khoản</p>
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                            <div class="col-md-3">
                                <div class="card p-30">
                                    <div class="media">
                                        <div
                                            class="media-left meida media-middle">
                                            <span><i class="fa fa-shopping-cart f-s-40"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <div
                                            class="media-body media-text-right">
                                            <h2><?php $sql="select * from users_orders where restaurant_id =". $_SESSION["user_id_restaurant"]. " AND status != 'closed'" ;
												$result=mysqli_query($db,$sql); 
													$rws=mysqli_num_rows($result);
													
													echo $rws;?></h2>   
                                            <p class="m-b-0">Tổng Đơn Đặt</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card p-30">
                                    <div class="media">
                                        <div
                                            class="media-left meida media-middle">
                                            <span><i class="fa fa-th-large f-s-40"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <div
                                            class="media-body media-text-right">
                                            <h2><?php $sql="select * from res_category";
												$result=mysqli_query($db,$sql); 
													$rws=mysqli_num_rows($result);
													
													echo $rws;?></h2>
                                            <p class="m-b-0">Danh Mục</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card p-30">
                                    <div class="media">
                                        <div
                                            class="media-left meida media-middle">
                                            <span><i class="fa fa-spinner f-s-40"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <div
                                            class="media-body media-text-right">
                                            <h2><?php $sql="select * from users_orders WHERE restaurant_id =". $_SESSION["user_id_restaurant"]. " AND status = 'in process' ";
												$result=mysqli_query($db,$sql); 
													$rws=mysqli_num_rows($result);
													
													echo $rws;?></h2>
                                            <p class="m-b-0">Đơn Đặt Đang Xét
                                                Duyệt</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card p-30">
                                    <div class="media">
                                        <div
                                            class="media-left meida media-middle">
                                            <span><i class="fa fa-check f-s-40"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <div
                                            class="media-body media-text-right">
                                            <h2><?php $sql="select * from users_orders WHERE  restaurant_id =". $_SESSION["user_id_restaurant"]. " AND status = 'closed' ";
												$result=mysqli_query($db,$sql); 
													$rws=mysqli_num_rows($result);
													
													echo $rws;?></h2>
                                            <p class="m-b-0">Đơn đặt đã được
                                                giao</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card p-30">
                                    <div class="media">
                                        <div
                                            class="media-left meida media-middle">
                                            <span><i class="fa fa-times f-s-40"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <div
                                            class="media-body media-text-right">
                                            <h2><?php $sql="select * from users_orders WHERE restaurant_id =". $_SESSION["user_id_restaurant"]. " AND status = 'rejected' ";
                                        $result=mysqli_query($db,$sql); 
                                            $rws=mysqli_num_rows($result);
                                            
                                            echo $rws;?></h2>
                                            <p class="m-b-0">Đơn đặt đã bị hủy
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card p-30">
                                    <div class="media">
                                        <div
                                            class="media-left meida media-middle">
                                            <span><i class="fa fa-usd f-s-40"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <div
                                            class="media-body media-text-right">
                                            <h2><?php 
                                        $result = mysqli_query($db, 'SELECT SUM(price) AS value_sum FROM users_orders WHERE  restaurant_id ="'. $_SESSION["user_id_restaurant"]. '" AND status = "closed"'); 
                                        $row = mysqli_fetch_assoc($result); 
                                        $sum = $row['value_sum'];
                                        if($sum > 0){
                                            echo $sum;
                                        }
                                        else{
                                            echo 0;
                                        }
                                        ?></h2>
                                            <p class="m-b-0">Tổng Thu Nhập Được
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="js/lib/jquery/jquery.min.js"></script>
            <script src="js/lib/bootstrap/js/popper.min.js"></script>
            <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
            <script src="js/jquery.slimscroll.js"></script>
            <script src="js/sidebarmenu.js"></script>
            <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js">
            </script>
            <script src="js/custom.min.js"></script>

</body>

</html>
<?php
}
?>