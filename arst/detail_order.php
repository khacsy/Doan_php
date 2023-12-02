<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>View Order</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
</head>

<body class="fix-header fix-sidebar">
    <div class="card card-outline-primary">

        <div class="card-header">
            <h4 class="m-b-0 text-white">Chi tiết đơn hàng ' #<?php echo $_GET['code'] ?> '</h4>
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

    <script src="js/lib/jquery/jquery.min.js"></script>
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/lib/datatables/datatables.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js">
    </script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js">
    </script>
    <script src="js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js">
    </script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js">
    </script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js">
    </script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js">
    </script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js">
    </script>
    <script src="js/lib/datatables/datatables-init.js"></script>
</body>

</html>