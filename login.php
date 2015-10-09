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

		if(isset($_POST['submit']))
		{
			$classname = $_POST['classname'];
			$email = $_POST['email'];
			$password =  $_POST['password'];

			$sql1 = "SELECT * FROM user where email = '$email' and classname = '$classname'";
			$result = $conn->query($sql1);

			if($result->num_rows > 0){
				$check = $result->fetch_assoc();
				if($password == $check["password"]){
					$_SESSION['user'] = $check['email'];
					echo "SUCCESSFULLY LOGGED IN";
					echo $_SESSION['user'];
					header("Location: index.php");
				}
				else
			    {
			    ?>
			        <script type="text/javascript">alert('wrong details');</script>
			        <?php
			    }
			 
			}
			else{
				?>
				<script type="text/javascript">alert('Sorry, this User ID does not exist.');</script>
				<?php
			}
		}
		

		$conn->close();
		?>
	</body>
</html>
