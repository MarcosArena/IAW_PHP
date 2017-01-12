<?php


session_start(); // Access the existing session.



// If no session variable exists, redirect the user:
if (!isset($_SESSION['dni'])) {

	// Need the functions:
	require ('../includes/functions.php');
	redirect_user('../login.php');	
	
} else { 
		require ('../includes/functions.php');		
		include ('../includes/header.php');
		emplist();

		// Check if the role is "Staff_Manager" and if it is, we show a Create User Button.	
		

}


?>