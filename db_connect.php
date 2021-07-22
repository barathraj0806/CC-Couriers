<?php 
	// connect to the database
	$conn = mysqli_connect('localhost', 'Barathraj', 'Barath@2001', 'cc_couriers');
	// check connection
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}
?>