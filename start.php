
<html>
<head>

<?php 

session_start(); // Start the session.

// If no session value is present, redirect the user:
if (!isset($_SESSION['dni'])) {

	// Need the functions:
	require ('includes/functions.php');
	redirect_user();	

}

// Set the page title and include the HTML header:
$dni = $_SESSION['dni'];
$name = $_SESSION['name'];
$role = $_SESSION['role'];

$page_title = 'Logged In!';


//We check the user ROLE
if ($role == "big_boss") {
    include ('includes/header_boss.html');    
    
}

if ($role == "dep_boss") {
    include ('includes/header_dep_boss.html');
}

if ($role =="employee") {
    include('includes/header_emp.html');
}


// Print a customized message:



echo "<h1>Logged In!</h1>
<p>Welcome $name, you are now logged in. Your DNI is: $dni and your role is $role</p>";


include ('includes/footer.html');
?>





