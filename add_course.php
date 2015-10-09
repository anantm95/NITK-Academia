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
		$course_code = $_POST['course_code'];
		$course_name = $_POST['course_name'];


		$sql1 = "INSERT INTO course (classname, course_code, course_name) VALUES ('$class_user', '$course_code', '$course_name')";
		$result = $conn->query($sql1);

		if(result == TRUE)
		header("Location: admin.php");
		
	}


	$conn->close();
?>
