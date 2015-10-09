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
		$email = $_POST['email'];

		$sql1 = "SELECT * FROM user where classname='$class_user' and email='$email'";
		$check = $conn->query($sql1);

		if(!$check->num_rows > 0)
			echo "The specified user does not belong to your class";

		else {
			$sql2 = "INSERT INTO admin (classname, email) VALUES ('$class_user', '$email')";
			$result = $conn->query($sql2);

			if($result == TRUE)
			header("Location: admin.php");
		}
	}


	$conn->close();
?>
