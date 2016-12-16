<?php # Script 10.1 - view_users.php #3
// This script retrieves all the records from the users table.
// This new version links to edit and delete pages.

$page_title = 'View the Current Users';

echo '<h1>Registered Users</h1>';

require ('../includes/mysqli_connect.php');
		
// Define the query:
$q = "SELECT DNI, Name, Surname, Email, TelePhone, role FROM employees ORDER BY DNI";		
$r = @mysqli_query ($dbc, $q);

// Count the number of returned rows:
$num = mysqli_num_rows($r);

if ($num > 0) { // If it ran OK, display the records.

	// Print how many users there are:
	echo "<p>There are currently $num registered users.</p>\n";

	// Table header:
	echo '<link rel="stylesheet" href="../style/users_data.css">
	
	<table id="hor-minimalist-a" align="center">
	<tr>
		<td align="left"><b>Edit</b></td>
		<td align="left"><b>Delete</b></td>
		<td align="left"><b>DNI</b></td>
		<td align="left"><b> Name</b></td>
		<td align="left"><b> Surname</b></td>
		<td align="left"><b> Email</b></td>
		<td align="left"><b> Phone</b></td>
		<td align="left"><b> Role </b></td>		
	</tr>
';
	
	// Fetch and print all the records:
	while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
		echo '<tr>
			<td align="left"><a href="edit_user.php?id=' . $row['user_id'] . '">Edit</a></td>
			<td align="left"><a href="delete_user.php?id=' . $row['user_id'] . '">Delete</a></td>
			<td align="left">' . $row[0] . '</td>
			<td align="left">' . $row[1] . '</td>
			<td align="left">' . $row[2] . '</td>
			<td align="left">' . $row[3] . '</td>
			<td align="left">' . $row[4] . '</td>
			<td align="left">' . $row[5] . '</td>
		</tr>
		';
	}

	echo '</table>';
	mysqli_free_result ($r);	

} else { // If no records were returned.
	echo '<p class="error">There are currently no registered users.</p>';
}

mysqli_close($dbc);


?>