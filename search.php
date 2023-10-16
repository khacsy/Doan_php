<!DOCTYPE html>
<html lang="en">
<?php
include ("connection/connect.php");
error_reporting(0);
session_start();
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/search.js"></script>
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!--header starts-->
    <header id="header" class="header-scroll top-header headrom">
        <!-- .navbar -->
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
                        if (empty($_SESSION["user_id"])) // if user is not login

                        {
                            echo '<li class="nav-item"><a href="login.php" class="nav-link active">Đăng Nhập</a> </li>
                                                <li class="nav-item"><a href="registration.php" class="nav-link active">Đăng Ký</a> </li>';
                        }
                        else
                        {
                            //if user is login
                            echo '<li class="nav-item"><a href="your_orders.php" class="nav-link active">Đơn Đặt</a> </li>';
                            echo '<li class="nav-item dropdown">
                                                        <a class="nav-link dropdown-toggle active" href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> ' . $_SESSION["username"] . '</a>
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
                                <form action="" method="get">
                                    <input type="text" name="key" id="search-input" />
                                    <button type="submit">Tìm kiếm</button>
                                </form>
                                <div class="kqtimkiem" id="countSearchh" >
                                </div>
                            </li>

                            <script>
                               $(document).ready(function() {
    $("#search-input").on("input", function() {
        var key = $(this).val();
        $.ajax({
            type: "GET",
            url: "search_confirm.php",
            data: { key: key },
            success: function(data) {
                var results = data.split(', '); 
                var $countSearch = $("#countSearchh");
                $countSearch.empty(); 

                if (results.length > 0) {
                    for (var i = 0; i < results.length; i += 2) {
                        var title = results[i];
                        var name = results[i + 1];
                    
                        var resultDiv = document.createElement("div");

                        var titleSpan = document.createElement("span");
                        titleSpan.textContent =  title;
                        titleSpan.style.display = "block";
                        titleSpan.style.fontWeight = "bold";

                        var nameSpan = document.createElement("span");
                        nameSpan.textContent =  name;
                        nameSpan.style.display = "block";

                        resultDiv.appendChild(titleSpan);
                        resultDiv.appendChild(nameSpan);

                        $countSearch.append(resultDiv);
                    }
                } else {
                    var span = document.createElement("span");
                    span.textContent = "Không tìm thấy kết quả phù hợp.";
                    span.style.display = "inline";
                    span.style.color = "red";
                    $countSearch.append(span);
                }
            }
        });
    });
});


                            </script>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- /.navbar -->
    </header>
    <div class="page-wrapper">
        <!-- top Links -->
        <div class="top-links">
            <div class="container">
                <ul class="row links">
                    <li class="col-xs-12 col-sm-4 link-item active">
                        <span>1</span><a href="restaurants.php">Chọn Nhà
                            Hàng</a>
                    </li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>2</span><a
                            href="#">Đặt món ăn yêu thích của bạn</a>
                    </li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a
                            href="#">Giao hàng và thanh toán</a></li>
                </ul>
            </div>
        </div>
        <!-- end:Top links -->
        <!-- start: Inner page hero -->
        <div class="inner-page-hero bg-image"
            data-image-src="images/img/res.jpeg">
            <div class="container"> </div>
            <!-- end:Container -->
        </div> 
    <?php
        if (isset($_GET['key'])) {
            $key = $_GET['key'];
            if (!$db) {
                die("Lỗi kết nối cơ sở dữ liệu: " . mysqli_connect_error());
            }
            $stmt = $db->prepare("SELECT * FROM dishes WHERE dishes.title LIKE ?");
            if ($stmt) {
                $key = "%" . $key . "%";
                $stmt->bind_param("s", $key);
                if ($stmt->execute()) {
                    $ress = $stmt->get_result();
                } else {
                    echo "Lỗi truy vấn: " . $stmt->error;
                }
            } else {
                echo "Lỗi chuẩn bị truy vấn: " . $db->error;
            }

            if (isset($ress)) {
                $countSearch = mysqli_num_rows($ress);

                if ($countSearch > 0) {
                    $row = mysqli_fetch_assoc($ress);
                    $rs_id = $row['rs_id'];
                    $storeQuery = mysqli_query($db, "SELECT * FROM restaurant WHERE rs_id = $rs_id");
                    $storeRow = mysqli_fetch_assoc($storeQuery);
                }
            }
        }
    ?>

        <div class="result-show">
            <div class="container">
                <div class="row">
                    Tìm kiếm "<?php echo $key ?>" có <?php echo $countSearch ?> thực đơn
                </div>
            </div>
        </div>
      
        <!-- //results show -->
        <section class="restaurants-page">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3">


                        <div class="widget clearfix">
                            <!-- /widget heading -->
                            <div class="widget-heading">
                                <h3 class="widget-title text-dark">
                                    Popular tags
                                </h3>
                                <div class="clearfix"></div>
                            </div>
                            <div class="widget-body">
                                <ul class="tags">
                                    <li> <a href="#" class="tag">
                                            Pizza
                                        </a> </li>
                                    <li> <a href="#" class="tag">
                                            Sendwich
                                        </a> </li>
                                    <li> <a href="#" class="tag">
                                            Sendwich
                                        </a> </li>
                                    <li> <a href="#" class="tag">
                                            Fish
                                        </a> </li>
                                    <li> <a href="#" class="tag">
                                            Desert
                                        </a> </li>
                                    <li> <a href="#" class="tag">
                                            Salad
                                        </a> </li>
                                </ul>
                            </div>
                        </div>
                        <!-- end:Widget -->
                    </div>
                    
                    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-9">
                    
                        <div class="bg-gray restaurant-entry">
                        <?php
if (isset($_GET['key'])) {
    $key = $_GET['key'];
    if (!$db) {
        die("Lỗi kết nối cơ sở dữ liệu: " . mysqli_connect_error());
    }

    // Sử dụng prepared statement để tránh lỗ hổng SQL injection
    $stmt = $db->prepare("SELECT * FROM dishes WHERE dishes.title LIKE ?");
    if ($stmt) {
        $key = "%" . $key . "%";
        $stmt->bind_param("s", $key);
        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $rs_id = $row['rs_id'];

                    // Sử dụng prepared statement cho truy vấn lấy thông tin nhà hàng
                    $storeQuery = $db->prepare("SELECT * FROM restaurant WHERE rs_id = ?");
                    if ($storeQuery) {
                        $storeQuery->bind_param("i", $rs_id);
                        $storeQuery->execute();
                        $storeResult = $storeQuery->get_result();
                        $storeRow = $storeResult->fetch_assoc();
                        $storeQuery->close();
                    }
                    ?>
                    <div class="col-sm-12 col-md-12 col-lg-8 text-xs-center text-sm-left">
                        <div class="entry-logo">
                            <a class="img-fluid" href="dishes.php?res_id=<?php echo $rs_id; ?>"><img src="admin/Res_img/<?php echo $storeRow['image']; ?>" alt="Food logo"></a>
                        </div>
                        <div class="entry-dscr">
                            <h5><a href="dishes.php?res_id=<?php echo $rs_id; ?>"><?php echo $storeRow['title']; ?></a></h5>
                            <span><?php echo $storeRow['address']; ?> <a href="#">...</a></span>
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-check"></i> Min $ 10,00</li>
                                <li class="list-inline-item"><i class="fa fa-motorcycle"></i> 30 min</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4 text-xs-center">
                        <div class="right-content bg-white">
                            <div class="right-review">
                                <div class="rating-block">
                                    <?php
                                    // Đánh giá sao dựa trên một số nào đó
                                    $rating = 4; // Thay đổi số này bằng đánh giá thực tế
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $rating) {
                                            echo '<i class="fa fa-star"></i>';
                                        } else {
                                            echo '<i class="fa fa-star-o"></i>';
                                        }
                                    }
                                    ?>
                                </div>
                                <p>245 Reviews</p>
                                <a href="dishes.php?res_id=<?php echo $rs_id; ?>" class="btn theme-btn-dash">Xem Thực Đơn</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<h3>Không có thực đơn nào</h3>';
            }
        } else {
            echo "Lỗi truy vấn: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Lỗi chuẩn bị truy vấn: " . $db->error;
    }
}
?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="app-section">
        <div class="app-wrap">
            <div class="container">
                <div class="row text-img-block text-xs-left">
                    <div class="container">
                        <div
                            class="col-xs-12 col-sm-6 hidden-xs-down right-image text-center">
                            <figure> <img src="images/app.png"
                                    alt="Right Image"> </figure>
                        </div>
                        <div class="col-xs-12 col-sm-6 left-text">
                            <h3>The Best Food Delivery App</h3>
                            <p>Now you can make food happen pretty much wherever
                                you are thanks to the free easy-to-use
                                Food Delivery &amp; Takeout App.</p>
                            <div class="social-btns">
                                <a href="#"
                                    class="app-btn apple-button clearfix">
                                    <div class="pull-left"><i
                                            class="fa fa-apple"></i> </div>
                                    <div class="pull-right"> <span
                                            class="text">Available on the</span>
                                        <span class="text-2">App Store</span>
                                    </div>
                                </a>
                                <a href="#"
                                    class="app-btn android-button clearfix">
                                    <div class="pull-left"><i
                                            class="fa fa-android"></i> </div>
                                    <div class="pull-right"> <span
                                            class="text">Available on the</span>
                                        <span class="text-2">Play store</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- start: FOOTER -->
    <footer class="footer">
        <div class="container">
            <!-- top footer statrs -->
            <div class="row top-footer">
                <div class="col-xs-12 col-sm-3 footer-logo-block color-gray">
                    <a href="#"> <img src="images/logotruong.png" alt="Footer logo">
                    </a> <span>Order Delivery &amp; Take-Out
                    </span>
                </div>
                <div class="col-xs-12 col-sm-2 about color-gray">
                    <h5>About Us</h5>
                    <ul>
                        <li><a href="#">About us</a> </li>
                        <li><a href="#">History</a> </li>
                        <li><a href="#">Our Team</a> </li>
                        <li><a href="#">We are hiring</a> </li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-2 how-it-works-links color-gray">
                    <h5>How it Works</h5>
                    <ul>
                        <li><a href="#">Enter your location</a> </li>
                        <li><a href="#">Choose restaurant</a> </li>
                        <li><a href="#">Choose meal</a> </li>
                        <li><a href="#">Pay via credit card</a> </li>
                        <li><a href="#">Wait for delivery</a> </li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-2 pages color-gray">
                    <h5>Pages</h5>
                    <ul>
                        <li><a href="#">Search results page</a> </li>
                        <li><a href="#">User Sing Up Page</a> </li>
                        <li><a href="#">Pricing page</a> </li>
                        <li><a href="#">Make order</a> </li>
                        <li><a href="#">Add to cart</a> </li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-3 popular-locations color-gray">
                    <h5>Payment Options</h5>
                    <ul>
                        <li>
                            <a href="#"> <img src="images/paypal.png"
                                    alt="Paypal"> Paypal</a>
                        </li>
                        <li>
                            <a href="#"> <img src="images/mastercard.png"
                                    alt="Mastercard"> Mastercard </a>
                        </li>
                        <li>
                            <a href="#"> <img src="images/maestro.png"
                                    alt="Maestro"> Maestro </a>
                        </li>
                        <li>
                            <a href="#"> <img src="images/stripe.png"
                                    alt="Stripe"> Stripe </a>
                        </li>
                        <li>
                            <a href="#"> <img src="images/bitcoin.png"
                                    alt="Bitcoin"> Bitcoin </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- top footer ends -->

        </div>
    </footer>
    <!-- end:Footer -->
    </div>


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