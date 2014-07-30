<?php
	session_start();
	if (isset($_SESSION['namm']) && isset($_SESSION['idd'])){
		$user_name = $_SESSION['namm'];
		include "connection.php";
	    	$sql1 = "SELECT * FROM `user` WHERE `name`='" . $_SESSION['namm'] . "'";
	    	$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
	    	if (!result1){
	    		echo 'no result';
	    	}
	    	else{
	    		while ($roow = mysqli_fetch_array($result1)){
	    			$img_link = $roow[3];
	    			$sql2 = "SELECT * FROM `relatn` WHERE `uid`='" . $_SESSION['idd'] . "' AND `viewable` = 1";
	                $result2 = mysqli_query($con, $sql2) or die(mysqli_error($con)); 
	                if (!result2){
	                  	echo 'noone to view yet';
	                  }
	                  else{
	                    while ($rows = mysqli_fetch_array($result2)){
	                    	$sql = "SELECT * FROM `person`WHERE `person_id` = '" . $rows[1] . "'";
	                      	$person_result = mysqli_query($con,$sql);
	                      	while($row1 = mysqli_fetch_array($person_result)){
	                            $X = $row1[2]; 
	                            $Y = $row1[3];
	                            $acc = $row1[4];
	                            $imag_link = $row1[5]; 
	                            if ($row1[1] == $user_name){
	                            	$users_location[] = array($row1[1] => array($X,$Y,$acc,$imag_link));
	                            	
	                            }
	                            else{
	                            	
	                            	$W[] = array($row1[1] => array($X,$Y,$acc,$imag_link));
	                            	
	                            }       
	                      	}       
	                    }
	                   
	                  }
	    		}
	    	}
	}
else{
	echo 'not logged in';
}
?>