<?php
	session_start();

	if (isset($_SESSION['namm']) || isset($_SESSION['idd'])){
		unset($_SESSION['namm']);
		unset($_SESSION['idd']);
		session_destroy();
		header ('Location: http://www.kathmandulivinglabs.org/tracker');
	}
	else{
		echo 'heartbreak warfare';
	}
	
?>