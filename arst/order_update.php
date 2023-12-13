<?php

include("../connection/connect.php");
require('carbon/Carbon.php');
use Carbon\Carbon;
$date = Carbon::now('Asia/Ho_Chi_Minh');
$formattedDateTime = $date->format('Y-m-d H:i:s');
$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
error_reporting(0);
session_start();
if (strlen($_SESSION['user_id_restaurant']) == 0) {
  header('location:../login.php');
} else {
  if (isset($_POST['update'])) {
    $status = $_POST['status'];
    $order_id = $_GET['order_id'];

    mysqli_query($db, "update `order` set status='$status', date='$formattedDateTime' where id='$order_id'");
 
    if ($status == 'closed') {
      
			$query_thongke = mysqli_query($db,"select * from statistical where date = '$now'");
      $soluongmua = 0;
			$price = 0;
      $query = "SELECT * FROM users_orders WHERE date LIKE '%".$now."%' ";
      $sql_search = mysqli_query($db, $query);
      while($row = mysqli_fetch_array($sql_search)){
        $soluongmua+=$row['quantity'];
        $price+=$row['price'];
      }
      if(mysqli_num_rows($query_thongke)==0){
        $quantity = $soluongmua;
        $price = $price;
        $oder = 1;
        mysqli_query($db,"INSERT INTO statistical (date,oder,price,quantity) VALUE('$now','$oder','$price','$quantity')" );
        
      }

      if(mysqli_num_rows($query_thongke)!=0){
        while($row_tk = mysqli_fetch_array($query_thongke)){
          $quantity = $row_tk['quantity'] + $soluongmua;
          $price = $row_tk['price'] + $price;
          $oder = $row_tk['oder']+1;
          mysqli_query($db,"UPDATE statistical SET oder='$oder',price='$price',quantity='$quantity' WHERE date='$now'" );
          
        }
      }
    }

    echo "<script>alert('Form Details Updated Successfully');</script>";
    echo "<div style='text-align: center; margin-top: 50vh; transform: translateY(-50%);'>";
    echo "<h1>Bạn đã cập nhật thành công</h1>";
    echo "</div>";
    window.close();
    header("Location: all_orders.php");

  }

?>
  <script language="javascript" type="text/javascript">
    function f2() {
      window.close();
    }
  

    function f3() {
      window.print();
    }
  </script>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>Order Update</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>

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
        background: -moz-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
        background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #e5e5e5), color-stop(100%, #ffffff));
        background: -webkit-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
        background: -o-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
        background: -ms-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
        background: radial-gradient(ellipse at center, #e5e5e5 0%, #ffffff 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#e5e5e5', endColorstr='#ffffff', GradientType=1);
        font: 600 15px "Open Sans", Arial, sans-serif;
      }

      label.control-label {
        font-weight: 600;
        color: #777;
      }

      table {
        width: 650px;
        border-collapse: collapse;
        margin: auto;
        margin-top: 50px;
      }


      tr:nth-of-type(odd) {
        background: #eee;
      }

      th {
        background: #004684;
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
    </style>
  </head>

  <body>

    <div style="margin-left:50px;">
      <form name="updateticket" id="updatecomplaint" method="post">




        <table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><b>Đơn hàng</b></td>
            <td>#<?php echo $_GET['code'] ?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>

            <td>&nbsp;</td>
          </tr>

          <tr>
            <td><b>Tình trạng</b></td>
            <td><select name="status" required="required">
                <option value="">---Chọn tình trạng---</option>
                <option value="Đang vận chuyển">Đang vận chuyển</option>
                <option value="Đã giao hàng">Đã giao hàng</option>
                <option value="Đã thanh toán 20%">Đã thanh toán 20%</option>
                <option value="Đã thanh toán 50%">Đã thanh toán 50%</option>
                <option value="Đã thanh toán 100%">Đã thanh toán 100%</option>
                <option value="Đã hủy">Đã hủy</option>

              </select></td>
          </tr>

          <tr>
            <td><b>Ghi chú</b></td>
            <td><textarea name="remark" cols="50" rows="10" required="required"></textarea></td>
          </tr>

          <tr>
            <td><b>Action</b></td>
            <td><input type="submit" name="update" class="btn btn-primary" value="Cập nhật">

              <input name="Submit2" type="submit" class="btn btn-danger" value="Đóng" onClick="return f2();" style="cursor: pointer;" />
            </td>
          </tr>
        </table>
      </form>
    </div>

  </body>

  </html>

<?php } ?>