<?php

	session_start();

	$servername = "localhost";
	$username = "root";
	$password = "password";
	$dbname = "academia";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	if(isset($POST['submit']))
	{
		$classname = $_POST['classname'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		$sql1 = "SELECT * FROM user where email = '$email' and classname = '$classname'";
		$check_rows = $conn->query($sql1);

		if($check->num_rows > 0) {
			echo "Sorry, this email is already registered with us.";
		}

		else {
			$sql_insert = "INSERT INTO user (classname, email, password) VALUES ('$classname', '$email', '$password');";
			$result = $conn->query($sql_insert);

			if($result == TRUE)
			{
				echo "You have been registered. <br> Welcome to NITK Academia";
			}
		}
	}

	$conn->close();
?>