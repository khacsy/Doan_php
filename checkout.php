

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
    }
    if ($_POST['submit']) {
    $code = random_int(1000, 9999);

    $sqlOrder = "insert into `order` (u_id,code,ship,pay,address_oder) values ('" . $_SESSION["user_id"] . "','" . $code . "','" . $_POST['ship'] . "','" . $_POST['pay'] . "','" . $_POST['address_oder'] . "')";
    $queryOrder = mysqli_query($db, $sqlOrder);
    $orderId = mysqli_insert_id($db);
    foreach ($_SESSION["cart_item"] as $item) {
    
        $item_total += ($item["price"] * $item["quantity"]);

        // if ($_POST['submit']) {
            if ($_POST['mod'] == 'COD') {
                $sqlDetail = "INSERT INTO `detail_order` (order_id, restaurant_id, title, quantity, price) VALUES ('". $orderId ."', '". $_SESSION["id_rs"] ."', '". $item["title"] ."', '". $item["quantity"] ."', '". $item["price"] ."')";
                mysqli_query($db, $sqlDetail);
                $SQL = "insert into users_orders(u_id,restaurant_id,title,quantity,price,ship,code) values('" . $_SESSION["user_id"] . "','" . $_SESSION["id_rs"] . "','" . $item["title"] . "','" . $item["quantity"] . "','" . $item["price"] . "','" . $_POST['ship'] . "','" . $code . "')";

                mysqli_query($db, $SQL);
                $success = "Bạn đã đặt hàng thành công";
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
        // }
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
                                                                <td>Giao hàng</td>
                                                                <td><select name="ship" id="">
                                                                    <option value="1">Nhận tại nhà hàng</option>
                                                                    <option value="2">Giao tận tay khách hàng</option>
                                                                </select></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Thanh toán trước</td>
                                                                <td><select name="pay" id="">
                                                                    <option value="Thanh toán 30%">Thanh toán 30%</option>
                                                                    <option value="Thanh toán 50%">Thanh toán 50%</option>
                                                                    <option value="Thanh toán 75%">Thanh toán 75%</option>
                                                                </select></td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Địa chỉ giao hàng
                                                                </td>
                                                                <td>
                                                                    <textarea required name="address_oder" id="" cols="30" rows="3"></textarea>
                                                                </td>
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

                
        <div class="container">
            <div class="main-map">

                <div class="main-map-left">
                    <form>
                        <h1>Thông tin chuyến</h1>
                        <div class="left-form">
                            <i style="color:red;" class="fa-solid fa-location-dot"></i>
                            <input id="autocomplete" placeholder="Nhập địa chỉ đi..." type="text" required></input>
                        </div>
                        <div class="left-form">
                            <i style="color:blue;" class="fa-solid fa-location-dot"></i>
                            <input id="autocomplete-den" placeholder="Nhập địa chỉ đến..." type="text" required></input>
                        </div>
                        <div class="map-btn">
                            <button onclick="showSumbit()" type="button">Xem chuyến đi</button>
                        </div>
                    </form>
                </div>
                <div class="main-map-right">
                    <!-- bản đồ -->
                    <div id="googleMap" style="width:100%;height:400px;"></div>
                </div>
            </div>

    </section>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDksMnFQUmqOnGZGBIzVacv6YPEgYl8O30&libraries=places&callback=initAutocomplete"
        async defer></script>


    <script>
    var options = {
        types: ["geocode"],
        componentRestrictions: {
            country: "VN"
        }
    };

    function initAutocomplete() {
        autocomplete = new google.maps.places.Autocomplete(
            (document.getElementById("autocomplete")), options
        );
        autocomplete.addListener("place_changed", fillInAddress);



        autocompleteDen = new google.maps.places.Autocomplete(
            (document.getElementById("autocomplete-den")), options
        );
        autocompleteDen.addListener("place_changed", fillInAddressDen);

    }

    var addressDi = '';
    var addressDen = '';

    function fillInAddress() {

        var place = autocomplete.getPlace();
        addressDi = place.formatted_address
        // if (addressDi != '' && addressDen != '') {
        //     showMap(addressDi, addressDen);
        // }

    }

    function fillInAddressDen() {
        var place = autocompleteDen.getPlace();
        addressDen = place.formatted_address
        // if (addressDi != '' && addressDen != '') {
        //     showMap(addressDi, addressDen);
        // }

    }


    function showMap(start, end) {
        var mapProp = {
            center: new google.maps.LatLng(16.0544, 108.2022),
            zoom: 12,
        };

        var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

        var directionsService = new google.maps.DirectionsService();
        var directionsRenderer = new google.maps.DirectionsRenderer();
        directionsRenderer.setMap(map);

        var request = {
            origin: start,
            destination: end,
            travelMode: google.maps.TravelMode.DRIVING
        };

        directionsService.route(request, function(response, status) {
            // Kiểm tra xem yêu cầu chỉ đường đã thành công hay không.
            if (status == google.maps.DirectionsStatus.OK) {
                // Nếu yêu cầu thành công, đoạn mã này sẽ sử dụng directionsRenderer để hiển thị đường đi trên bản đồ.
                directionsRenderer.setDirections(response);

                // Hiển thị thông tin thời gian di và khoảng cách
                // Lấy thông tin về tuyến đường từ phản hồi. Trong trường hợp này, chỉ lấy tuyến đường đầu tiên
                var route = response.routes[0];
                // Khởi tạo biến để tính tổng thời gian và khoảng cách của tuyến đường.
                var duration = 0;
                var distance = 0;
                // Lặp qua các phần của tuyến đường (legs) để tính tổng thời gian và khoảng cách.
                for (var i = 0; i < route.legs.length; i++) {
                    duration += route.legs[i].duration.value;
                    distance += route.legs[i].distance.value;
                }
                // Chuyển đổi thời gian từ giây sang phút và làm tròn.
                var durationInMinutes = Math.round(duration / 60);
                // Chuyển đổi khoảng cách từ mét sang kilômét và làm tròn đến hai chữ số thập phân.
                var distanceInKm = (distance / 1000).toFixed(2);

                // Lấy vị trí giữa đoạn đường và sử dụng nó để đặt vị trí InfoWindow
                var routeCenter = route.overview_path[Math.floor(route.overview_path.length / 2)];
                // Tạo một InfoWindow với nội dung là thời gian và khoảng cách, sau đó đặt vị trí của InfoWindow tại routeCenter và mở nó trên bản đồ.
                var infoWindow = new google.maps.InfoWindow({
                    content: durationInMinutes + " phút<br>" + distanceInKm + " km"
                });

                infoWindow.setPosition(routeCenter);
                infoWindow.open(map);
            }
        });
    }

    function showSumbit() {
        if (addressDi != '' && addressDen != '') {
            showMap(addressDi, addressDen);
        }
    }
    </script>



    <style>
    .main-map {
        display: flex;
        margin-top: 50px
    }

    .main-map .main-map-left {
        width: 30%;
        margin-right: 15px;
    }

    .main-map .main-map-left form {
        padding: 10px;
        border: 1px solid blue;
    }

    .main-map .main-map-left form .left-form {
        padding: 15px;
        position: relative;
    }

    .main-map .main-map-left form .left-form i {
        position: absolute;
        bottom: 28px;
        left: 21px;
    }

    .main-map .main-map-left form .left-form input {
        width: 100%;
        height: 40px;
        padding-left: 25px;
    }

    .main-map .main-map-left form h1 {
        text-align: center;
        font-size: 30px;
        color: blue;
    }

    .main-map .main-map-right {
        width: 70%;
    }

    .main-map .map-btn {
        padding: 0 15px;
        margin-bottom: 30px;
    }

    .main-map .map-btn button {
        width: 100%;
        height: 40px;
        color: white;
        background: blue;
        border: none;
        border-radius: 38px;
        cursor: pointer;
    }
    </style>
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