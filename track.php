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

        $course = array(); 
        $course_sql = "SELECT * from course where classname = '$class_user'";
        $all_courses = $conn->query($course_sql);
        while($row = $all_courses->fetch_assoc()) {
            $course[] = $row;
        }


        if(count($course) == 0)
            echo "No courses have been added";
        else
        { 
            for($i=count($course)-1;$i>=0;$i--) {
                //echo "<div class='col-lg-5' style='background-color:#B1c5cF; margin-right:30px; margin-left:45px; margin-bottom:20px; margin-top:20px; text-align:center;'";
                echo "<div class='col-lg-6'>
                        <br>
                        <div class='panel panel-green'>
                            <div class='panel-heading'>
                                <div class='row'>
                                    <div class='col-xs-3'>
                                        <i class='fa fa-tasks fa-4x'></i>
                                        </div>
                                        <div class='col-xs-9 text-right'>
                                        <div class='huge'>".$course[$i]['course_code']."</div>
                                        <div>".$course[$i]['course_name']."</div>
                                    </div>
                                </div>
                            </div>
                            <a href='test_entry.php?code=".$course[$i]['course_code']."'>
                                <div class='panel-footer'>
                                    <span class='pull-left'>View Details</span>
                                    <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
                                    <div class='clearfix'></div>
                                </div>
                            </a>
                        </div>
                    </div>";
                //echo "<br>";
                //echo "<h3>".$course[$i]['course_code']."</h3>";
                //echo "<h4><a href='course_detail.php?code=".$course[$i]['course_code']."'>".$course[$i]['course_name']."</a></h4>";
                //echo "<br>";
                //echo "</div>";
            }
        }
    
    ?>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
 
<?php endblock() ?>
