<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

if (isset($_GET['user_upd'])) {
    $user_id = $_GET['user_upd'];
    

    $sql = "UPDATE restaurant SET status = 'ok' WHERE rs_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $user_id);
    
    if ($stmt->execute()) {
       
        header("Location: confirm_addrestaurant.php");
        exit();
    } else {
      
        echo "Cập nhật không thành công.";
    }
}

?>
