<?php
	$pos = (int)$_POST['pid'];
	include 'connection.php';
	$sql1 = "SELECT * FROM `aap` WHERE `pid`='" . $pos . "'";
	//$sql1 = "SELECT * FROM `aap` WHERE `pid`='1'";
	$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
	$W = array();
	while ($row = mysqli_fetch_array($result1)){
		
		$X = $row[1];
		$Y = $row[2];
		$W[] = array($row[3] => array($X,$Y));
	}
	echo json_encode($W);
	//echo ($W);
?>