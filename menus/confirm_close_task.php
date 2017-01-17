<?php

session_start(); // Access the existing session.
// If no session variable exists, redirect the user:
if (!isset($_SESSION['dni'])) {
	// Need the functions:
	require ('../includes/functions.php');
	redirect_user('../login.php');	
	
} 
else { 
	$page_title = 'Close Definitely the task';
	echo '<h1>Close Definitely the task</h1>';


	// Check for a valid task ID, through GET Method:
	//From see_tasks.php
	if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { 
		$id = $_GET['id'];
	} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
		$id = $_POST['id'];
	} else { // No valid ID, kill the script.
		echo '<p class="error">This page has been accessed in error.</p>';
		exit();
	}

	require ('../includes/mysqli_connect.php');

	// Check if the form has been submitted:
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		//Update the record
		if ($_POST['sure'] == 'Yes') { 
			
			// Make the query:
			$q = "UPDATE tasks SET State='Finished' WHERE id=$id LIMIT 1";		
			$r = @mysqli_query ($dbc, $q);
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

				// Print a message and start the count redireccion
				ob_start(); 
				header("refresh: 3; url = see_tasks.php"); 
				echo '<p>The task is closing...</p>';
				echo 'Wait a moment...'; 

				ob_end_flush();
					

			} else { // If the query did not run OK.
				echo '<p class="error">The user could not be close task to a system error.</p>'; // Public message.
				echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
			}
		
		} else { // No confirmation of deletion.
			echo '<p>The task has NOT been closing.</p>';	
		}

	} else { // Show the form.

		// Retrieve the task information:
		$q = "SELECT ID, Name, Description, Time_Start, Time_Finish, State, Employee, Department FROM tasks WHERE id=$id";		
		$r = @mysqli_query ($dbc, $q);

		if (mysqli_num_rows($r) == 1) { // Valid task ID, show the form.

			// Get the task information:
			$row = mysqli_fetch_array ($r, MYSQLI_NUM);
			
			// Display the record being closed:
			echo "<h3>Name: $row[1]</h3>
			
			Are you sure you want to end this task?";
			
			// Create the form:
			echo '<form action="confirm_close_task.php" method="post">
		<input type="radio" name="sure" value="Yes" /> Yes 
		<input type="radio" name="sure" value="No" checked="checked" /> No
		<input type="submit" name="submit" value="Submit" />
		<input type="hidden" name="id" value="' . $id . '" />
		</form>';
		
		} else { // Not a valid task ID.
			echo '<p class="error">This page has been accessed in error.</p>';
		}

	} // End of the main submission conditional.

	mysqli_close($dbc);
}	
?>
