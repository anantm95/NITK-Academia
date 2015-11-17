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
		$num_members = $_GET['num_members'];
		$group_id = $_GET['group_id'];
		$topic = $_POST['topic'];
		$member1 = $_POST[0];
		$member2 = $_POST[1];
		$member3 = $_POST[2];
		$member4 = $_POST[3];
		$member5 = $_POST[4];


		if($num_members == 1)
		{
			$sql1 = "INSERT INTO group_members(group_id, topic, member1) VALUES ('$group_id', '$topic', '$member1')";
			$result1 = $conn->query($sql1);

			if($result1 == TRUE)
				header("Location: group_entry.php?group_id=".$group_id."&num_members=".$num_members);
		}

		else if($num_members == 2)
		{
			$sql1 = "INSERT INTO group_members(group_id, topic, member1, member2) VALUES ('$group_id', '$topic', '$member1', '$member2')";
			$result1 = $conn->query($sql1);

			if($result1 == TRUE)
				header("Location: group_entry.php?group_id=".$group_id."&num_members=".$num_members);
		}

		else if($num_members == 3)
		{
			$sql1 = "INSERT INTO group_members(group_id, topic, member1, member2, member3) VALUES ('$group_id', '$topic', '$member1', '$member2', '$member3')";
			$result1 = $conn->query($sql1);

			if($result1 == TRUE)
				header("Location: group_entry.php?group_id=".$group_id."&num_members=".$num_members);
		}
		

		else if($num_members == 4)
		{
			$sql1 = "INSERT INTO group_members(group_id, topic, member1, member2, member3, member4) VALUES ('$group_id', '$topic', '$member1', '$member2', '$member3', '$member4')";
			$result1 = $conn->query($sql1);

			if($result1 == TRUE)
				header("Location: group_entry.php?group_id=".$group_id."&num_members=".$num_members);
		}


		else if($num_members == 5)
		{
			$sql1 = "INSERT INTO group_members(group_id, topic, member1, member2, member3, member4, member5) VALUES ('$group_id', '$topic', '$member1', '$member2', '$member3', '$member4', '$member5')";
			$result1 = $conn->query($sql1);

			if($result1 == TRUE)
				header("Location: group_entry.php?group_id=".$group_id."&num_members=".$num_members);
		}



	}


	$conn->close();
?>
