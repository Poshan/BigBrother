<?php
	session_start();
	if(isset($_SESSION['name'])){
		echo 'can view following persons';
		echo '<br>';
		$nam = $_SESSION['name'];
		include 'connection.php';
		$sql1 = "SELECT * FROM `user` WHERE `name`='" . $nam . "'";
		$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
		if (!$result1){
			echo 'no history for the user';
		}
		else{
			while ($row = mysqli_fetch_array($result1)){
				$sql = "SELECT * FROM `person`WHERE `person_id` = '" . $row[3] . "'";
				$person_result = mysqli_query($con,$sql);
				
				while($row1 = mysqli_fetch_array($person_result)){
					echo $row1[1];
					echo '<br>';
				}				
			}
		}
	}
	else{
		echo 'please log in';
	}
?>