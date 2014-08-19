<?php
	//get the username and password,authenticate and then respond back to the android phone with user id
	
	include 'connection.php';
	$name_input = $_POST['name']; //from phone
	$pass = $_POST['password']; //from phone
	//$name = "poshan";
	
	//authentication to be done........and theen send the reply that they are 
	$password_input = $pass;
	
	$query_for_the_user = "SELECT * FROM `user` WHERE `name` = '" . $name_input . "'";
	$result_of_user = mysqli_query($con, $query_for_the_user) or die(mysql_query($con));
	while ($rows = mysqli_fetch_array($result_of_user)){
		$password_from_db = $rows[2];
		$user_id = $rows[0];
	}
	if (md5($password_input) == $password_from_db){ 
		$sql1 = "SELECT `id` FROM `user` WHERE `name` ='" . $name_input . "'";
		$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
	
		if (!result1){ 
			echo 0;
		}
		else{
			while($row = mysqli_fetch_array($result1)){
				$id = $row['id'];
			}
			echo $id;
		}
	}
	else{
		echo 0;
	}
?>