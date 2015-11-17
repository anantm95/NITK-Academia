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

    if(!isset($_SESSION['user']))
    {
        header("Location: login.html");
    }
    $user_email = $_SESSION['user'];

    $sql1 = "SELECT classname from user where email = '$user_email'";
    $result = $conn->query($sql1);
    $result_array = $result->fetch_assoc();
    $class_user = $result_array["classname"];

    $sql2 = "SELECT email from admin where classname = '$class_user' and email = '$user_email'";
    $result2 = $conn->query($sql2);
    if($result2->num_rows > 0)
        $is_admin = 1;
    else
        $is_admin = 0;

    $group_id = $_GET['group_id'];
    $num = $_GET['num_members'];

?>

<?php include 'base.php' ?>

<?php startblock('body') ?>

        <br>
        <div class="col-md-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Enter your group details</h3>
                </div>
                <div class="panel-body">
                    <?php echo"<form role='form' action = 'group_update.php?group_id=".$group_id."&num_members=".$num."' method='post'>"; ?>
                        <fieldset>
                            <div class="form-group">
                                <label for="inputtopic">Topic</label>
                                <input class="form-control" placeholder="Please enter your selected" name="topic" type="text">
                            </div>
                            <?php

                                for($i=0;$i<$num;$i++)
                                { ?>
                                <div class="form-group">
                                <label>Member <?php echo $i+1 ?></label>
                                <?php echo "<input class='form-control' placeholder='Please enter member details' name=".$i." type='text'>" ?>
                                </div>
                            <?php } ?>

                            <button type="submit" id="submit" name="submit" class="btn btn-lg btn-success btn-block">Save</button>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>

    <div class="col-lg-8">
    <?php

        $member = array(); 
        $data_sql = "SELECT * from group_data NATURAL JOIN group_members where group_id = '$group_id'";
        $all_data = $conn->query($data_sql);
        while($row = $all_data->fetch_assoc()) {
            $member[] = $row;
        }

        for($i=0;$i<count($member);$i++)
        {
            echo $member[$i]['topic'];
            if($member[$i]['member1'] != NULL)   
                echo $member[$i]['member1'];

            if($member[$i]['member2'] != NULL)   
                echo $member[$i]['member2'];

            if($member[$i]['member3'] != NULL)   
                echo $member[$i]['member3'];

            if($member[$i]['member4'] != NULL)   
                echo $member[$i]['member4'];

            if($member[$i]['member5'] != NULL)   
                echo $member[$i]['member5'];

        }
    ?>
    </div>

    <br><br><br><br><br>

<?php endblock() ?>
