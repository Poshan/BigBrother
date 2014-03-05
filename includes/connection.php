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
	
	$con = mysqli_connect($mysql_host,$mysql_user,$mysql_password);
	
        
    $Name = '';
    if (mysqli_connect_errno()){
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
	else{
		//for localhost db
		// mysqli_select_db($db);
		
		//for 000webhost dbase
		mysqli_select_db($con,$mysql_database);
		// $sql = 'SELECT * FROM person';
		$result = mysqli_query($con, 'SELECT * FROM  `person`');
		if (! $result){
			echo "u r dude";
		}
		else{
			while($row = mysqli_fetch_array($result)){
				$row = mysqli_fetch_array($result);
				$Name = $row['person_name'];
				echo $Name; //sent to daaam.php
			}
		}
		
	}	
?>
<?php mysqli_close($con);?>