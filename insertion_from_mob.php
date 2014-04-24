<?php
	

	//for the insertion of data into the database from the mobile
	//from mobile we get X,Y,accuracy,timestamp,
	//pid,name.
	

	//posts from the phone
	
	// $X = get_from_phone; //X
	// $Y = get_from_phone; //Y
	// $accuracy = get_from_phone; //accuracy
	// $timestamp = get_from_phone; //time
	// $name = get_from_phone; //
	// $id = get_from_phone; //id



//type conversion to do

//trial data
$id = 6;
$X = 277;
$Y = 43;
$accuracy = 6;

	//check if it already exists
	
include "connection.php";
	//update in the person_table
if (!$con){
	echo 'no connection';
}
$sql = "UPDATE `person`
        SET `X_coord` ='" . $X . "', `Y_coord` ='" . $Y . "', `accuracy` ='" . $accuracy . "'" .
        " WHERE `person_id` = '" . $id . "'";

mysqli_query($con,$sql);


	//insert as a new row in the aap table
$sql1 = "INSERT INTO `aap` ".
       "(pid,X,Y,time) ".
       "VALUES ".
       "('$id','$X','$Y','timestamp')";

mysqli_query($con,$sql1);

?>