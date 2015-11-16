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

    <div class="row">
        <div class="col-lg-12">
            <h2>Time Table</h2>
            <div class="table-responsive">
            <form method="post" action="set_timetable.php" role="form">
                <table class="table table-bordered table-hover table-striped">
                    <thead style="background-color:#ffffff;">
                        <tr>
                        	<th></th>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>6</th>
                            <th>7</th>
                            <th>8</th>
                        </tr>
                    </thead>
                    <?php 

                    $sql_time_table = "SELECT * FROM time_table WHERE classname = '$class_user'";
                    $tt_result = $conn->query($sql_time_table);
                    $tt_result_assoc = $tt_result->fetch_assoc();

                    echo "<tbody>
                        <tr class='success'>
                            <td><b>Monday</b></td>
                            <td style='width:100px;'><input type='text' name='mon1' value=".$tt_result_assoc["mon1"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='mon2' value=".$tt_result_assoc["mon2"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='mon3' value=".$tt_result_assoc["mon3"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='mon4' value=".$tt_result_assoc["mon4"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='mon5' value=".$tt_result_assoc["mon5"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='mon6' value=".$tt_result_assoc["mon6"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='mon7' value=".$tt_result_assoc["mon7"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='mon8' value=".$tt_result_assoc["mon8"]." style='width:80px;'></td>
                        </tr>
                        <tr class='warning'>
                            <td><b>Tuesday</b></td>
                            <td style='width:100px;'><input type='text' name='tue1' value=".$tt_result_assoc["tue1"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='tue2' value=".$tt_result_assoc["tue2"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='tue3' value=".$tt_result_assoc["tue3"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='tue4' value=".$tt_result_assoc["tue4"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='tue5' value=".$tt_result_assoc["tue5"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='tue6' value=".$tt_result_assoc["tue6"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='tue7' value=".$tt_result_assoc["tue7"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='tue8' value=".$tt_result_assoc["tue8"]." style='width:80px;'></td>
                        </tr>
                        <tr class='danger'>
                            <td><b>Wednesday</b></td>
                            <td style='width:100px;'><input type='text' name='wed1' value=".$tt_result_assoc["wed1"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='wed2' value=".$tt_result_assoc["wed2"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='wed3' value=".$tt_result_assoc["wed3"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='wed4' value=".$tt_result_assoc["wed4"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='wed5' value=".$tt_result_assoc["wed5"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='wed6' value=".$tt_result_assoc["wed6"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='wed7' value=".$tt_result_assoc["wed7"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='wed8' value=".$tt_result_assoc["wed8"]." style='width:80px;'></td>
                        </tr>
                        <tr class='warning'>
                            <td><b>Thursday</b></td>
                            <td style='width:100px;'><input type='text' name='thu1' value=".$tt_result_assoc["thu1"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='thu2' value=".$tt_result_assoc["thu2"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='thu3' value=".$tt_result_assoc["thu3"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='thu4' value=".$tt_result_assoc["thu4"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='thu5' value=".$tt_result_assoc["thu5"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='thu6' value=".$tt_result_assoc["thu6"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='thu7' value=".$tt_result_assoc["thu7"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='thu8' value=".$tt_result_assoc["thu8"]." style='width:80px;'></td>
                        </tr>
                        <tr class='success'>
                            <td><b>Friday</b></td>
                            <td style='width:100px;'><input type='text' name='fri1' value=".$tt_result_assoc["fri1"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='fri2' value=".$tt_result_assoc["fri2"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='fri3' value=".$tt_result_assoc["fri3"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='fri4' value=".$tt_result_assoc["fri4"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='fri5' value=".$tt_result_assoc["fri5"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='fri6' value=".$tt_result_assoc["fri6"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='fri7' value=".$tt_result_assoc["fri7"]." style='width:80px;'></td>
                            <td style='width:100px;'><input type='text' name='fri8' value=".$tt_result_assoc["fri8"]." style='width:80px;'></td>
                        </tr>
                    </tbody>" ?>
                </table>
                <button type="submit" name="submit" id="submit" class="btn btn-success" style="width:150px; float:right"; >Save</button>
            </form>
            </div>
        </div>

        <div class="col-lg-12">
        <br>
        <h2>Courses &nbsp;&nbsp;<a class="btn btn-primary" href="new_course.php">Add Course</a></h2>
        <br>
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
                echo "<div class='col-lg-5' style='background-color:#B1c5cF; margin-right:30px; margin-left:45px; margin-bottom:20px; margin-top:20px; text-align:center;'";
                echo "<br>";
                echo "<h3>".$course[$i]['course_code']."</h3>";
                echo "<h4><a href='course_admin.php?code=".$course[$i]['course_code']."'>".$course[$i]['course_name']."</a></h4>";
                echo "<br>";
                echo "</div>";
            }
            }

        ?>
        </div>

        <div class="col-lg-12">
            
            <div class="col-lg-5" style="margin-right:30px; margin-left:45px; margin-bottom:20px; margin-top:20px; text-align:center;">

            <h3>Admins</h3>
                <?php 
                    $admin = array(); 
                    $admin_sql = "SELECT email from admin where classname = '$class_user'";
                    $all_admins = $conn->query($admin_sql);
                    while($row = $all_admins->fetch_assoc()) {
                        $admin[] = $row;
                    }

                    for($i=count($admin)-1;$i>=0;$i--) {
                        echo $admin[$i]['email'];
                        echo "<br>";
                    }
                ?>
                <br>
                <a href="new_admin.php" class="btn btn-primary">Add admin</a>
            
            </div>

            <div class="col-lg-5" style="margin-right:30px; margin-left:45px; margin-bottom:20px; margin-top:20px; text-align:center;">                        
            
            <h3> General Announcements </h3>
            <a class="btn btn-primary" href="new_announcement.php">Add announcement</a>

            <h3>Voting</h3>
            <a class="btn btn-primary" href="new_vote_step1.php">Set Up a Vote</a>

            </div>
        </div>
        </div>
    </div>
    <!-- /.row -->
<?php endblock() ?>