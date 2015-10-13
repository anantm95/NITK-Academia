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

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>NITK Academia</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">NITK Academia</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li> 
                    <a> Welcome, <?php echo $user_email; ?> </a>
                <li>    
                <a href="logout.php">Sign Out</a>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Home</a>
                    </li>
                    <li>
                        <a href="courses.php"><i class="fa fa-fw fa-table"></i> Courses</a>
                    </li>
                    <li>
                        <a href="voting.php"><i class="fa fa-fw fa-desktop"></i> Voting</a>
                    </li>
                    <li>
                        <a href="groups.php"><i class="fa fa-fw fa-edit"></i> Groups</a>
                    </li>
                    <li>
                        <a href="track.php"><i class="fa fa-fw fa-bar-chart"></i> Tracking</a>
                    </li>
                    <?php if($is_admin): ?> 
                    <li class="active">
                        <a href="admin.php"><i class="fa fa-fw fa-dashboard"></i> Admin</a>
                    </li>
                    <?php endif ?>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <h2>Time Table</h2>
                        <div class="table-responsive">
                        <form method="post" action="set_timetable.php" role="form">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
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
                                <tbody>
                                    <tr>
                                        <td>Monday</td>
                                        <td style="width:100px;"><input type="text" name="mon1" value="hello" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="mon2" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="mon3" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="mon4" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="mon5" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="mon6" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="mon7" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="mon8" style="width:80px;"></td>
                                    </tr>
                                    <tr>
                                        <td>Tuesday</td>
                                        <td style="width:100px;"><input type="text" name="tue1" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="tue2" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="tue3" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="tue4" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="tue5" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="tue6" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="tue7" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="tue8" style="width:80px;"></td>
                                    </tr>
                                    <tr>
                                        <td>Wednesday</td>
                                        <td style="width:100px;"><input type="text" name="wed1" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="wed2" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="wed3" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="wed4" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="wed5" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="wed6" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="wed7" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="wed8" style="width:80px;"></td>
                                    </tr>
                                    <tr>
                                        <td>Thursday</td>
                                        <td style="width:100px;"><input type="text" name="thu1" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="thu2" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="thu3" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="thu4" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="thu5" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="thu6" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="thu7" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="thu8" style="width:80px;"></td>
                                    </tr>
                                    <tr>
                                        <td>Friday</td>
                                        <td style="width:100px;"><input type="text" name="fri1" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="fri2" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="fri3" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="fri4" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="fri5" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="fri6" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="fri7" style="width:80px;"></td>
                                        <td style="width:100px;"><input type="text" name="fri8" style="width:80px;"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" name="submit" id="submit" class="btn btn-success" style="width:150px;">Save</button>
                        </form>
                        </div>
                    </div>

                    <div class="col-lg-12">
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
                            echo "<h4><a href='course_detail.php?code=".$course[$i]['course_code']."'>".$course[$i]['course_name']."</a></h4>";
                            echo "<br>";
                            echo "</div>";
                        }
                        }
        
                    ?>
                    </div>

                    <div class="col-lg-12">
                        
                        <div class="col-lg-4">

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
                        
                        <h3> General Announcements </h3>
                        <a class="btn btn-primary" href="new_announcement.php">Add announcement</a>
                        
                        <br>
                        
                        <h3> Courses </h3>
                        <a class="btn btn-primary" href="new_course.php">Add Course</a>

                        <br>

                        <h3>Voting</h3>
                        <a class="btn btn-primary" href="new_vote_step1.php">Set Up a Vote</a>

                        </div>
                    </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->



        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
