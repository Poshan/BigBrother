<?php
	

	//for the insertion of data into the database from the mobile


	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		if ((!empty($_POST['id'])) && (!empty($_POST['name'])) && (!empty($_POST['accuracy'])) && (!empty($_POST['timestamp'])) && (!empty($_POST['X'])) && (!empty($_POST['Y']))){
			$id = $_POST['id'];
			$name = $_POST['name'];
			$accuracy = $_POST['accuracy'];
			$timestamp = $_POST['timestamp'];
			$X = $_POST['X'];
			$Y = $_POST['Y'];
			
			if ($id != 0){
				insertion($id, $name, $accuracy, $timestamp, $X, $Y);
			}
		}
		else{
			$msg = 'something is missing';
			echo $msg;
		}
	}

//type conversion to do

//check if it already exists

function insertion ($idd, $namee, $accuracyy, $timestampp, $XX, $YY){
	include "connection.php";
	//update in the person_table
	
	$timee = date('Y-m-d H:i:s',strtotime($timestampp));
	if (!$con){
		echo 'no connection';
	}
	else{
		$sql = "UPDATE `person`
	        SET `X_coord` ='" . $XX . "', `Y_coord` ='" . $YY . "', `accuracy` ='" . $accuracyy . "' , `location_time` ='" . $timee ."'" . 
	        " WHERE `person_id` = '" . $idd . "'";
	
		mysqli_query($con,$sql) or die(mysql_error($con));
	
	
	//insert as a new row in the aap table
	
		$sql1 = "INSERT INTO `aap` ".
		       "(pid,X,Y,time) ".
		       "VALUES ".
		       "('$idd','$XX','$YY','$timee')";
		
		mysqli_query($con,$sql1) or die(mysqli_error($con));
		
		if (mysqli_error($con)){
			echo 'sorry';
		}	
		else{
			echo 'insertion successful';
		}	
	}		
}
	
?>