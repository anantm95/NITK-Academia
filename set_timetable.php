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
		$mon1 = $_POST['mon1'];
		$mon2 = $_POST['mon2'];
		$mon3 = $_POST['mon3'];
		$mon4 = $_POST['mon4'];
		$mon5 = $_POST['mon5'];
		$mon6 = $_POST['mon6'];
		$mon7 = $_POST['mon7'];
		$mon8 = $_POST['mon8'];

		$tue1 = $_POST['tue1'];
		$tue2 = $_POST['tue2'];
		$tue3 = $_POST['tue3'];
		$tue4 = $_POST['tue4'];
		$tue5 = $_POST['tue5'];
		$tue6 = $_POST['tue6'];
		$tue7 = $_POST['tue7'];
		$tue8 = $_POST['tue8'];

		$wed1 = $_POST['wed1'];
		$wed2 = $_POST['wed2'];
		$wed3 = $_POST['wed3'];
		$wed4 = $_POST['wed4'];
		$wed5 = $_POST['wed5'];
		$wed6 = $_POST['wed6'];
		$wed7 = $_POST['wed7'];
		$wed8 = $_POST['wed8'];

		$thu1 = $_POST['thu1'];
		$thu2 = $_POST['thu2'];
		$thu3 = $_POST['thu3'];
		$thu4 = $_POST['thu4'];
		$thu5 = $_POST['thu5'];
		$thu6 = $_POST['thu6'];
		$thu7 = $_POST['thu7'];
		$thu8 = $_POST['thu8'];

		$fri1 = $_POST['fri1'];
		$fri2 = $_POST['fri2'];
		$fri3 = $_POST['fri3'];
		$fri4 = $_POST['fri4'];
		$fri5 = $_POST['fri5'];
		$fri6 = $_POST['fri6'];
		$fri7 = $_POST['fri7'];
		$fri8 = $_POST['fri8'];

		echo $fri8;

		$sql1 = "INSERT INTO time_table (classname, mon1, mon2, mon3, mon4, mon5, mon6, mon7, mon8, tue1, tue2, tue3, tue4, tue5, tue6, tue7, tue8, wed1, wed2, wed3, wed4, wed5, wed6, wed7, wed8, thu1, thu2, thu3, thu4, thu5, thu6, thu7, thu8, fri1, fri2, fri3, fri4, fri5, fri6, fri7, fri8) VALUES ('$class_user', '$mon1', '$mon2', '$mon3', '$mon4', '$mon5', '$mon6', '$mon7', '$mon8', '$tue1', '$tue2', '$tue3', '$tue4', '$tue5', '$tue6', '$tue7', '$tue8', '$wed1', '$wed2', '$wed3', '$wed4', '$wed5', '$wed6', '$wed7', '$wed8', '$thu1', '$thu2', '$thu3', '$thu4', '$thu5', '$thu6', '$thu7', '$thu8', '$fri1', '$fri2', '$fri3', '$fri4', '$fri5', '$fri6', '$fri7', '$fri8')";

		$result=$conn->query($sql1);  

		if($result == TRUE)
		{
			header("Location: admin.php");
		}
		else
		echo "hello";
	}


	$conn->close();
?>
