<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "supermercat"; 

	$conn = new mysqli($servername, $username, $password, $dbname);
		
	if ($conn->connect_error) {
		die("Error, no s'ha pogut connectar amb la base de dades");
	}
?>