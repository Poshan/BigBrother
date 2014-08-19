<?php
        //for local mysql
	// $dbhost="localhost";
	// $dbuser="root@localhost";
	// $dbpass="nahsop";
	// $db = "test123";
	// $con=mysqli_connect($dbhost,$user,$dbpass);
	
	//for 000webhost mysql dbase
	
         
    $mysql_host = "mysql7.000webhost.com";
	$mysql_database = "a8824779_traking";
	$mysql_user = "a8824779_poshan";
	$mysql_password = "poshan123";
	
	$con = mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_database);
    if (mysqli_connect_errno()){
	// echo json_encode('I am done');
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
    	exit();
  	}
    return $con;  
?>