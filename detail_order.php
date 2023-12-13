<!DOCTYPE html>
<html lang="en">
<?php
include ("connection/connect.php");

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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


<body class="fix-header fix-sidebar">
    <div class="card card-outline-primary">

        <div class="card-header">
            <h4 class="m-b-0 text-white" style="color:black!important;">Chi tiết đơn hàng</h4>
        </div>

        <div class="table-responsive m-t-40">
            <table class="table table-bordered table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Tên nhà hàng</th>
                        <th>Tên món ăn</th>
                        <th>Số lượng</th>
                        <th>giá tiền</th>
                        <th>Tổng tiền</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                        $order_id = $_GET['order_id'];
                        $sql = "SELECT * FROM detail_order WHERE order_id = '$order_id'";
                        $query = mysqli_query($db, $sql);
                        $countOrder = 0;
                            while ($rows = mysqli_fetch_array($query)) {
                                $restaurant_id = $rows['restaurant_id'];
                                $query_name = mysqli_query($db, "SELECT title FROM restaurant WHERE rs_id = '$restaurant_id'");
                                $titleRestaurant = mysqli_fetch_array($query_name)[0];
                                $count = $rows['quantity'] * $rows['price'];
                                $countOrder += $count;
                    ?>
                    <tr>
                        <td><?php echo $titleRestaurant ?></td>
                        <td><?php echo $rows['title'] ?></td>
                        <td><?php echo $rows['quantity'] ?></td>
                        <td><?php echo $rows['price'].'.000đ' ?></td>
                        <td><?php echo $count .'.000đ' ?></td>
                    </tr>    
                        <?php
                            }
                        ?>
                    <tr>
                        <td style="text-align: end;" colspan="5">Tổng tiền đơn hàng: <?php echo $countOrder .'.000đ' ?></td>
                    </tr>    
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
