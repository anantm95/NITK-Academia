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

		echo "hello";
		echo $num_options;
		echo $vote_title;
		$new = $_POST['1'];
		
		for($i=0;$i<$num_options;$i++)
		{
			
		}

		echo $new;
		
	}


	$conn->close();
?>
