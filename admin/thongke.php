<?php
	include("../connection/connect.php");
	require('../arst/carbon/Carbon.php');
	use Carbon\Carbon;
	$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

    if(isset($_POST['thoigian'])){
    	$thoigian = $_POST['thoigian'];
	}else{
		$thoigian = '';
		$subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();	
	}

   
    if($thoigian=='7ngay'){
    	$subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
	}elseif($thoigian=='28ngay'){
    	$subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(28)->toDateString();
	}elseif($thoigian=='365ngay'){
		$subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();	
	}

    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString(); 
    $sql = "SELECT * FROM statistical WHERE date BETWEEN '$subdays' AND '$now' ORDER BY date ASC" ;
    $sql_query = mysqli_query($db,$sql);
	$chart_data = [];
    while($val = mysqli_fetch_array($sql_query)){

    	$chart_data[] = array(
	        'date' => $val['date'],
	        'sales' => number_format($val['price'], 0, '.', ',') . 'đ',
            'order' => $val['oder'],
	        'quantity' => $val['quantity']

    	);
    }
   
  	// print_r($chart_data);
    echo $data = json_encode($chart_data);
   
?>