<?php 

function redirect_user ($page = 'login.php') {

	// Start defining the URL...
	// URL is http:// plus the host name plus the current directory:
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	
	// Remove any trailing slashes:
	$url = rtrim($url, '/\\');
	
	// Add the page:
	$url .= '/' . $page;
	
	// Redirect the user:
	header("Location: $url");
	exit(); // Quit the script.

} // End of redirect_user() function.

/* This function validates the form data (the email address and password).
 * If both are present, the database is queried.
 * The function requires a database connection.
 * The function returns an array of information, including:
 * - a TRUE/FALSE variable indicating success
 * - an array of either errors or the database result
 */
function check_login($dbc, $dni = '', $pass = '') {

	$errors = array(); // Initialize error array.

	// Validate the email address:
	if (empty($dni)) {
		$errors[] = 'You forgot to enter your ID.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($dni));
	}

	// Validate the password:
	if (empty($pass)) {
		$errors[] = 'You forgot to enter your password.';
	} else {
		$p = mysqli_real_escape_string($dbc, trim($pass));
	}

	if (empty($errors)) { // If everything's OK.

		// Retrieve the user_id and first_name for that email/password combination:
		$q = "SELECT DNI, Name, role FROM employees WHERE DNI='$e' AND Password='$p'";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
		
		// Check the result:
		if (mysqli_num_rows($r) == 1) {			
		session_start();
		
			$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
	
			// Return true and the record:
			return array(true, $row);
			
		} else { // Not a match!
			$errors[] = 'The ID and password entered do not match those on file.';
		}
		
	} // End of empty($errors) IF.
	
	// Return false and the errors:
	return array(false, $errors);

} // End of check_login() function.




//Next and previos month on calendar
 function nextMonth()
{
echo " Next month";
$month= date ("m") + 1;
	$year=date("Y");
	$day=date("d");
	$endDate=date("t",mktime(0,0,0,$month,$day,$year));



return $month;

	

}

 function prevMonth()
{
echo "Prev MOnth";
$month= date ("m") -1;
echo $month;

return $month;
	

}

?>