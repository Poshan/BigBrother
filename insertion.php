<html>
<body>
<?php
	include "includes/connection.php";
	$name = $_POST["fname"]."<br>";
	$phone = $_POST["phone"];
	echo "dhjdsfjkdg";

/*	if (!$_POST('submit')){
		echo "fill the form";
		header("Location: index.php");
	}
	else{*/
		echo "working dude";
		$sql = "INSERT INTO viewer (`viewer_id`, `viewer_name`, `person_id`) 
				VALUES (NULL, `$name`, `$phone`)";
		mysql_query($sql) or die(mysql_error());
		echo "inserted to dbase";
		header("Location:view.php");
	// }
?>
</body>
</html>