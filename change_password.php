<!DOCTYPE html>
<html>
    <body>
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

			$sqlOldPassword = "SELECT password FROM user WHERE email = '$email";
			$result = $conn->query($sqlOldPassword);

			$resultAssoc = $result->fetch_assoc();
			$actualPassword = $resultAssoc["password"];

			if($actualPassword == $oldPass)
			{
				if($newPass == $confirmNewPass)
				{
					$sqlUpdate = "UPDATE user SET password = '$newPass' WHERE email = '$email'";
				}

				else
				{
					?>
			        <script type="text/javascript">alert('Passwords do not match.');</script>
			        <?php
				}
			}

			else
			{
				?>
			        <script type="text/javascript">alert('Enter correct current password.');</script>
			        <?php
			}
		}
		
		$conn->close();
		?>
	</body>
</html>