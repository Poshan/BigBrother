<?php
	//dont echo anything other than the json encoded persons with time location data
	$pos = (int)$_POST['pid'];
	$timed = $_POST['timed'];
	$time1 = (int)$_POST['tiime'];
	$times = ($time1*60*60);
	
	// 5 hours and 45 minutes 20700 seconds added to get the UTC
	//times correct!!!
	//Consider the UTC Time is late to phones' time 
	//check if multiplication worked fine
	
	include 'connection.php';
	session_start();
	$nam = $_SESSION['namm'];
	//echo $nam;
	$uid = $_SESSION['idd'];	

	//find the "result_date" which is the date when person accepted the user
	$result_date = '';

	$sql2 = "SELECT * FROM `relatn` WHERE `person_id`='" . $pos . "' && `uid` = '" . $uid . "'";
	
	$result2 = mysqli_query($con,$sql2) or die(mysqli_error($con));
	
	while ($row1 = mysqli_fetch_array($result2)){
		$result_date = $row1[4];
	}
	
	
	//$result_dated = date('y-m-d H:i:s',strtotime($result_date));
	$result_dated = strtotime($result_date);
	
	//echo 'resulted_date' . $result_dated;
	//echo "<br>";
	
	
	$sql1 = "SELECT * FROM `aap` WHERE `pid`='" . $pos . "' ORDER BY `time`";
	$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
	$W = array();
if ($timed == 0){
	while ($row = mysqli_fetch_array($result1)){
		//while row[3] is greater than the result_date
		//$time1 = date('y-m-d H:i:s',strtotime($row[3]));
		$time2 = strtotime($row[3]);
		
		
		//echo 'time in aap' . $time1;
		//echo "<br>";
		
		
		if ($result_dated < $time2){
			$X = $row[1];
			$Y = $row[2];
			$W[] = array($row[3] => array($X,$Y));
		}
	}
	
	echo json_encode($W);	
}


elseif ($timed == 1){
	
	$time_value = $times;
	$time_now = time();
	//no problem with subtraction 
	
	while ($row = mysqli_fetch_array($result1)){
		$time3 = strtotime($row[3]); //same time zone as time()

		/*
		if (($time3 > ($time_now-$time_value))&&( $time3 <= $time_now)&&($result_dated < $time3)){}
		*/
		if (($time3 > ($time_now-$time_value)) && ($result_dated < $time3)){
			$X = $row[1];
			$Y = $row[2];
			$W[] = array($row[3] => array($X,$Y));
		}
	}
	echo json_encode($W);
	
}
?>