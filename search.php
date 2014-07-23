<?php
//connect with database
//dont include the persons already in connection
include "connection.php";
$term = trim(strip_tags($_GET['term']));//retrieve the search term that autocomplete sends

$qstring = "SELECT name as value,person_id FROM person WHERE name LIKE '%".$term."%'";
$result = mysqli_query($con,$qstring);//query the database for entries containing the term

while ($row = mysqli_fetch_array($result))//loop through the retrieved values
{
		$row['value']=htmlentities(stripslashes($row['value']));
		$row['id']=(int)$row['person_id'];
		$row_set[] = $row;//build an array
}
echo json_encode($row_set);//format the array into json data
?>