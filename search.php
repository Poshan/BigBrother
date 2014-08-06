<?php
//connect with database
//dont include the persons already in connection
include "connection.php";
session_start();
$term = trim(strip_tags($_GET['term']));//retrieve the search term that autocomplete sends
$user_namm = $_SESSION['namm'];
$qstring = "SELECT name as value,person_id FROM person WHERE name LIKE '%".$term."%'";
$result = mysqli_query($con,$qstring);//query the database for entries containing the term

while ($row = mysqli_fetch_array($result))//loop through the retrieved values
{
		//check if the user name is his/her own
	if (strcmp($row['value'], $user_namm) == 0){
		//$row['value']=htmlentities(stripslashes($row['value']));
		$row['value']= '(me)';
		$row['id']=(int)$row['person_id'];
		$row_set[] = $row;//build an array
	}
	//elseif ($row['value'] != $user_namm){
	elseif (strcmp($row['value'], $user_namm) !== 0){
		//$row['value']= 'byaak';
		$row['value']=htmlentities(stripslashes($row['value']));
		$row['id']=(int)$row['person_id'];
		$row_set[] = $row;//build an array
	}
}
echo json_encode($row_set);//format the array into json data
?>