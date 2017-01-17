<?php
	//incluir header
	include ('./header.php');
// If no session variable exists, redirect the user:
if (!isset($_SESSION['dni'])) {
	// Need the functions:
	require ('../includes/functions.php');
	redirect_user('../login.php');	
	
} 
else { 

	$role=$_SESSION['role'];
	$dept=$_SESSION['code_dep'];


	
	//Start web
	$page_title = 'View the department tasks';
	echo '<h1>Department tasks</h1>';
	require ('../includes/mysqli_connect.php');

		
	// Define the select query:
	$q = "SELECT t.ID, t.Name, t.Description, t.Time_Start, t.Time_Finish, t.State, e.Name, d.Name, d.Code FROM tasks AS t 
		  INNER JOIN department as d  ON t.Department = d.Code
		  INNER JOIN employees as e on t.Employee = e.DNI WHERE d.Code = $dept
		  ORDER BY t.ID";		
	$r = @mysqli_query ($dbc, $q);
	// Count the number of returned rows:
	$num = mysqli_num_rows($r);
	// If it ran OK, display the records.
	if ($num > 0) { 
		echo "<p>There are currently $num tasks.</p>\n";
		if($role="dep_boss"){
		//If the role is Dep_boss, we allow him to insert a new task.
		 ?>
			<td><input type="submit" value="Insert Task"  onclick=window.open('./inserttask.php','ventana','width=640,height=600');></td>
			<?php
	}
		if ($role="dep_boss"){
			//The Dep Boss is authorized to delete and close definitly the tasks
			
			// Table header:
			echo '<link rel="stylesheet" href="../style/users_data.css">
			
			<table id="hor-minimalist-a" align="center">';
			echo '<td><input type="submit" value="Refresh"></td>
			<tr>
				<td align="center"><b>ID</b></td>
				<td align="center"><b> Name</b></td>
				<td align="center"><b> Description</b></td>
				<td align="center"><b> Time_Start</b></td>
				<td align="center"><b> Time_Finish</b></td>
				<td align="center"><b> State</b></td>	
				<td align="center"><b> Employee</b></td>	
				<td align="center"><b> Department</b></td>
				<td align="center"><b>Close Task</b></td>
				<td align="center"><b> Delete Task</b></td>	
				<td align="center"><b> Edit</b></td>		
			</tr>';
			// Fetch and print all the records:
			while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
				if('Pending' == $row[5]){
					echo '<tr>
					<td align="center">' . $row[0] . '</td>
					<td align="left">' . $row[1] . '</td>
					<td align="left">' . $row[2] . '</td>
					<td align="left">' . $row[3] . '</td>
					<td align="left">' . $row[4] . '</td>
					<td align="left">' . $row[5] . '</td>
					<td align="left">' . $row[6] . '</td>
					<td align="left">' . $row[7] . '</td>
					<td align="left"><a href="confirm_close_task.php?id=' . $row[0] . '">Confirm Close</a></td>
					<td align="left"><a href="delete_task.php?id=' . $row[0] . '">Delete Task</a></td>
					<td align="left"><a href="task_edit.php?id=' . $row[0] . '">Edit</a></td>
				</tr>';
				}
				elseif ('Finished' == $row[5]){
					echo '<tr>
					<td align="center">' . $row[0] . '</td>
					<td align="left">' . $row[1] . '</td>
					<td align="left">' . $row[2] . '</td>
					<td align="left">' . $row[3] . '</td>
					<td align="left">' . $row[4] . '</td>
					<td align="left">' . $row[5] . '</td>
					<td align="left">' . $row[6] . '</td>
					<td align="left">' . $row[7] . '</td>
					<td align="left"></td>
					<td align="left"><a href="delete_task.php?id=' . $row[0] . '">Delete Task</a></td>
					<td align="left"><a href="task_edit.php?id=' . $row[0] . '">Edit</a></td>
				</tr>';
				}
				else{
					echo '<tr>
					<td align="center">' . $row[0] . '</td>
					<td align="left">' . $row[1] . '</td>
					<td align="left">' . $row[2] . '</td>
					<td align="left">' . $row[3] . '</td>
					<td align="left">' . $row[4] . '</td>
					<td align="left">' . $row[5] . '</td>
					<td align="left">' . $row[6] . '</td>
					<td align="left">' . $row[7] . '</td>
					<td align="left"><a href="edit_status_tasks.php?id=' . $row[0] . '">Close Task</a></td>
					<td align="left"><a href="delete_task.php?id=' . $row[0] . '">Delete Task</a></td>
					<td align="left"><a href="task_edit.php?id=' . $row[0] . '">Edit</a></td>
				</tr>';
				}
			}
		}
		else{
				//all the users
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
				<td align="center"><b>Close Task</b></td>		
			</tr>';
			// Fetch and print all the records:
			while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
				if('Pending' == $row[5]){
					echo '<tr>
					<td align="center">' . $row[0] . '</td>
					<td align="left">' . $row[1] . '</td>
					<td align="left">' . $row[2] . '</td>
					<td align="left">' . $row[3] . '</td>
					<td align="left">' . $row[4] . '</td>
					<td align="left">' . $row[5] . '</td>
					<td align="left">' . $row[6] . '</td>
					<td align="left">' . $row[7] . '</td>
				</tr>';
				}
				elseif ('Finished' == $row[5]){
					echo '<tr>
					<td align="center">' . $row[0] . '</td>
					<td align="left">' . $row[1] . '</td>
					<td align="left">' . $row[2] . '</td>
					<td align="left">' . $row[3] . '</td>
					<td align="left">' . $row[4] . '</td>
					<td align="left">' . $row[5] . '</td>
					<td align="left">' . $row[6] . '</td>
					<td align="left">' . $row[7] . '</td>
				</tr>';
				}
				else{
					echo '<tr>
					<td align="center">' . $row[0] . '</td>
					<td align="left">' . $row[1] . '</td>
					<td align="left">' . $row[2] . '</td>
					<td align="left">' . $row[3] . '</td>
					<td align="left">' . $row[4] . '</td>
					<td align="left">' . $row[5] . '</td>
					<td align="left">' . $row[6] . '</td>
					<td align="left">' . $row[7] . '</td>
					<td align="left"><a href="edit_status_tasks.php?id=' . $row[0] . '">Close Task</a></td>
				</tr>';
				}
			}
			echo '</table>';
			mysqli_free_result ($r);
		}
		}
		
else { 
		// If no records were returned.
		echo '<p class="error">There are currently no registered tasks.</p>';
	}
	mysqli_close($dbc);
}
?>