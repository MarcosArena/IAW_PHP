<?php # Script 12.1 - login_page.inc.php
// This page prints any errors associated with logging in
// and it creates the entire login page, including the form.

// Include the header:
$page_title = 'Login';
//include ('includes/header.html');

// Print any error messages, if they exist:

// Display the form:
?>  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600'>

      <link rel="stylesheet" href="style/bootstrap.css">
	  

 <head> 
</head>

<body>

<form method="POST">
  <div class="login-wrap">
	<div class="login-html">		
		<div class="login-form">		
				<div class="group">
					<label for="dni" class="label">DNI</label>
					<input type="text" name="dni" class="input" />
					
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" name="pass" type="password" class="input" data-type="password">
				</div>
				
				<div class="group">
					<input type="submit" class="button" value="Log In">
				</div>	
				<div> <font color = "red"	>
				<?php if (isset($errors) && !empty($errors)) {
					echo '<h1>Error!</h1>
							<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) {
		echo " - $msg<br />\n";
	}
	echo '</p><p>Please try again.</p>';
}

?>
</div>		
			</div>		
	</div>
</div>
</form>

<?php include ('includes/footer.html'); ?>