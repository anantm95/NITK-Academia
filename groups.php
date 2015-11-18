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

?>

<?php include 'base.php' ?>

<?php startblock('body') ?>

    <?php

        $group = array(); 
        $group_sql = "SELECT * from group_data where classname = '$class_user'";
        $all_groups = $conn->query($group_sql);
        while($row = $all_groups->fetch_assoc()) {
            $group[] = $row;
        }


        if(count($group) == 0)
            echo "No active votes";
        else
        { 
            for($i=count($group)-1;$i>=0;$i--) {
                
                echo "<div class='col-lg-6'>
                        <br>
                        <div class='panel panel-success'>
                            <div class='panel-heading'>
                                <div class='row'>
                                    <div class='col-xs-3'>
                                        <i class='fa fa-support fa-4x'></i>
                                        </div>
                                        <div class='col-xs-9 text-right'>
                                        
                                        <h4>".$group[$i]['group_title']."</h4>
                                    </div>
                                </div>
                            </div>
                            <a href='group_entry.php?group_id=".$group[$i]['group_id']."&num_members=".$group[$i]['num_members']."'>
                                <div class='panel-footer'>
                                    <span class='pull-left'>Form your group</span>
                                    <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
                                    <div class='clearfix'></div>
                                </div>
                            </a>
                        </div>
                    </div>";

            }
        }
    
    ?>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php endblock() ?>