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

        <?php 
    $rs_id = $_GET['restaurant_id'];
    $query_name = mysqli_query($db, "SELECT title FROM restaurant WHERE rs_id = '$rs_id'");
    $title = mysqli_fetch_array($query_name)[0];
?>
        <div class="card-header">
            <h4 class="m-b-0 text-white">Chi tiết đơn hàng ' <?php echo $title ?> '</h4>
        </div>

        <div class="table-responsive m-t-40">
            <table id="myTable" class="table table-bordered table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Tên khách hàng</th>
                        <th>Tên món ăn</th>
                        <th>Số lượng</th>
                        <th>giá tiền</th>
                        <th>Tình trạng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM users_orders WHERE restaurant_id = '$rs_id'";
                        $query = mysqli_query($db, $sql);

                            while ($rows = mysqli_fetch_array($query)) {
                                $u_id = $rows['u_id'];
                                $query_name = mysqli_query($db, "SELECT l_name, f_name FROM users WHERE u_id = '$u_id'");
                                $user = mysqli_fetch_array($query_name);

                    ?>
                    <tr>
                        <td><?php echo $user[1] . ' ' .  $user[0] ?></td>
                        <td><?php echo $rows['title'] ?></td>
                        <td><?php echo $rows['quantity'] ?></td>
                        <td><?php echo $rows['price'] ?></td>
                        <td>
                            <?php 
                                $status=$rows['status'];
                                if($status=="" or $status=="NULL")
                                {
                            ?>
                            <button type="button" class="btn btn-info"><span class="fa fa-bars"
                                    aria-hidden="true"></span>
                                Đang xét duyệt</button>
                            <?php 
                                }
                                if($status=="in process")
                                { 
                            ?>
                            <button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin"
                                    aria-hidden="true"></span>
                                Đang vận chuyển!</button>

                            <?php 
                                }
                                if($status=="closed")
                                { 
                            ?>
                                            <button type="button"
                                                    class="btn btn-primary"><span
                                                        class="fa fa-cog fa-spin"
                                                        aria-hidden="true"></span>
                                                    Đã giao hàng!</button>
                                            
                            <?php
								}
																			
							?>
                            <?php
                                if($status=="rejected")
                                    {
                            ?>
                            <button type="button" class="btn btn-danger"> <i class="fa fa-close"></i>
                                Đã Hủy</button>
                            <?php 
                                } 
                            ?>
                        </td>
                    <tr>
                        <?php
                        }
                    ?>
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