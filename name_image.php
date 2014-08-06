<?php
  session_start();
  if (isset($_SESSION['namm']) && isset($_SESSION['idd'])){
  	$user_name = $_SESSION['namm'];
  	include 'connection.php';
  	$sql1 = "SELECT * FROM `user` WHERE `name`='" . $_SESSION['namm'] . "'";
  	$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
  	if (!$result1){
  	    echo 'no result';
  	}
  	else{
           while ($roow = mysqli_fetch_array($result1)){
             $img_link = $roow[3];
           } 
  	}
  	$W[] = array($user_name => $img_link);
  	echo (json_encode ($W));
  }
?>