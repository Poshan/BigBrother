<?php
	
	//authenticate the user and then sets the session variables
	session_start();
	include 'connection.php';
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$name_input = test_input($_POST['name']);
		$password_input = test_input($_POST['pwd']);
	}
	
	function test_input($data)
    {
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }
   
	$query_for_the_user = "SELECT * FROM `user` WHERE `name` = '" . $name_input . "'";
	$result_of_user = mysqli_query($con, $query_for_the_user) or die(mysql_query($con));
	while ($rows = mysqli_fetch_array($result_of_user)){
		$password_from_db = $rows[2];
		$user_id = $rows[0];
	}
	

//check if the input password is same as the one in the dbase_close(dbase_identifier)
	if (crypt($password_input, $password_from_db) == $password_from_db) {
		//set the session variables namm and id and use them to check in the rest of page
		//better way is to use a randomized token rather than the usee's credentials

		$_SESSION['namm'] = $name_input;
		$_SESSION['idd'] = $user_id;
		header('Location: query_mod.php');  // redirect to the query.php

	}








?>