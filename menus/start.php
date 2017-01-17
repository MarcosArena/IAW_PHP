
<html>
<head>
<?php 
 
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    }  // Start the session.
include ('./header.php');

?>
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/logo-nav.css" rel="stylesheet">
<link href="css/bootstrap.css" rel="stylesheet">


<?php

// If no session value is present, redirect the user:
if (!isset($_SESSION['dni'])) {

	// Need the functions:
	require ('../includes/functions.php');
	redirect_user();	

}

else {

    // Set the page title 
$dni = $_SESSION['dni'];
$name = $_SESSION['name'];
$role = $_SESSION['role'];
$dep = $_SESSION['code_dep'];

$page_title = 'Logged In!';


//We check the user ROLE

  

// Print a customized message:
echo "<h1>Logged In!</h1>
<p>Welcome $name, you are now logged in. Your DNI is: $dni and your role is $role $dep</p>";

}



include ('../includes/footer.html');
?>





