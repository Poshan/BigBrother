<?php
	include "connection.php";
	$name = $_POST["fname"];
	$phone = $_POST["phone"];
	$pass = $_POST["password"];
	//echo "dhjdsfjkdg";

	//find out the highest value in the user table 
	$sql1 = "SELECT MAX( id ) AS max FROM `user`";
	$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
	$roow = mysqli_fetch_array($result1);
	$max_id = (int)$roow['max'];
	$id = $max_id + 1;
	
	
	//if (!$_POST('submit')){
	//	echo "fill the form";
	//	header("Location: index.php");
	//}
	//else{
	
	
	//work on photo upload
		//echo $id;
		
		
		$sql = 
			"INSERT INTO `user` ".
       			"(id,name,password) ".
       			"VALUES ".
       			"('$id','$name','pass')";
		mysqli_query($con,$sql);
		
		//echo "inserted to dbase";
		session_start();
		$_SESSION['name'] = $name;
		header("Location:query.php");
	// }
?>