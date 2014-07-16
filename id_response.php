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
	if (crypt($password_input, $password_from_db) == $password_from_db) 
	{
	
	//get the user id from the db 
	
		$sql1 = "SELECT `id` FROM `user` WHERE `name` ='" . $name . "'";
		$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
	
		if (!result1){ 
			echo 0;
	
		}
		else{
			//also check the authentication credentials
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