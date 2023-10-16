<?php
    include("connection/connect.php");
    error_reporting(0);
    session_start();

    $results = array(); // Mảng để lưu kết quả tìm kiếm

    if (isset($_GET['key'])) {
        $key = $_GET['key'];
        $key = mysqli_real_escape_string($db, $key);
        $key = strtolower($key);

        $sql = "SELECT rs_id,title FROM dishes WHERE LOWER(title) LIKE '%" . $key . "%'";
        $result = mysqli_query($db, $sql);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $results[] = $row['title'];
                $rs_id = $row['rs_id'];
                $rs_name_sql = "SELECT title FROM restaurant WHERE rs_id = $rs_id";
                $rs_name_result = mysqli_query($db, $rs_name_sql);
                if ($rs_name_result) {
                    $rs_name_row = mysqli_fetch_assoc($rs_name_result);
                    $results[] = $rs_name_row['title'];
                }
            }
        }
    }

    // Chuyển mảng kết quả thành chuỗi, ngăn cách bằng ', '
    $countSearch = implode(', ', $results);

    echo $countSearch;
?>