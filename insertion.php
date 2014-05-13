<?php
	include "connection.php";
	$name = $_POST["fname"];
	$phone = $_POST["phone"];
	$pass = $_POST["password"];
	//echo "dhjdsfjkdg";
	
	function cryptPass ($input,$rounds=9){
		$salt = "";
		$saltChars = array_merge(range('A','Z'),range('a','z'),range(0,9));
		for ($i = 0; $i < 22; $i++){
			$salt .=$saltchars[array_rand($saltChars)];
		}
		return crypt ($input, sprintf('$2y$%02d$', $rounds) . $salt);
	}
	
	$hashedPassword = cryptPass($pass);
	
	
	
	
	//find out the highest value in the user table 
	$sql1 = "SELECT MAX( id ) AS max FROM `user`";
	$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
	$roow = mysqli_fetch_array($result1);
	$max_id = (int)$roow['max'];
	$id = $max_id + 1;
	
	//find out the highest value in the person table
	$sql2 = "SELECT MAX( person_id ) AS max FROM `person`";
	$result2 = mysqli_query($con,$sql2) or die(mysqli_error($con));
	$rooow = mysqli_fetch_array($result2);
	$max_iid = (int)$rooow['max'];
	$pid = $max_iid + 1;
	
	
	//if (!$_POST('submit')){
	//	echo "fill the form";
	//	header("Location: index.php");
	//}
	//else{
	
	
	//work on photo upload
		//echo $id;
		
		
		$sql = 
			"INSERT INTO `user` ".
       			"(id,name,password) ".
       			"VALUES ".
       			"('$id','$name','$hashedPassword')";
		mysqli_query($con,$sql);
		
		
		
		
	//also inserting to the person table with the default X,Y, accuracy value and same image link
	//in this case the default location are choosen (26,84) and accuracy value = 5,, but can be taken input 
	//from the user
	
		$sql3 = "INSERT INTO `person` ".
       			"(person_id,name,X_coord,Y_coord,accuracy) ".
       			"VALUES ".
       			"('$pid','$name',26,84,5)";
	
		mysqli_query($con,$sql3);
	
	
	//if want to make visible to himself then insert the person id to the relatn table
		$sql4 = "INSERT INTO `relatn` ".
       			"(uid,person_id,viewable,trackable,date) ".
       			"VALUES ".
       			"('$id','$pid',1,1,NOW())";
		mysqli_query($con,$sql4);
		//echo "inserted to dbase";
		//session_start();
		//$_SESSION['name'] = $name;
		//header("Location:query.php");
	// }
?>