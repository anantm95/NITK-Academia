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

	if(isset($_POST['submit']))
	{
		$classname = $_POST['classname'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		$sql1 = "SELECT * FROM user where email = '$email'";
		$check_rows = $conn->query($sql1);

		if($check_rows->num_rows > 0) {
			echo "Sorry, this email is already registered with us.";
		}

		$sql2 = "SELECT * FROM class WHERE classname = '$classname'";
		$check_rows = $conn->query($sql2);

		if($check_rows->num_rows > 0) {
			echo "Sorry, this class is already registered with us. Please choose another name.";
		}

		else {
			$sql_insert1 = "INSERT INTO class (classname) VALUES ('$classname')";
			$result1 = $conn->query($sql_insert1);

			$sql_insert2 = "INSERT INTO admin (classname, email) VALUES ('$classname', '$email')";
			$result2 = $conn->query($sql_insert2);

			$sql_insert3 = "INSERT INTO user (classname, email, password) VALUES ('$classname', '$email', '$password')";
			$result3 = $conn->query($sql_insert3);

			if($result1 == TRUE && $result2 == TRUE && $result3 == TRUE) 
			{
				echo "You have been registered. <br> Welcome to NITK Academia";
			}
		}
	}

	$conn->close();
?>