<?php
	session_start();
	if(isset($_SESSION['name'])){
		$nam = $_SESSION['name'];
		include 'connection.php';
		$sql1 = "SELECT * FROM `user` WHERE `name`='" . $nam . "'";
		$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
		$person_list = array();
		if (!$result1){
			echo 'no history for the user';
		}
		else{
			while ($row = mysqli_fetch_array($result1)){
				$sql1 = "SELECT * FROM `relatn` WHERE `uid` = '" . $row[0] . "' AND trackable =1";
				$per_result = mysqli_query($con,$sql1);
				while($rows1 = mysqli_fetch_array($per_result)){
					$sql2 = "SELECT * FROM `person`WHERE `person_id` = '" . $rows1[1] . "'";
					$person_result = mysqli_query($con,$sql2);
					while($row1 = mysqli_fetch_array($person_result)){
						$person_list [] = array($row1[0]=>$row1[1]); 
						
					} 
				}
				
				
				
				/*$sql = "SELECT * FROM `person`WHERE `person_id` = '" . $row[3] . "'";
				$person_result = mysqli_query($con,$sql);
				while($row1 = mysqli_fetch_array($person_result)){
					$person_list [] = array($row1[0]=>$row1[1]); 
						
				}*/				
			
			}
		}
		echo json_encode($person_list);
	}
	
	else{
		echo 'please log in';
	}
?>