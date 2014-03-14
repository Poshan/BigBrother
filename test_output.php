<?php
	include "includes/connection.php";
	$sql = "SELECT * FROM `person`";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	echo "NAME".$row['person_name'];
?>