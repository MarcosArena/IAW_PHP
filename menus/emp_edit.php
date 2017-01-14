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
     $dniEdit = $_GET['id'];
     $q = "SELECT `DNI`,`Name`,`Surname`,`Email`,`TelePhone`,`Password`,`Code_Dep`,`role` FROM employees WHERE DNI = '$dniEdit'";	
$r = @mysqli_query ($dbc, $q);

// Count the number of returned rows:
$num = mysqli_num_rows($r);

if ($num > 0) { // If it ran OK, display the records.


	// Fetch and print all the records:
	while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {

                $dni = $row[0];
				$name = $row[1];
                $surname = $row[2];
                $email = $row[3];
                $telephone = $row[4];
    }

}






?> 


    
    <?php echo '<form method="POST" action="./emp_edit.php" >
        <ul class="form-style-1">
        <li><label>Full Name <span class="required">*</span></label><input type="text" name="name" class="field-divided" value="' . $name . '" />
        <input type="text" name="surname" class="field-divided"  value="' . $surname . '"  /></li>
        <li>
        <label>DNI <span class="required">*</span></label>
        <input type="text" name="dni" class="field-long"  value="' . $dni . '" />
    </li>
    <li>
        <label>Email <span class="required">*</span></label>
        <input type="email" name="email" class="field-long" value="' . $email . '"/>
    </li>
    '
        ;
        //<p>First Name: <input type="text" name="first_name" size="15" maxlength="15" placeholder="' . $name . '" /></p>';


    ?>
    

    
    
    <li>
        <label>Telephone <span class="required">*</span></label>
        <input type="number_format" name="telephone" class="field-long" />
    </li>
    <li>
        <label>Department</label>
        <select name="code_dep" class="field-select">
        <option value="2">Tecnology</option>
        <option value="3">Accounting</option>
        <option value="4">Sales</option>
        <option value="5">Purchases</option>
        </select>
    </li>
    <li>
    
        <label>Role</label>
        <select name="role" class="field-select">
        <option value="dep_boss">Department Boss</option>
        <option value="employee">Employee</option>
        
        </select>
    </li>
    
    <li>
        <label>Password <span class="required">*</span></label>
        <input type="password" name="password" class="field-long" />
    </li>
    
    <li>  
    <li>
        <input type="submit" value="Submit" />
    </li>
</ul>
</form>

<?php

}

 if($_SERVER['REQUEST_METHOD'] == 'POST'){

if (empty($_POST['name'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$name = mysqli_real_escape_string($dbc, trim($_POST['name']));
	}
	
	// Check for a last name:
	if (empty($_POST['surname'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$surname = mysqli_real_escape_string($dbc, trim($_POST['surname']));
	}

	// Check for an email address:
	if (empty($_POST['dni'])) {
		$errors[] = 'You forgot to enter your DNI.';
	} else {
		$dni = mysqli_real_escape_string($dbc, trim($_POST['dni']));
	}
	
      if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$email = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}

    if (empty($_POST['telephone'])) {
		$errors[] = 'You forgot to enter your phone number.';
	} else {
		$telephone = mysqli_real_escape_string($dbc, trim($_POST['telephone']));
	}

    $code_dep = $_POST['code_dep'];
    $role = $_POST['role'];
    $password = $_POST['password'];

	if (empty($errors)) { // If everything's OK.
	
		//  Test for unique email address:
		$q = "SELECT DNI FROM employees WHERE DNI='$dni' AND Email != $email";
		$r = @mysqli_query($dbc, $q);
		if (mysqli_num_rows($r) == 0) {

			// Make the query:
			$q = "UPDATE employees SET Name='$name', Surname='$surname', Email='$email', Telephone=$telephone,
            Password=sha1('$password'), Code_Dep=$code_dep, role='$role'  WHERE DNI='$dni' LIMIT 1";
			$r = @mysqli_query ($dbc, $q);
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

				// Print a message:
				echo "<script>window.close();</script>";	
                header("location:./emp_list.php");
				
			} else { // If it did not run OK.
				echo '<p class="error">The user could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
				echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
			}
				
		} else { // Already registered.
			echo '<p class="error">The email address has already been registered.</p>';
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