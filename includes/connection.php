<?php
	$dbhost="localhost";
	$dbuser="root";
	$dbpass="nahsop";
	$db = "test123";
	$conn = mysql_connect($dbhost,$user, $dbpass);
	mysql_select_db($db);
	echo "connected";
?>