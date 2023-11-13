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
    <script>
        function confirmUpdate(userId) {
            var confirmation = confirm("Bạn có chắc chắn muốn duyệt không?");
            if (confirmation) {
                window.location.href = "update_confirm.php?user_upd=" + userId;
            }
        }
    </script>
</head>

<body class="fix-header fix-sidebar">

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

                    <ul class="navbar-nav my-lg-0">



                        <li class="nav-item dropdown">

                            <div
                                class="dropdown-menu dropdown-menu-right mailbox animated zoomIn">
                                <ul>
                                    <li>
                                        <div class="drop-title">Notifications
                                        </div>
                                    </li>

                                    <li>
                                        <a class="nav-link text-center"
                                            href="javascript:void(0);">
                                            <strong>Check all
                                                notifications</strong> <i
                                                class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted  "
                                href="#" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><img
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
                <div class="row">
                    <div class="col-12">

                        <div class="col-lg-12">
                            <div class="card card-outline-primary">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">Danh sách tài
                                        khoản</h4>
                                </div>

                                <div class="table-responsive m-t-40">
                                    <table id="myTable"
                                        class="table table-bordered table-striped table-hover">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Tên đăng nhập</th>
                                                <th>Họ</th>
                                                <th>Tên</th>
                                                <th>Email</th>
                                                <th>Số Điện Thoại</th>
                                                <th>Địa Chỉ</th>
                                                <th>Reg-Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sql = "SELECT * FROM users WHERE status = 1 and Role = 'RT' ORDER BY u_id DESC";
                                                $query = mysqli_query($db, $sql);

                                                if (!mysqli_num_rows($query) > 0) {
                                                    echo '<td colspan="7"><center>No Users Confirm</center></td>';
                                                } else {
                                                    while ($rows = mysqli_fetch_array($query)) {
                                                        $userId = $rows['u_id']; // Đặt giá trị vào biến JavaScript
                                                        echo ' <tr><td>' . $rows['username'] . '</td>
                                                            <td>' . $rows['f_name'] . '</td>
                                                            <td>' . $rows['l_name'] . '</td>
                                                            <td>' . $rows['email'] . '</td>
                                                            <td>' . $rows['phone'] . '</td>
                                                            <td>' . $rows['address'] . '</td>																								
                                                            <td>' . $rows['date'] . '</td>
                                                            <td><a href="delete_users.php?user_del=' . $userId . '" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> 
                                                            <a href="javascript:void(0);" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5" onclick="confirmUpdate(' . $userId . ')"><i class="fa fa-edit"></i></a></td></tr>';
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
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

    <script src="js/lib/jquery/jquery.min.js"></script>>
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="js/custom.min.js"></script>


</body>

</html>