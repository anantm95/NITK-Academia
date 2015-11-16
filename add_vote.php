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
		$num_options = $_POST['num_options'];
		$vote_title = $_POST['vote_title'];
		$option1 = $_POST[0];
		$option2 = $_POST[1];
		$option3 = $_POST[2];
		$option4 = $_POST[3];
		$option5 = $_POST[4];


		if($num_options == 1)
		{
			$sql1 = "INSERT INTO vote_details(vote_title, classname, option1) VALUES ('$vote_title', '$class_user', '$option1')";
			$result1 = $conn->query($sql1);

			if($result1 == TRUE)
				header("Location: admin.php");
		}
		
		else if($num_options == 2)
		{
			$sql2 = "INSERT INTO vote_details(vote_title, classname, option1, option2) VALUES ('$vote_title', '$class_user', '$option1', '$option2')";
			$result2 = $conn->query($sql2);

			if($result2 == TRUE)
				header("Location: admin.php");
		}

		else if($num_options == 3)
		{
			$sql3 = "INSERT INTO vote_details(vote_title, classname, option1, option2, option3) VALUES ('$vote_title', '$class_user', '$option1', '$option2', '$option3')";
			$result3 = $conn->query($sql3);

			if($result3 == TRUE)
				header("Location: admin.php");
		}

		else if($num_options == 4)
		{
			$sql4 = "INSERT INTO vote_details(vote_title, classname, option1, option2, option3, option4) VALUES ('$vote_title', '$class_user', '$option1', '$option2', '$option3', '$option4')";
			$result4 = $conn->query($sql4);

			if($result4 == TRUE)
				header("Location: admin.php");
		}

		else if($num_options == 5)
		{
			$sql5 = "INSERT INTO vote_details(vote_title, classname, option1, option2, option3, option4, option5) VALUES ('$vote_title', '$class_user', '$option1', '$option2', '$option3', '$option4', '$option5')";
			$result5 = $conn->query($sql5);

			if($result5 == TRUE)
				header("Location: admin.php");
		}


	}


	$conn->close();
?>
