-- EMPLEADOS DEL DEPARTAMENTO.



-- ENSEÑA TODAS LAS TAREAS DEL DEPARTAMENTO

Los usuarios pueden ver las tarea y "precerrarlas" UPTADATE de STATE => "Finished" 

<?php
$page_title = 'View the department tasks';
echo '<h1>Department tasks</h1>';
require ('../includes/mysqli_connect.php');

// Define the select query:
$q = "SELECT ID, Name, Description, Time_Start, Time_Finish, State, Employee, Department FROM tasks ORDER BY ID";		
$r = @mysqli_query ($dbc, $q);

// Count the number of returned rows:
$num = mysqli_num_rows($r);

// If it ran OK, display the records.
if ($num > 0) { 
    // Print how many tasks there are:
	echo "<p>There are currently $num tasks.</p>\n";

    // Table header:
	echo '<link rel="stylesheet" href="../style/users_data.css">
	
	<table id="hor-minimalist-a" align="center">
	<tr>

		<td align="center"><b>ID</b></td>
		<td align="center"><b> Name</b></td>
		<td align="center"><b> Description</b></td>
		<td align="center"><b> Time_Start</b></td>
		<td align="center"><b> Time_Finish</b></td>
		<td align="center"><b> State</b></td>	
        <td align="center"><b> Employee</b></td>	
        <td align="center"><b> Department</b></td>		
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
            <td align="left">' . $row[6] . '</td>
            <td align="left">' . $row[7] . '</td>
		</tr>';
    }
    echo '</table>';
	mysqli_free_result ($r);

}
else { 
    // If no records were returned.
	echo '<p class="error">There are currently no registered tasks.</p>';
}

mysqli_close($dbc);


?>