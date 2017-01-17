<?php # Script 12.8 - login.php #3
// This page processes the login form submission.
// The script now uses sessions.

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Need two helper files:
	require ('./includes/functions.php');
	require ('./includes/mysqli_connect.php');
		
	// Check the login WITH SHA1 :
	$pass =  SHA1($_POST['pass']);
	list ($check, $data) = check_login($dbc, $_POST['dni'], $pass);
	
	if ($check) { // OK!
		
		// Set the session data:
		session_start();
		$_SESSION['dni'] = $data['DNI'];
		$_SESSION['pass'] = $data['Password'];
		$_SESSION['name'] = $data['Name'];
		$_SESSION['role'] = $data['role'];
		$_SESSION['code_dep'] = $data['Code_Dep'];
		
			
		// Redirect:
		redirect_user('./menus/start.php');
			
	} else { // Unsuccessful!

		// Assign $data to $errors for login_page.inc.php:
		$errors = $data;

	}
		
	mysqli_close($dbc); // Close the database connection.

} // End of the main submit conditional.

// Create the page:
include ('includes/login_page.inc.php');

?>