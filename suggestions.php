<?php

//this page gets the sugggestions from suggestion table......

//need to write in the suggestion table based on the users' nearest locations other users

//update table reularly by replacing the older suggestions
	
	session_start();
	if (isset($_SESSION['namm']) || isset($_SESSION['idd'])){
		$name = $_SESSION['name'];
		$id = (int)$_SESSION['idd'];
		include 'connection.php';
		$sql = "SELECT * FROM `suggestions` WHERE `uid` = '" . $id . "'";
		$result = mysqli_query($con, $sql) or die(mysqli_error($con));
		
		$suggestionList = array();
		while ($row = mysqli_fetch_array($result)){
			$uid = $row[1]; //id of other users 
			$sql2 = "SELECT * FROM `user` WHERE `id` = '" . $uid ."'";
			$result2 = mysqli_query($con, $sql2) or die(mysqli_error($con));
			while ($row2 = mysqli_fetch_array($result2)){
				$iddd = $row2[0];
				$name = $row2[1];
				$image = $row2[3];
				$suggestionList [] = array ($iddd => $name); //array with id and name created
				 
			}	 
		}
		echo json_encode($suggestionList);
		
	}

?>