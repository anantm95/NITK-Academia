<?php

	session_start();

	$servername = "localhost";
	$username = "root";
	$password = "password";
	$dbname = "academia";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$user_email = $_SESSION['user'];

	$sql1 = "SELECT classname from user where email = '$user_email'";
		$result = $conn->query($sql1);
	$result_array = $result->fetch_assoc();
	$class_user = $result_array["classname"];

	if(isset($_POST['submit']))
	{
		$num_options = $_POST['num_options'];
		$vote_title = $_POST['vote_title'];
	
		$sql1 = "CREATE TABLE vote (vote_id INT auto_increment primary key, classname VARCHAR(15) default ".$class_user.", vote_title VARCHAR(200))";
		$result1 = $conn->query($sql1);
		
	}


	$conn->close();
?>
