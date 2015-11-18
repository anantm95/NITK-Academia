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
		$course_code = $_GET['course_code'];
		$testname = $_POST['testname'];
		$marks_obt = $_POST['marks_obt'];
		$marks_total = $_POST['marks_total'];
		$percentage = ($marks_obt/$marks_total)*100;

		$sqlUpdate = "INSERT INTO test_data VALUES ('$course_code', '$user_email', '$testname', '$marks_obt', '$marks_total', '$percentage')";
		$resultUpdate = $conn->query($sqlUpdate);

		if($resultUpdate == TRUE)
			header("Location: test_entry.php?code=".$course_code);
	}
?>