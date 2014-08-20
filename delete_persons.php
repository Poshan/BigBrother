<?php
	//this page is created for the deletion of the user who we are viewing me
	//or no more wants them to view my location
	//stop them from viewing my location
	

	//start session
	//include connection
	include 'connection.php';
	session_start();
	//step1
	//get the user id from the session 
	$my_id =  $_SESSION['idd'];
	//step2
	//get the person id from the client side
	$id_of_person_viewing_me = $_POST['pid']; 
	//remove this relation from relation table and also the request table
	
	//remove from relation where uid = $id_of_person_viewing_me and person_id = $my_id
	$query = "DELETE FROM `relation` WHERE `uid` = '" . $id_of_person_viewing_me . "' && `person_id` = '" . $my_id . "'";
	mysqli_query($con,$query) or die(mysqli_error($con));
	
	//remove from request user_id = $my_id and request_from = $id_of_person_viewing_me
	$query1 = "DELETE FROM `request` WHERE `user_id` = '" . $my_id . "' && `request_from` = '" . $id_of_person_viewing_me . "'";
	mysqli_query($con,$query) or die(mysqli_error($con));

?>