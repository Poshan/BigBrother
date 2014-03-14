<?php 
	//now query for the persons the user can view
	// echo 'wait a while i am working in it';
	
	// define variables and set to empty values
	$name = "";
	$password = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
	  $name = test_input($_POST["name"]);
	  $password = test_input($_POST["password"]);
	  // $password = password_encrypter($_POST["password"]);
	}
	function test_input($data)
	{
	   $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
	// funtion password_encrypter ($data){
	// 	//encrypt the password with some algos andord: N then return to store in database
	// }
    echo $name;
    include "connection.php";
	$sql = 'SELECT * 
			FROM  `user` 
			WHERE  `name` =  $name
			LIMIT 0 , 30'
	;
	$result = mysql_query($con,$sql);
	if (!$result){
		echo 'no result';
	}
	else {
		while ($row = mysqli_fetch_array($result)){
			$row = mysqli_fetch_array($result);
			$W = $row[3];
			echo $W;		
		}
	}
?>