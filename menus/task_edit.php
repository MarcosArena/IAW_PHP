<html>
<head>
</head>
<body>
<style type="text/css">
.form-style-1 {
    margin:10px auto;
    max-width: 400px;
    padding: 20px 12px 10px 20px;
    font: 13px "Lucida Sans Unicode", "Lucida Grande", sans-serif;
}
.form-style-1 li {
    padding: 0;
    display: block;
    list-style: none;
    margin: 10px 0 0 0;
}
.form-style-1 label{
    margin:0 0 3px 0;
    padding:0px;
    display:block;
    font-weight: bold;
}
.form-style-1 input[type=text], 
.form-style-1 input[type=date],
.form-style-1 input[type=datetime],
.form-style-1 input[type=number],
.form-style-1 input[type=search],
.form-style-1 input[type=time],
.form-style-1 input[type=url],
.form-style-1 input[type=email],
textarea, 
select{
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    border:1px solid #BEBEBE;
    padding: 7px;
    margin:0px;
    -webkit-transition: all 0.30s ease-in-out;
    -moz-transition: all 0.30s ease-in-out;
    -ms-transition: all 0.30s ease-in-out;
    -o-transition: all 0.30s ease-in-out;
    outline: none;  
}
.form-style-1 input[type=text]:focus, 
.form-style-1 input[type=date]:focus,
.form-style-1 input[type=datetime]:focus,
.form-style-1 input[type=number]:focus,
.form-style-1 input[type=search]:focus,
.form-style-1 input[type=time]:focus,
.form-style-1 input[type=url]:focus,
.form-style-1 input[type=email]:focus,
.form-style-1 textarea:focus, 
.form-style-1 select:focus{
    -moz-box-shadow: 0 0 8px #88D5E9;
    -webkit-box-shadow: 0 0 8px #88D5E9;
    box-shadow: 0 0 8px #88D5E9;
    border: 1px solid #88D5E9;
}
.form-style-1 .field-divided{
    width: 49%;
}
.form-style-1 .field-long{
    width: 100%;
}
.form-style-1 .field-select{
    width: 100%;
}
.form-style-1 .field-textarea{
    height: 100px;
}
.form-style-1 input[type=submit], .form-style-1 input[type=button]{
    background: #4B99AD;
    padding: 8px 15px 8px 15px;
    border: none;
    color: #fff;
}
.form-style-1 input[type=submit]:hover, .form-style-1 input[type=button]:hover{
    background: #4691A4;
    box-shadow:none;
    -moz-box-shadow:none;
    -webkit-box-shadow:none;
}
.form-style-1 .required{
    color:red;
}
</style>
<?php
session_start();
require ('../includes/mysqli_connect.php');
require('../includes/functions.php');
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
     // The request is using the POST method
     $IdEdit = $_GET['id'];
     $q = "SELECT t.ID,t.Name,t.Description,t.Time_Start,t.Time_Finish,t.State,t.Employee,d.Name FROM tasks AS t 
     INNER JOIN department as d  ON t.Department = d.Code
     WHERE t.ID = '$IdEdit'";	
$r = @mysqli_query ($dbc, $q);
// Count the number of returned rows:
$num = mysqli_num_rows($r);
if ($num > 0) { // If it ran OK, display the records.
	// Fetch and print all the records:
	while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
                $id = $row[0];
				$name = $row[1];
                $description = $row[2];
                $time_start = $row[3];
                $time_finish = $row[4];
                $status = $row[5];
                $employee = $row[6];
                $department = $row[7];
    }
}
?> 


    
    <?php echo '<form method="POST" action="./task_edit.php" >
        <ul class="form-style-1">
            <label>Id </label>
            <input type="text" name="id" class="field-divided" value="' . $id . '" readonly="readonly" />
        </li>
        <li>
            <label>Name <span class="required">*</span></label>
            <input type="text" name="name" class="field-divided" value="' . $name . '" />
        </li>
        <li>
            <label>Description <span class="required">*</span></label>
            <input type="text" name="description" class="field-divided"  value="' . $description . '"  />
        </li>
        <li>
            <label>Time Start</label>
            <input type="datetime" name="timestart" class="field-divided"  value="' . $time_start . '" readonly="readonly" />
        </li>
        <li>
            <label>Time Finish</label>
            <input type="datetime" name="timefinish" class="field-divided"  value="' . $time_finish . '" readonly="readonly" />
        </li>
        <li>
            <label>Status</label>
            <input type="text" name="status" class="field-divided"  value="' . $status . '" readonly="readonly" />
        </li>
        <li>
            <label>Department</label>
            <input type="text" name="department" class="field-divided"  value="' . $department . '" readonly="readonly" />
        </li>
        
    ' ;
    ?>  
    <li>
        <?php
            $dep = $_SESSION['code_dep'];
            //Select for get the information
            $qs="SELECT DNI, Name FROM `employees` WHERE Code_Dep = $dep";
            $r = @mysqli_query ($dbc, $qs);
            echo '<label>Employee <span class="required">*</span></label>';
            echo '<select name="Name_Employee" class="field-select">';
            foreach ($r as $row) {
	            echo '<option value="' .$row["DNI"] .'">' . $row["Name"] . '</option>';
	        }
            echo '</select>'; 
            ?>
    </li> 
    <li>
        <input type="submit" value="Submit" />
    </li>
</ul>
</form>

<?php
}
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
     //check the name
    if (empty($_POST['name'])) {
		$errors[] = 'You forgot to enter the name of the task.';
	} else {
		$name = mysqli_real_escape_string($dbc, trim($_POST['name']));
	}
	
	// Check for a description
	if (empty($_POST['description'])) {
		$errors[] = 'You forgot to enter the description.';
	} else {
		$description = mysqli_real_escape_string($dbc, trim($_POST['description']));
	}
    $codeemployee = $_POST['Name_Employee'];
    $id = $_POST['id'];
	if (empty($errors)) { // If everything's OK.

			// Make the query:
			$q = "UPDATE tasks SET Name='$name', Description='$description', Employee='$codeemployee' WHERE ID='$id' LIMIT 1";
			$r = @mysqli_query ($dbc, $q);
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
				// Print a message:
				echo "<script>window.close();</script>";	
                header("location:./see_tasks.php");
				
			} else { // If it did not run OK.
				echo '<p class="error">The task could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
				echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
			}
				

		
	} else { // Report the errors.
		echo '<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p>';
	
	} // End of if (empty($errors)) IF.
} // End of submit condition
   
       
    
?>
</body>
</html>