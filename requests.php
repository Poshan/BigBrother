<?php
	session_start();
	if(isset($_SESSION['namm'])){
		$nam = $_SESSION['namm'];
		//echo $nam;
		$request_type = $_POST['request_type'];
		include 'connection.php';
		
		$uid = $_SESSION['idd'];
		
		//finding the id of the user use the id a session variable....... 
		//$sql1 = "SELECT id FROM `user` WHERE `name`='" . $nam . "'";
		//$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
		//$uid = '';
		//while ($row = mysqli_fetch_array($result1)){
		//	$uid = $row['id'];
		//}
		
		$uid1 = (int)$uid;
		
		
		
		$sql = "SELECT * FROM `requests` WHERE `user_id`='" . $uid1 . "'AND `action` = '0'";
		//$result = mysqli_result($con,$sql);
		$result = mysqli_query($con,$sql) or die(mysqli_error($con));
		//if the request type is 1
		$request_from = array();
		while ($roow = mysqli_fetch_array($result)){
			$a = $roow[1]; //id of the user sending the request
			$sql2 = "SELECT * FROM `user` WHERE `id`='" . $a . "'";
			//$result2 = mysqli_result($con,$sql2);
			$result2 = mysqli_query($con,$sql2) or die(mysqli_error($con));
			while ($rooow = mysqli_fetch_array($result2)){
				$id = $rooow[0];
				$name = $rooow[1];
				$image =$rooow[3];
				$request_from [] = array ($id => $name);
			}
		}
		echo json_encode($request_from);
		
	}
	else {
	 
	}
	

?>