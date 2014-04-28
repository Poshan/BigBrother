<?php
	//dont echo anything other than the json encoded persons with time location data
	$pos = (int)$_POST['pid'];
	$timed = $_POST['timed'];
	$time1 = (int)$_POST['tiime'];
	$times = $time1*60*60;
	
	
	include 'connection.php';
	session_start();
	$nam = $_SESSION['namm'];
	//echo $nam;
	$uid = $_SESSION['idd'];
	//echo $uid;
	
	
	//get uid from hte name !#$%^&$%$#@!#$% rather store the id in the session variable




	
	//$sql3 = "SELECT * FROM `user` WHERE `name`='" . $nam . "'";
	//$result3 = mysqli_query($con,$sql3) or die(mysqli_error($con));
	//while ($row3 = mysqli_fetch_array($result3)){
	//	$uid = $row3[0];
	//}
	//echo $uid;
	
	
	//find the "result_date" which is the date when person accepted the user
	$result_date = '';

	$sql2 = "SELECT * FROM `relatn` WHERE `person_id`='" . $pos . "' && `uid` = '" . $uid . "'";
	
	$result2 = mysqli_query($con,$sql2) or die(mysqli_error($con));
	
	while ($row1 = mysqli_fetch_array($result2)){
		$result_date = $row1[4];
	}
	
	//echo $result_date;
	//$result_int = (int)$result_date;
	//echo $result_int;
	//$result_dated = strtotime($result_date);
	
	
	//echo $result_date;
	//echo "<br>";
	
	
	//$result_dated = date('y-m-d H:i:s',strtotime($result_date));
	$result_dated = strtotime($result_date);
	
	
	//echo 'resulted_date' . $result_dated;
	//echo "<br>";
	
	
	$sql1 = "SELECT * FROM `aap` WHERE `pid`='" . $pos . "'";//&& DATE(time) >= '" . $result_dated . "'"; //and date > result_dated
	$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
	$W = array();
if ($timed == 0){
	
	while ($row = mysqli_fetch_array($result1)){
		//while row[3] is greater than the result_date
		//$time1 = date('y-m-d H:i:s',strtotime($row[3]));
		$time1 = strtotime($row[3]);
		
		
		//echo 'time in aap' . $time1;
		//echo "<br>";
		
		
		if ($result_dated < $time1){
			$X = $row[1];
			$Y = $row[2];
			$W[] = array($row[3] => array($X,$Y));
		}
	}
	
	echo json_encode($W);	
}


else{
	$time_value = $times;
	$time_now = time();
	
	while ($row = mysqli_fetch_array($result1)){
		$time1 = strtotime($row[3]);
		
		if (($time1 > ($time_now-$time_value))&&( $time1 <=$time_now)&&($result_dated < $time1)){
			$X = $row[1];
			$Y = $row[2];
			$W[] = array($row[3] => array($X,$Y));
		}
		
	}
	
	echo json_encode($W);
}
?>