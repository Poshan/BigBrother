<?php
	session_start();
	if(isset($_SESSION['namm'])){
		$nam = $_SESSION['namm']; 
		$req_id = $_POST['req_id'];
		$action = (int)$_POST['action']; //0 if rejected to be ......done........
		// action = 1 if the user accepts the call 
		$id = $_SESSION['idd'];
		
		include 'connection.php';
		
		//finding out the user's id //use the id also as session variable
		//$sql1 = "SELECT id FROM `user` WHERE `name`='" . $nam . "'";
		//$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
		//$row = mysqli_fetch_array($result1);
		//$id = $row[0];
		
		
		//finding the request and writing in the action field of the relatn 
		
		$sql = "UPDATE `requests`
       			 SET `action` ='" . $action . "'" 		
       			 ." WHERE `user_id` = '" . $id . "'AND `request_from` = '" . $req_id . "'";
       			 
       		mysqli_query($con,$sql);
		
		
		if ($action == 1){
			//insert into the relatn table
			
			//check if the column exists already
			
			$tme = date("Y-m-d H:i:s");
			$sql3 = "INSERT INTO `relatn` ".
       				"(uid,person_id,viewable,trackable,date) ".
       				"VALUES ".
       				"('$id','$req_id',1,1,'$tme')";
			mysqli_query($con,$sql3);
			echo 'yes'; // successfull
		}
		elseif ($action == 2){
			echo 'no';
			
		}
	}
?>