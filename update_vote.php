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

	$vote_id = $_GET['vote_id'];
	//echo $vote_id;

	if(isset($_POST['submit']))
	{
		
		$chosen_option = $_POST['chosenOption'];

		//echo $chosen_option;

		if($chosen_option == 1)
		{
			$sqlGetCount = "SELECT count1 from vote_counts where vote_id = '$vote_id'";
			$result = $conn->query($sqlGetCount);
			$result_array = $result->fetch_assoc();
			$current_count = $result_array["count1"];

			if($current_count == -1)
			{
				$sqlUpdateCount = "UPDATE vote_counts SET count1 = 1 where vote_id = '$vote_id'";
				$result = $conn->query($sqlUpdateCount);
				
			}
			else
			{
				$sqlUpdateCount = "UPDATE vote_counts SET count1 = count1 + 1 where vote_id = '$vote_id'";
				$result = $conn->query($sqlUpdateCount);
				
			}
		}

		else if($chosen_option == 2)
		{
			$sqlGetCount = "SELECT count2 from vote_counts where vote_id = '$vote_id'";
			$result = $conn->query($sqlGetCount);
			$result_array = $result->fetch_assoc();
			$current_count = $result_array["count2"];

			if($current_count == -1)
			{
				$sqlUpdateCount = "UPDATE vote_counts SET count2 = 1 where vote_id = '$vote_id'";
				$result = $conn->query($sqlUpdateCount);
				
			}
			else
			{
				$sqlUpdateCount = "UPDATE vote_counts SET count2 = count2 + 1 where vote_id = '$vote_id'";
				$result = $conn->query($sqlUpdateCount);
				
			}
		}

		else if($chosen_option == 3)
		{
			$sqlGetCount = "SELECT count3 from vote_counts where vote_id = '$vote_id'";
			$result = $conn->query($sqlGetCount);
			$result_array = $result->fetch_assoc();
			$current_count = $result_array["count3"];

			if($current_count == -1)
			{
				$sqlUpdateCount = "UPDATE vote_counts SET count3 = 1 where vote_id = '$vote_id'";
				$result = $conn->query($sqlUpdateCount);
				
			}
			else
			{
				$sqlUpdateCount = "UPDATE vote_counts SET count3 = count3 + 1 where vote_id = '$vote_id'";
				$result = $conn->query($sqlUpdateCount);
				
			}
		}

		else if($chosen_option == 4)
		{
			$sqlGetCount = "SELECT count4 from vote_counts where vote_id = '$vote_id'";
			$result = $conn->query($sqlGetCount);
			$result_array = $result->fetch_assoc();
			$current_count = $result_array["count4"];

			if($current_count == -1)
			{
				$sqlUpdateCount = "UPDATE vote_counts SET count4 = 1  where vote_id = '$vote_id'";
				$result = $conn->query($sqlUpdateCount);
				
			}
			else
			{
				$sqlUpdateCount = "UPDATE vote_counts SET count4 = count4 + 1 where vote_id = '$vote_id'";
				$result = $conn->query($sqlUpdateCount);
				
			}
		}

		else if($chosen_option == 5)
		{
			$sqlGetCount = "SELECT count5 from vote_counts where vote_id = '$vote_id'";
			$result = $conn->query($sqlGetCount);
			$result_array = $result->fetch_assoc();
			$current_count = $result_array["count5"];

			if($current_count == -1)
			{
				$sqlUpdateCount = "UPDATE vote_counts SET count5 = 1 where vote_id = '$vote_id'";
				$result = $conn->query($sqlUpdateCount);
				
			}
			else
			{
				$sqlUpdateCount = "UPDATE vote_counts SET count5 = count5 + 1 where vote_id = '$vote_id'";
				$result = $conn->query($sqlUpdateCount);
				
			}
		}

		$sqlcheckuser = "INSERT INTO vote_check VALUES ('$vote_id', '$class_user', '$user_email', 1)";
		$resultcheck = $conn->query($sqlcheckuser);


		if($result == TRUE && $resultcheck == TRUE)
		{
			header("Location: cast_vote.php?vote_id=".$vote_id);
		}



		

	}


	$conn->close();
?>
