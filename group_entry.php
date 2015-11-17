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
                                <input class="form-control" placeholder="Please enter your selected topic" name="topic" type="text">
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

        $sqlTitle = "SELECT group_title from group_data where group_id = '$group_id'";
        $result = $conn->query($sqlTitle);
        $result_array = $result->fetch_assoc();
        $group_title = $result_array['group_title'];
        ?>

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i><b><?php echo " ".$group_title; ?></b></h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead style="background-color:#ffffff;">
                            <tr>
                                <th>Topic</th>
                                <?php 
                                    for($i=0;$i<$num;$i++)
                                    {
                                        $count = $i+1;
                                        echo "<th>Member ".$count."</th>";
                                    }
                                ?>

                            </tr>
                        </thead>
                        <?php  

                        echo "<tbody>";
                        for($i=0;$i<count($member);$i++)
                        {
                            echo"<tr>";
                                echo "<td>".$member[$i]['topic']."</td>";
                                if($member[$i]['member1'] != NULL)   
                                    echo "<td>".$member[$i]['member1']."</td>";
                                if($member[$i]['member2'] != NULL)   
                                    echo "<td>".$member[$i]['member2']."</td>";
                                if($member[$i]['member3'] != NULL)   
                                    echo "<td>".$member[$i]['member3']."</td>";
                                if($member[$i]['member4'] != NULL)   
                                    echo "<td>".$member[$i]['member4']."</td>";
                                if($member[$i]['member5'] != NULL)   
                                    echo "<td>".$member[$i]['member5']."</td>";
                            echo "</tr>";
                        }

                        echo"</tbody>"
                        ?>
                    </table>
                </div>
            </div>
            </div>
        </div>
    </div>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php endblock() ?>
