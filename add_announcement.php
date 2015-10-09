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

		$user_email = $_SESSION['user'];

    	$sql1 = "SELECT classname from user where email = '$user_email'";
   		$result = $conn->query($sql1);
    	$result_array = $result->fetch_assoc();
    	$class_user = $result_array["classname"];

		if(isset($_POST['submit']))
		{
			$announcement = $_POST['ann'];


			$sql1 = "INSERT INTO announcement (classname, announcement) VALUES ('$class_user', '$announcement')";
			$result = $conn->query($sql1);

			if(result == TRUE)
			header("Location: admin.php");
			
		}
		

		$conn->close();
		?>
	</body>
</html>
