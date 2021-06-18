<?php
	$conn = new mysqli("localhost","b69cf2b2d42fd7","ff4b8b03","heroku_65a889a6296ff12");
	if($conn->connect_error){
		die("Connection Failed!".$conn->connect_error);
	}
?>