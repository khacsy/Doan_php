<!DOCTYPE html>
<html lang="en">
<?php
include ("connection/connect.php");
error_reporting(0);
session_start();

if (empty($_SESSION['user_id'])) //if usser is not login redirected baack to login page

{
    header('location:login.php');
}
else
{
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
    <style type="text/css" rel="stylesheet">
    .indent-small {
        margin-left: 5px;
    }

    .form-group.internal {
        margin-bottom: 0;
    }

    .dialog-panel {
        margin: 10px;
    }

    .datepicker-dropdown {
        z-index: 200 !important;
    }

    .panel-body {
        background: #e5e5e5;
        /* Old browsers */
        background: -moz-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
        /* FF3.6+ */
        background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #e5e5e5), color-stop(100%, #ffffff));
        /* Chrome,Safari4+ */
        background: -webkit-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
        /* Chrome10+,Safari5.1+ */
        background: -o-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
        /* Opera 12+ */
        background: -ms-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
        /* IE10+ */
        background: radial-gradient(ellipse at center, #e5e5e5 0%, #ffffff 100%);
        /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#e5e5e5', endColorstr='#ffffff', GradientType=1);
        /* IE6-9 fallback on horizontal gradient */
        font: 600 15px "Open Sans", Arial, sans-serif;
    }

    label.control-label {
        font-weight: 600;
        color: #777;
    }


    table {
        width: 750px;
        border-collapse: collapse;
        margin: auto;

    }

    /* Zebra striping */
    tr:nth-of-type(odd) {
        background: #eee;
    }

    th {
        background: #ff3300;
        color: white;
        font-weight: bold;

    }

    td,
    th {
        padding: 10px;
        border: 1px solid #ccc;
        text-align: left;
        font-size: 14px;

    }

    /* 
Max width before this PARTICULAR table gets nasty
This query will take effect for any screen smaller than 760px
and also iPads specifically.
*/
    @media only screen and (max-width: 760px),
    (min-device-width: 768px) and (max-device-width: 1024px) {

        table {
            width: 100%;
        }

        /* Force table to not be like tables anymore */
        table,
        thead,
        tbody,
        th,
        td,
        tr {
            display: block;
        }

        /* Hide table headers (but not display: none;, for accessibility) */
        thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        tr {
            border: 1px solid #ccc;
        }

        td {
            /* Behave  like a "row" */
            border: none;
            border-bottom: 1px solid #eee;
            position: relative;
            padding-left: 50%;
        }

        td:before {
            /* Now like a table header */
            position: absolute;
            /* Top/left values mimic padding */
            top: 6px;
            left: 6px;
            width: 45%;
            padding-right: 10px;
            white-space: nowrap;
            /* Label the data */
            content: attr(data-column);

            color: #000;
            font-weight: bold;
        }

    }
    </style>

</head>

<body>

    <!--header starts-->
    <?php
    include ("header.php");
?>
    <div class="page-wrapper">
        <!-- top Links -->

        <!-- end:Top links -->
        <!-- start: Inner page hero -->
        <div class="inner-page-hero bg-image" data-image-src="images/img/res.jpeg" style="background-image: url('images/img/res.jpeg');">
            <div class="container"> </div>
            <!-- end:Container -->
        </div>
        <div class="result-show">
            <div class="container">
                <div class="row">


                </div>
            </div>
        </div>
        <!-- //results show -->
        <section class="restaurants-page">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3">


                        <div class="widget clearfix">

                           
                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-7 col-md-7 ">
                        <div class="bg-gray restaurant-entry">
                            <div class="row">

                                <table>
                                    <thead>
                                        <tr>
<!-- 
                                            <th>Tên Món</th>
                                            <th>Số lượng</th>
                                            <th>Giá tiền</th>
                                            <th>Tình trạng</th>
                                            <th>Giao hàng</th>
                                            <th>Date</th>
                                            <th>Action</th> -->
                                            <th>Mã đơn hàng</th>
                                            <th>Tên người dùng</th>
                                            <th>Địa chỉ</th>
                                            <th>Tình trạng</th>
                                            <th>Giao hàng</th>
                                            <th>Reg-Date</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    $id_user = $_SESSION['user_id'];
												$sql = "SELECT `order`.*, users.address, users.l_name, users.f_name FROM `order`
                                                JOIN users ON `order`.u_id = users.u_id WHERE users.u_id = '$id_user'
                                                ORDER BY `order`.id DESC";
												$query=mysqli_query($db,$sql);
												
													if(!mysqli_num_rows($query) > 0 )
														{
															echo '<td colspan="8"><center>No Orders</center></td>';
														}
													else
														{				
														while($rows=mysqli_fetch_array($query))
															{
                                                                $status=$rows['status'];
                                                                if($status == null) {
                                                                    $status = "Chờ xét duyệt";
                                                                }
																				?>
                                            <?php
                                             
                                             
																					echo ' <tr>
																					           <td>#'. $rows['code'] .'</td>
																								<td>'. $rows['l_name'] .' '. $rows['f_name'] .'</td>
																								<td>'. $rows['address'] .'</td>';
																								?>
                                            
                                            <?php
                                                if($status != NULL ){
                                            ?>
                                            <td> <button type="button" class="btn btn-warning"><span
                                                        class="fa fa-cog fa-spin" aria-hidden="true"></span>
                                                    <?php echo $status ?></button>
                                            </td>
                                            <?php
												}
																			
											?>
                                            <?php 
																			$ship = $rows['ship'];
																			if($ship == "1")
																				{
																		?>
                                            <td> Nhận tại nhà hàng</td>
                                            <?php 
																			} else {
                                                                        ?>
                                            <td> Giao tận tay khách hàng</td>
                                            <?php 
																			}
                                                                        ?>
                                            <?php																									
												echo '	<td>'.$rows['date'].'</td>';
											?>
                                            <td>
                                            <a href="javascript:void(0);" class="btn btn-info btn-flat btn-addon btn-xs m-b-10" 
                                            onClick="popUpWindow('detail_order.php?order_id=<?php echo $rows['id'] ?>&code=<?php echo $rows['code'] ?>');">
                                            <i class="fa fa-bars" style="font-size:16px"></i></a>

											</td>
											</tr>
																					 
																						
                                             <?php			
																		}	
														}
												
											
											?>
                                    </tbody>
                                </table>
                            </div>
                            <!--end:row -->
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
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
    <?php
    include ("footer.php");
?>
</body>

</html>
<?php
}
?>