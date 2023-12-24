<?php
    include ("html.php");
?>

<body>
    <!--header starts-->
<?php
    include ("header.php");
?>
    <div class="page-wrapper">
        <!-- top Links -->
        <div class="top-links">
            <div class="container">
                <ul class="row links">
                    <li class="col-xs-12 col-sm-4 link-item active">
                        <span>1</span><a href="restaurants.php">Chọn Nhà
                            Hàng</a>
                    </li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>2</span><a href="#">Đặt món ăn yêu thích của bạn</a>
                    </li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Giao hàng và thanh toán</a></li>
                </ul>
            </div>
        </div>
        <!-- end:Top links -->
        <!-- start: Inner page hero -->
        <div class="inner-page-hero bg-image" data-image-src="images/img/res.jpeg" style="background-image: url('images/img/res.jpeg');">
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
                                    <a class="img-fluid" href="dishes.php?res_id=<?php echo $rs_id; ?>"><img
                                            src="arst/Res_img/<?php echo $storeRow['image']; ?>" alt="Food logo"></a>
                                </div>
                                <div class="entry-dscr">
                                    <h5><a
                                            href="dishes.php?res_id=<?php echo $rs_id; ?>"><?php echo $storeRow['title']; ?></a>
                                    </h5>
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
                                        <a href="dishes.php?res_id=<?php echo $rs_id; ?>" class="btn theme-btn-dash">Xem
                                            Thực Đơn</a>
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
        <?php
    include ("footer.php");
?>

</body>

</html>