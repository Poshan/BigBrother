<?php
	session_start();
	include 'connection.php';
	if (isset($_SESSION['namm']) || isset($_SESSION['idd'])){
		
		unset($_SESSION['namm']);
		unset($_SESSION['idd']);
		session_destroy();
		header ('Location: index.php');
	}
	else{
		echo 'not logged in';
	}
	mysqli_close($con);
	
?>