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

    $code = $_GET['code'];
    
    $sql1 = "SELECT course_name from course where course_code = '$code'";
    $result = $conn->query($sql1);
    $result_assoc = $result->fetch_assoc();

    $course_name = $result_assoc["course_name"];

    echo "<h2>".$code." - ".$course_name."</h2>"; echo "<br>" ?>

    <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Announcements</h3>
                </div>
                <div class="panel-body">
                    <div class="list-group">

                    <?php

                        $course_ann = array(); 
                        $course_ann_sql = "SELECT * from course_announcement where course_code = '$code'";
                        $all_course_ann = $conn->query($course_ann_sql);
                        while($row = $all_course_ann->fetch_assoc()) {
                            $course_ann[] = $row;
                        }

                        for($i=0;$i<count($course_ann);$i++) {
                            echo "<div href='#' class='list-group-item'>
                            <span class='badge'>just now</span>
                            <i class='fa fa-fw fa-check'></i>"." ".$course_ann[$i]['announcement']."</div>";
                            echo "<br>";
                        }
                    
                    ?>
                        
                    </div>
                    <div class="text-right">
                        <a href="#">View All Announcements <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php endblock() ?>