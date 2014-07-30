<?php 
    session_start();
        include "connection.php";
        $_SESSION['name'] = "";
    	$password = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
      $_SESSION['name'] = test_input($_POST["name"]);
      $password = test_input($_POST["password"]);
      // $password = password_encrypter($_POST["password"]);
    }
    function test_input($data)
    {
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }
    // funtion password_encrypter ($data){
    //  //encrypt the password with some algos andord: N then return to store in database
    // }
        //echo $name;

    include "connection.php";
    $sql1 = "SELECT * FROM `user` WHERE `name`='" . $_SESSION['name'] . "'";
    $result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
    $pw = ""; 
    while ($roow = mysqli_fetch_array($result1)){
    	$pw = $roow[2];
    }
    //echo $pw;
    if ($password = $pw) {
    	$sql = "SELECT * FROM `user` WHERE `name`='" . $_SESSION['name'] . "'";
    	$W = array();
        //$_SESSION['W']=array();
        //$W = "";
    	$result = mysqli_query($con, $sql) or die(mysqli_error($con));
        
    	if (!$result){
        	echo "no result";
    	}
    	else {
        	while ($row = mysqli_fetch_array($result)){
                        //$row = mysqli_fetch_array($result);
                        //$_SESSION['W'] = $row[3];
                    
            		$sql = "SELECT * FROM `person`WHERE `person_id` = '" . $row[3] . "'";
                	$person_result = mysqli_query($con,$sql);
                	while($row1 = mysqli_fetch_array($person_result)){
                        	$X = $row1[2]; 
                        	$Y = $row1[3];
                        	$acc = $row1[4];
                        	//$arrayName[] = array($X,$Y);  
                        	//echo $row1[1];
                        	$W[] = array($row1[1] => array($X,$Y,$acc));
                      
                        //echo json_encode($arrayName);     //sent to daaam.php
                	}       
        	}
    	}
       //var_dump ($W);
       //echo '<br>';
      echo json_encode($W);
    
//print_r($arrayName);
}
else{
	//echo 'password doesnot match';
	//take back to the login page
	//echo '<a href = '/user.php'>' . 'goto the login page' . '</a>';
}
?>