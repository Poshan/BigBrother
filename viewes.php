<?php
	session_start();
	if(isset($_SESSION['namm'])){
		$nam = $_SESSION['namm'];
		$index = $_POST['index']; //indicates the call from which page 1 is from query and 2 from history
		include 'connection.php';
		$sql1 = "SELECT * FROM `user` WHERE `name`='" . $nam . "'";
		$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
		$viewe_list = array();
		if (!$result1){
			echo 'no such user exists';
		}
		else{
			while ($row = mysqli_fetch_array($result1)){
				$sql1 = "SELECT * FROM `relatn` WHERE `person_id` = '" . $row[0] . "'"; //found out the person
				$per_result = mysqli_query($con,$sql1);
				while($rows1 = mysqli_fetch_array($per_result)){
					$sql2 = "SELECT * FROM `person`WHERE `person_id` = '" . $rows1[0] . "'";
					$person_result = mysqli_query($con,$sql2);
						while($row1 = mysqli_fetch_array($person_result)){
							if ($row1[1] != $nam){
								$viewe_list [] = array($row1[0]=>$row1[1]); 
							}		
						}	
					} 
				}
		}
		echo json_encode($viewe_list);
	}
	
	else{
		echo 'please log in';
	}
?>