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
    <title>ADMIN</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
</head>

<body class="fix-header fix-sidebar">

    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <div id="main-wrapper">

        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="dashboard.php">

                        <span><img src="images/logotruong.png" alt="homepage" class="dark-logo"
                                style="width: 70px" /></span>
                    </a>
                </div>
                <div class="navbar-collapse">

                    <ul class="navbar-nav mr-auto mt-md-0">




                    </ul>

                    <ul class="navbar-nav my-lg-0">



                        <li class="nav-item dropdown">

                            <div class="dropdown-menu dropdown-menu-right mailbox animated zoomIn">
                                <ul>
                                    <li>
                                        <div class="drop-title">Notifications
                                        </div>
                                    </li>

                                    <li>
                                        <a class="nav-link text-center" href="javascript:void(0);">
                                            <strong>Check all
                                                notifications</strong> <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><img src="images/bookingSystem/user-icn.png"
                                    alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">
                                    <li><a href="logout.php"><i class="fa fa-power-off"></i>
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
                <div class="row">
                    <div class="col-12">

                        <div class="col-lg-12">
                            <div class="card card-outline-primary">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">Danh sách tài
                                        khoản</h4>
                                </div>

                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped table-hover">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Nhà hàng</th>
                                                <th>tổng tiền</th>
                                                <th>tổng số lượng</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT restaurant_id, SUM(price) as total_price, SUM(quantity) as total_quantity
                                                    FROM users_orders
                                                    GROUP BY restaurant_id;";
                                            $query = mysqli_query($db, $sql);
                                            if (!mysqli_num_rows($query) > 0) {
                                                echo '<td colspan="7"><center>No Users</center></td>';
                                            } else {
                                                while ($rows = mysqli_fetch_array($query)) {
                                                    $rs_id =$rows['restaurant_id'];
                                                    $query_name = mysqli_query($db, "SELECT title FROM restaurant WHERE rs_id = '$rs_id'");
                                                    $title = mysqli_fetch_array($query_name)[0];
   
                                        ?>
                                            <tr>
                                                <td><?php echo $title ?></td>
                                                <td><?php echo $rows['total_price'] ?></td>
                                                <td><?php echo $rows['total_quantity'] ?></td>
                                                <td><a href="javascript:void(0);"
                                                            onClick="popUpWindow('detail_oder.php?restaurant_id=<?php echo htmlentities($rs_id);?>');"
                                                            title="Detail order">
                                                            <button
                                                                type="button"
                                                                class="btn btn-primary">View</button></a></td>
                                            <tr>    
                                        <?php
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="main_index_admin_chart">
                                <div class="main_index_admin_chart_flex">
                                    <h3>Sơ đồ thống kê doanh thu theo : <span id="text-date"></span></h3>
                                    <div class="select_thongke">
                                        <select class="select-date">
                                            <option value="7ngay">1 tuần qua</option>
                                            <option value="28ngay">1 tháng qua</option>
                                            <option value="365ngay">1 năm qua</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="chart" style="height: 250px;"></div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>

    </div>
    <footer class="footer"> © 2023 - Team Pixel </footer>

    </div>

    </div>
    <style>
        #chart .morris-hover-row-label {
            color:#000000 !important ;
        }
        #chart .morris-hover-point {
            color:#0b62a4 !important ;
        }
    </style>

    <script language="javascript" type="text/javascript">
        var popUpWin = 0;

        function popUpWindow(URLStr, left, top, width, height) {
            if (popUpWin) {
                if (!popUpWin.closed) popUpWin.close();
            }
            popUpWin = open(URLStr, 'popUpWin',
                'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=' +
                1000 + ',height=' + 1000 + ',left=' + left + ', top=' + top +
                ',screenX=' + left + ',screenY=' + top + '');
        }
    </script>
    <script src="js/lib/jquery/jquery.min.js"></script>>
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <script>
    $(document).ready(function() {
        thongke();

        var char = new Morris.Line({

            element: 'chart',

            xkey: 'date',

            ykeys: ['sales', 'order', 'quantity'],
            // ykeys: ['order','sales','quantity'],

            labels: ['Doanh thu', 'Đơn hàng', 'Số lượng bán ra']
        });


        $('.select-date').change(function() {
            var thoigian = $(this).val();
            if (thoigian == '7ngay') {
                var text = 'tuần';
            } else if (thoigian == '28ngay') {
                var text = 'tháng';
            } else {
                var text = 'năm';
            }

            $.ajax({
                url: "thongke.php",
                method: "POST",
                dataType: "JSON",
                data: {
                    thoigian: thoigian
                },
                success: function(data) {
                    char.setData(data);
                    $('#text-date').text(text);
                }
            });

        })

        function thongke() {
            var text = 'tuần';
            $('#text-date').text(text);
            $.ajax({
                url: "thongke.php",
                method: "POST",
                dataType: "JSON",
                success: function(data) {
                    char.setData(data);
                    $('#text-date').text(text);
                }
            });
        }

    });
    </script>
</body>

</html>