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
		$q = "SELECT DNI, Name, Code_Dep, role FROM employees WHERE DNI='$e' AND Password='$p'";		
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


//Insert User
function insertUser($dni, $name, $surname, $email, $telephone, $password, $code_dep, $insrole){
	$page_title = 'Insert new employee.';
	require ('../includes/mysqli_connect.php');
	require('../css/styles.css');
		
	// Define the query:
	$q = 	"INSERT INTO `employees`(`DNI`, `Name`, `Surname`, `Email`, `TelePhone`, `Password`, `Code_Dep`, `role`) 
	VALUES ('$dni', '$name', '$surname', '$email', '$telephone', sha1('$password'), $code_dep, '$insrole') ";	

	if (mysqli_query($dbc, $q)) {
    	echo "New record created successfully";
	
	} else {
    	echo "Error: " . $q . "<br>" . mysqli_error($dbc);
	}
	mysqli_close($dbc);
}

//This function lists all registered employees.
function empList(){

	//We capture the Role
	$role = $_SESSION['role'];	
	echo '<h2>Employees list</h2>';

	require ('../includes/mysqli_connect.php');
		
	// Define the query: We select all fields from Employees database.
	$q = 	"SELECT e.DNI, e.Name, e.Surname, e.Email, e.TelePhone, d.Name, e.role FROM employees AS e 
			INNER JOIN department as d 
			ON e.Code_Dep = d.Code ORDER BY e.DNI";	

	$r = @mysqli_query ($dbc, $q);

	// Count the number of returned rows:
	$num = mysqli_num_rows($r);

	if ($num > 0) { // If it ran OK, display the records.

	// Print how many users there are:
	echo "<li>There are currently $num employees.</li>\n";

	// Table header:
	echo '<link rel="stylesheet" href="../style/users_data.css">
	<form method="POST" action="emp_list.php">
	<table id="hor-minimalist-a" align="center">
	';
	//If the user is "staff_manager" we show the Insert user option
	if ($role="staff_manager") {?>
			<td><input type="submit" value="Insert User"  onclick=window.open('./insertuser.php','ventana','width=640,height=600');></td>	
		<?php
		} 
	echo '<td><input type="submit" value="Refresh"></td>
	<tr>		
		<td align="left"><b> DNI </b></td>
		<td align="left"><b> Name </b></td>
		<td align="left"><b> Surname </b></td>
		<td align="left"><b> Email </b></td>
		<td align="left"><b> Phone </b></td>
		<td align="left"><b> Department </b></td>	
		<td align="left"><b> Role </b></td>			
		<td align="right"><b>';  		
		echo '</b></td>
	</tr>';	
	// Fetch and print all the records:
	while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
		echo '<tr>			
			<td align="left">' . $row[0] . '</td>
			<td align="left">' . $row[1] . '</td>
			<td align="left">' . $row[2] . '</td>
			<td align="left">' . $row[3] . '</td>
			<td align="left">' . $row[4] . '</td>
			<td align="left">' . $row[5] . '</td>
			<td align="left">' . $row[6] . '</td>';
			
			$id=$row[0];
			if ($role="staff_manager") {
				//We open a new window, passing the DNI as a GET parameter, we'll us it in the WHERE clause'
				echo '<td align="left"><a href="../menus/emp_edit.php?id=' . $row[0] . '" target="popup">Edit</a></td>';		
		}
			echo '</tr>';
	}
	echo '</table></form>';
	mysqli_free_result ($r);	

	} else { // If no records were returned.
		echo '<p class="error">There are currently no registered users.</p>';
	}
	mysqli_close($dbc);
}// End of empList() function

?>

