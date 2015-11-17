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
		$group_title = $_POST['group_title'];
		$num_members = $_POST['num_members'];

		//echo $group_title;
		//echo $num_members;

		$sql = "INSERT INTO group_data (classname, group_title, num_members) VALUES ('$class_user', '$group_title', '$num_members')";
		$result = $conn->query($sql);

		if($result == TRUE)
		header("Location: admin.php");

	}


	$conn->close();
?>
