<?php
	//check if for the same user there already is request sent
	session_start();
	if (isset($_SESSION['namm']) || isset($_SESSION['idd'])){
		
		$sentTo = (int)$_POST['uuuid'];
		//dont know why but $sentTO not working
		//echo $sentTo;
		//insert the id into 'request_from' in the 'request' table for the 'userid'
		//(which is the user logged in whose id is stored in session
	
		
		$id = $_SESSION['idd'];
		$tme = date("Y-m-d H:i:s");
		
		include 'connection.php';
		
	 	//check if a value already exists in the table and then echo 
	 	//already sent and show likewise in the client side
	 	
	 	$sql2 = "SELECT * FROM `relatn` WHERE `uid` ='" . $id . "' && person_id ='" . $sentTo . "'";
	 	$result2 = mysqli_query($con,$sql2) or die(mysqli_error($con));
	 	$rooow = mysqli_fetch_array($result2);
	 	
	 	
	 	$sql1 = "SELECT * FROM `requests` WHERE `user_id` ='" . $sentTo . "' && `request_from` ='" . $id . "'";
	 	$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
	 	
	 	$roow = mysqli_fetch_array($result1);
	 	if ($rooow){
	 		echo 'al';
	 	}
	 	elseif ($roow){
	 		echo 're';
	 	}
	 	else{
	 		$sql = "INSERT INTO `requests`".
			"(user_id, request_from, action, date)".
			"VALUES".
			"('$sentTo','$id',0,'$tme')";
		
			mysqli_query($con,$sql) or die(mysqli_error($con));	
		
	
			//remove the entry from the suggestion table

			//instead of the person_id and uid work with the suggestion id

			$sqlDeletn = "DELETE FROM `suggestions` WHERE `uid` = '" . $id . 
			"' AND `person_id` = '" . $sentTO . "'"; 
			//echo $sqlDeletn;
			mysqli_query($con,$sqlDeletn) or die(mysqli_error($con));
		
			echo 'yes';
	
	 	}
		
	}
	 
?>