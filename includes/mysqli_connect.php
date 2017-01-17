<?php
DEFINE ('DB_USER', 'u773614403_jms');
DEFINE ('DB_PASSWORD', 'PHPJMS');
DEFINE ('DB_HOST', 'mysql.hostinger.es');
DEFINE ('DB_NAME', 'u773614403_iaw');

// Make the connection:
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

// Set the encoding...
mysqli_set_charset($dbc, 'utf8');

?>