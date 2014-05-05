<?php
	//get the username and password,authenticate and then respond back to the android phone with user id
	
	
	$name = $_POST['name']; //from phone
	$pass = $_POST['password']; //from phone
	//$name = "poshan";
	
	//authentication to be done........and theen send the reply that they are 
	
	
	
	//get the user id from the db 
	include 'connection.php';
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
?>