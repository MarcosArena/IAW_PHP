<?php

//session_start();
include ('../menus/header.php');

?> 
<link rel="stylesheet" href="../css/bootstrap.css" type="text/css">
<link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="../css/logo-nav.css" type="text/css">
<link rel="stylesheet" href="../css/styles.css" type="text/css">
 <?php
// If no session variable exists, redirect the user:
if (!isset($_SESSION['dni'])) {
	// Need the functions:
	require ('../includes/functions.php');
	redirect_user('../login.php');	
	
} else { 
	require ('../includes/functions.php');		
	if($_SESSION['role']!="staff_manager") {
		redirect_user('./start.php');	
	
	}
		
		//include ('../menus/header.php');
		emplist();
		
		// Check if the role is "Staff_Manager" and if it is, we show a Create User Button.	
		
}
?>