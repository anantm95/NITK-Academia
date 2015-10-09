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

		else {
			$sql2 = "SELECT * from class where classname = '$classname'";
			$check_rows2 = $conn->query($sql2);

			if(!$check_rows2->num_rows > 0)
				echo "This class does not exist. Confirm the class name with your representative";

			else
			{
				$sql_insert = "INSERT INTO user (classname, email, password) VALUES ('$classname', '$email', '$password')";
				$result = $conn->query($sql_insert);

				if($result == TRUE)
				{
					echo "You have been registered. <br> Welcome to NITK Academia";
				}

				else
				{
					echo "Fail";
				}
			}
		}
	}

	$conn->close();
?>