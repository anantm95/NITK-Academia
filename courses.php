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

    <title>NITK Academia </title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
                <a href="logout.php" >Sign Out</a>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Home</a>
                    </li>
                    <li class="active">
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
                    <li>
                        <a href="admin.php"><i class="fa fa-fw fa-dashboard"></i> Admin</a>
                    </li>
                    <?php endif ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper" style="background-color:#D6D6C1;">

            <div class="container-fluid">
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
                            			<a href='course_detail.php?code=".$course[$i]['course_code']."'>
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

    <!-- Flot Charts JavaScript -->
    <!--[if lte IE 8]><script src="js/excanvas.min.js"></script><![endif]-->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="js/plugins/flot/flot-data.js"></script>

</body>

</html>
