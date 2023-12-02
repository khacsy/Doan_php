<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

mysqli_query($db,"DELETE FROM `detail_order` WHERE order_id = '".$_GET['order_del']."'");
mysqli_query($db,"DELETE FROM `order` WHERE id = '".$_GET['order_del']."'");
header("location:all_orders.php");
