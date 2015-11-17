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

        $vote = array(); 
        $vote_sql = "SELECT * from vote_details where classname = '$class_user'";
        $all_votes = $conn->query($vote_sql);
        while($row = $all_votes->fetch_assoc()) {
            $vote[] = $row;
        }


        if(count($vote) == 0)
            echo "No active votes";
        else
        { 
            for($i=count($vote)-1;$i>=0;$i--) {
                
                echo "<div class='col-lg-6'>
                        <br>
                        <div class='panel panel-primary'>
                            <div class='panel-heading'>
                                <div class='row'>
                                    <div class='col-xs-3'>
                                        <i class='fa fa-comments fa-4x'></i>
                                        </div>
                                        <div class='col-xs-9 text-right'>
                                        
                                        <h4>".$vote[$i]['vote_title']."</h4>
                                    </div>
                                </div>
                            </div>
                            <a href='cast_vote.php?vote_id=".$vote[$i]['vote_id']."'>
                                <div class='panel-footer'>
                                    <span class='pull-left'>Cast your vote</span>
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