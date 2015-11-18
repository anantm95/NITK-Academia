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
		$num = $_POST['num_options'];
		
	}

?>

<?php include 'base_dialog.php' ?>

<?php startblock('body') ?>

    <div class="container">
        <div style="margin-top:50px;" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Set Up Vote</h3>
                </div>
                <div class="panel-body">
                    <form role="form" action = "add_vote.php" method="post">
                        <fieldset>
                        	
                            <div class="form-group">
                                <label for="inputtitle">Vote Title</label>
                                <input class="form-control" placeholder="Please enter the vote title" name="vote_title" type="text">
                            </div>
                            <?php
                            	for($i=0;$i<$num;$i++)
                            	{ ?>
                            	<div class="form-group">
                            	<label>Option <?php echo $i+1 ?></label>
                            	<?php echo "<input class='form-control' placeholder='Please enter option description' name=".$i." type='text'>" ?>
                            	</div>
                            <?php } ?>

                          	<div class="form-group">
                        		<?php  echo "<input class='form-control' name='num_options' type='hidden' value=".$num.">" ?>
                        	</div>

                            <button type="submit" id="submit" name="submit" class="btn btn-lg btn-success btn-block">Save</button>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php endblock() ?>