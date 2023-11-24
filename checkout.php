

<?php
    include ("html.php");
?>
<?php
include_once 'product-action.php';

if (empty($_SESSION["user_id"])) {
    header('location:login.php');
} else {
    
    foreach ($_SESSION["cart_item"] as $item) {
    
        $item_total += ($item["price"] * $item["quantity"]);

        if ($_POST['submit']) {
            if ($_POST['mod'] == 'COD') {
                $SQL = "insert into users_orders(u_id,restaurant_id,title,quantity,price) values('" . $_SESSION["user_id"] . "','" . $_SESSION["id_rs"] . "','" . $item["title"] . "','" . $item["quantity"] . "','" . $item["price"] . "')";

                mysqli_query($db, $SQL);                 
                $checkVisits = "SELECT * FROM total_visits WHERE id_user = '" . $_SESSION["user_id"] . "' AND id_restaurant  = '" . $_SESSION["id_rs"] . "'";
                $resultVisits = mysqli_query($db, $checkVisits);

                if(mysqli_num_rows($resultVisits) > 0){
                    $updateVisits = "UPDATE total_visits SET sum_visits = sum_visits + 1 WHERE id_user = '" . $_SESSION["user_id"] . "' AND id_restaurant  = '" . $_SESSION["id_rs"] . "'";
                    mysqli_query($db, $updateVisits);
                }
                else{
                    $insertVisits = "INSERT INTO total_visits (id_user, id_restaurant, sum_visits) VALUES ('" . $_SESSION["user_id"] . "', '" . $_SESSION["id_rs"] . "', 1)";
                    mysqli_query($db, $insertVisits);
                }
               
                $success = "Thankyou! Your Order Placed successfully!";
                unset($_SESSION["cart_item"]);
            } else if ($_POST['mod'] == 'momo') {
                header('Content-type: text/html; charset=utf-8');
                // code to process momo payment
                function execPostRequest($url, $data)
                {
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt(
                        $ch,
                        CURLOPT_HTTPHEADER,
                        array(
                            'Content-Type: application/json',
                            'Content-Length: ' . strlen($data)
                        )
                    );
                    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                    //execute post
                    $result = curl_exec($ch);
                    //close connection
                    curl_close($ch);
                    return $result;
                }

                $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

                $partnerCode = 'MOMOBKUN20180529';
                $accessKey = 'klm05TvNBzhg7h7j';
                $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
                $orderInfo = "Thanh toán qua MoMo";
                $amount = $item_total;
                $orderId = rand(00, 9999);
                $redirectUrl = "http://localhost/Website/your_orders.php";
                $ipnUrl = "http://localhost/Website/your_orders.php";
                $extraData = "";

                $partnerCode = $partnerCode;
                $accessKey = $accessKey;
                $serectkey = $secretKey;
                $orderId = $orderId; // Mã đơn hàng
                $orderInfo = $orderInfo;
                $amount = $amount;
                $ipnUrl = $ipnUrl;
                $redirectUrl = $redirectUrl;
                $extraData = $extraData;

                $requestId = time() . "";
                $requestType = "payWithATM";
                //$extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
                //before sign HMAC SHA256 signature
                $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
                $signature = hash_hmac("sha256", $rawHash, $serectkey);
                $data = array(
                    'partnerCode' => $partnerCode,
                    'partnerName' => "Test",
                    "storeId" => "MomoTestStore",
                    'requestId' => $requestId,
                    'amount' => $amount,
                    'orderId' => $orderId,
                    'orderInfo' => $orderInfo,
                    'redirectUrl' => $redirectUrl,
                    'ipnUrl' => $ipnUrl,
                    'lang' => 'vi',
                    'extraData' => $extraData,
                    'requestType' => $requestType,
                    'signature' => $signature
                );
                $result = execPostRequest($endpoint, json_encode($data));
                $jsonResult = json_decode($result, true);  // decode json

                //Insert data into the database after MoMo payment
                $SQL = "insert into users_orders(u_id,title,quantity,price) values('" . $_SESSION["user_id"] . "','" . $item["title"] . "','" . $item["quantity"] . "','" . $item["price"] . "')";
                mysqli_query($db, $SQL);



                header('Location: ' . $jsonResult['payUrl']);
            } else if ($_POST['mod'] == 'momoqrcode') {


                function execPostRequest2($url, $data)
                {
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt(
                        $ch,
                        CURLOPT_HTTPHEADER,
                        array(
                            'Content-Type: application/json',
                            'Content-Length: ' . strlen($data)
                        )
                    );
                    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                    //execute post
                    $result = curl_exec($ch);
                    //close connection
                    curl_close($ch);
                    return $result;
                }


                $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
                $partnerCode = 'MOMOBKUN20180529';
                $accessKey = 'klm05TvNBzhg7h7j';
                $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
                $orderInfo = "Thanh toán qua MoMo";
                $amount = $item_total;
                $orderId = rand(00, 9999);
                $redirectUrl = "http://localhost/Website/your_orders.php";
                $ipnUrl = "http://localhost/Website/your_orders.php";
                $extraData = "";
                $partnerCode = $partnerCode;
                $accessKey = $accessKey;
                $serectkey = $secretKey;
                $orderId = $orderId; // Mã đơn hàng
                $orderInfo = $orderInfo;
                $amount = $amount;
                $ipnUrl = $ipnUrl;
                $redirectUrl = $redirectUrl;
                $extraData = $extraData;
                $requestId = time() . "";
                $requestType = "captureWallet";
                //$extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
                //before sign HMAC SHA256 signature
                $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
                $signature = hash_hmac("sha256", $rawHash, $serectkey);
                $data = array(
                    'partnerCode' => $partnerCode,
                    'partnerName' => "Test",
                    "storeId" => "MomoTestStore",
                    'requestId' => $requestId,
                    'amount' => $amount,
                    'orderId' => $orderId,
                    'orderInfo' => $orderInfo,
                    'redirectUrl' => $redirectUrl,
                    'ipnUrl' => $ipnUrl,
                    'lang' => 'vi',
                    'extraData' => $extraData,
                    'requestType' => $requestType,
                    'signature' => $signature
                );
                $result = execPostRequest2($endpoint, json_encode($data));
                $jsonResult = json_decode($result, true);  // decode json

                //Just a example, please check more in there
                $SQL = "insert into users_orders(u_id,title,quantity,price) values('" . $_SESSION["user_id"] . "','" . $item["title"] . "','" . $item["quantity"] . "','" . $item["price"] . "')";
                mysqli_query($db, $SQL);

                header('Location: ' . $jsonResult['payUrl']);
            }
        }
    }
?>

    <body>

        <div class="site-wrapper">
            <header id="header" class="header-scroll top-header headrom">
                <nav class="navbar navbar-dark">
                    <div class="container">
                        <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                        <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/logotruong.png" alt="">
                        </a>
                        <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                            <ul class="nav navbar-nav">
                                <li class="nav-item"> <a class="nav-link active" href="index.php">Trang Chủ <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Nhà Hàng <span class="sr-only"></span></a> </li>


                                <?php
                                if (empty($_SESSION["user_id"])) // if user is not login
                                {
                                    echo '<li class="nav-item"><a href="login.php" class="nav-link active">Đăng Nhập</a> </li>
                        <li class="nav-item"><a href="registration.php" class="nav-link active">Đăng Ký</a> </li>';
                                } else {
                                    //if user is login

                                    echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">Đơn Đặt</a> </li>';
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

                            </ul>

                        </div>
                    </div>
                </nav>
            </header>
            <div class="page-wrapper">
                <div class="top-links">
                    <div class="container">
                        <ul class="row links">

                            <li class="col-xs-12 col-sm-4 link-item">
                                <span>1</span><a href="restaurants.php">Chọn Nhà
                                    Hàng</a>
                            </li>
                            <li class="col-xs-12 col-sm-4 link-item ">
                                <span>2</span><a href="#">Đặt món ăn yêu thích của
                                    bạn</a>
                            </li>
                            <li class="col-xs-12 col-sm-4 link-item active">
                                <span>3</span><a href="checkout.php">Giao hàng
                                    và thanh toán</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="container">

                    <span style="color:green;">
                        <?php echo $success; ?>
                    </span>
                </div>
                <div class="container m-t-30">
                    <form action="" method="post">
                        <div class="widget clearfix">
                            <div class="widget-body">
                                <form method="post" action="#">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="cart-totals margin-b-20">
                                                <div class="cart-totals-title">
                                                    <h4>Thông tin đơn hàng</h4>
                                                </div>
                                                <div class="cart-totals-fields">

                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td>Tổng tiền</td>
                                                                <td> <?php echo $item_total . ".000đ"; ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Phí vận chuyển
                                                                </td>
                                                                <td>Miễn phí từ ưu
                                                                    đãi Free Ship
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Ưu đãi</td>
                                                                <td><input id ="ipvoucher" class = "ipvoucher" type="text" placeholder = "nhập voucher"></td>
                                                                <td><button>check</button></td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td class="text-color">
                                                                    <strong>Total</strong>
                                                                </td>
                                                                <td class="text-color">
                                                                    <strong>
                                                                        <?php echo $item_total . ".000đ"; ?></strong>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="payment-option">
                                                <ul class=" list-unstyled">
                                                    <li>
                                                        <label class="custom-control custom-radio  m-b-20">
                                                            <input name="mod" id="radioStacked1" checked value="COD" type="radio" class="custom-control-input">
                                                            <span class="custom-control-indicator"></span>
                                                            <span class="custom-control-description">Thanh
                                                                toán khi nhận
                                                                hàng</span>
                                                            <br> <span>Hãy chắc chắn
                                                                rằng địa chỉ của bạn
                                                                ghi đúng để mấy
                                                                anh shipper giao
                                                                đúng tận nơi</span>
                                                        </label>
                                                    </li>
                                                 
                                                    <li>
                                                        <label class="custom-control custom-radio  m-b-10">
                                                            <input name="mod" type="radio" value="momoqrcode" class="custom-control-input">
                                                            <span class="custom-control-indicator"></span>
                                                            <span class="custom-control-description">Thanh
                                                                Toán Momo QR CODE
                                                                <img src="images/momo.jpg" alt="" width="18"></span>
                                                        </label>
                                                    </li>

                                                </ul>
                                                <p class="text-xs-center"> <input type="submit" onclick="return confirm('Are you sure?');" name="submit" class="btn btn-outline-success btn-block" value="Đặt ngay"> </p>
                                            </div>
                                </form>
                            </div>
                        </div>

                </div>
            </div>
            </form>
        </div>
        <?php
    include ("footer.php");
?>
    </body>

</html>

<?php
}
?>