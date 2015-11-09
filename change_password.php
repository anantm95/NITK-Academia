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

	$email = $_SESSION['user'];

	if(isset($_POST['submit']))
	{
		$oldPass = $_POST['oldPassword'];
		$newPass = $_POST['newPassword'];
		$confirmNewPass =  $_POST['confirmNewPassword'];

		$sqlOldPassword = "SELECT password FROM user WHERE email = '$email'";
		$result = $conn->query($sqlOldPassword);

		$resultAssoc = $result->fetch_assoc();
		$actualPassword = $resultAssoc["password"];

		if($actualPassword == $oldPass)
		{
			if($newPass == $confirmNewPass)
			{
				$sqlUpdate = "UPDATE user SET password = '$newPass' WHERE email = '$email'";
				$resultUpdate = $conn->query($sqlUpdate);

				if($resultUpdate == TRUE)
				{
					header("Location: index.php");
				}
			}

			else
			{
				echo "Passwords do not match.";
			}
		}

		else
		{
			echo "Entered current password is incorrect.";
		}
	}

	$conn->close();
?>
