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
                    <li class="active">
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
                    <li>
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
                        <?php echo "<h2>Hello! Welcome to your class group, ".$class_user."";?>
                    </div>

                    <div class="col-lg-8">
                        <br><br>
                        <br>
                        <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-calendar fa-fw"></i> Time-Table</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
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
                                            <td>".$tt_result_assoc["mon1"]."</td>
                                            <td>".$tt_result_assoc["mon2"]."</td>
                                            <td>".$tt_result_assoc["mon3"]."</td>
                                            <td>".$tt_result_assoc["mon4"]."</td>
                                            <td>".$tt_result_assoc["mon5"]."</td>
                                            <td>".$tt_result_assoc["mon6"]."</td>
                                            <td>".$tt_result_assoc["mon7"]."</td>
                                            <td>".$tt_result_assoc["mon8"]."</td>
                                        </tr>
                                        <tr class='warning'>
                                            <td><b>Tuesday</b></td>
                                            <td>".$tt_result_assoc["tue1"]."</td>
                                            <td>".$tt_result_assoc["tue2"]."</td>
                                            <td>".$tt_result_assoc["tue3"]."</td>
                                            <td>".$tt_result_assoc["tue4"]."</td>
                                            <td>".$tt_result_assoc["tue5"]."</td>
                                            <td>".$tt_result_assoc["tue6"]."</td>
                                            <td>".$tt_result_assoc["tue7"]."</td>
                                            <td>".$tt_result_assoc["tue8"]."</td>
                                        </tr>
                                        <tr class='danger'>
                                            <td><b>Wednesday</b></td>
                                            <td>".$tt_result_assoc["wed1"]."</td>
                                            <td>".$tt_result_assoc["wed2"]."</td>
                                            <td>".$tt_result_assoc["wed3"]."</td>
                                            <td>".$tt_result_assoc["wed4"]."</td>
                                            <td>".$tt_result_assoc["wed5"]."</td>
                                            <td>".$tt_result_assoc["wed6"]."</td>
                                            <td>".$tt_result_assoc["wed7"]."</td>
                                            <td>".$tt_result_assoc["wed8"]."</td>
                                        </tr>
                                        <tr class='warning'>
                                            <td><b>Thursday</b></td>
                                            <td>".$tt_result_assoc["thu1"]."</td>
                                            <td>".$tt_result_assoc["thu2"]."</td>
                                            <td>".$tt_result_assoc["thu3"]."</td>
                                            <td>".$tt_result_assoc["thu4"]."</td>
                                            <td>".$tt_result_assoc["thu5"]."</td>
                                            <td>".$tt_result_assoc["thu6"]."</td>
                                            <td>".$tt_result_assoc["thu7"]."</td>
                                            <td>".$tt_result_assoc["thu8"]."</td>
                                        </tr>
                                        <tr class='success'>
                                            <td><b>Friday</b></td>
                                            <td>".$tt_result_assoc["fri1"]."</td>
                                            <td>".$tt_result_assoc["fri2"]."</td>
                                            <td>".$tt_result_assoc["fri3"]."</td>
                                            <td>".$tt_result_assoc["fri4"]."</td>
                                            <td>".$tt_result_assoc["fri5"]."</td>
                                            <td>".$tt_result_assoc["fri6"]."</td>
                                            <td>".$tt_result_assoc["fri7"]."</td>
                                            <td>".$tt_result_assoc["fri8"]."</td>
                                        </tr>
                                    </tbody>"
                                    ?>
                                </table>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!--
                    <div class="col-lg-4">
                        <br>
                        <br>
                    	<h3> General Announcements </h3>
                    	
                        <?php

                            $ann = array(); 
                            $ann_sql = "SELECT announcement from announcement where classname = '$class_user'";
                            $all_ann = $conn->query($ann_sql);
                            while($row = $all_ann->fetch_assoc()) {
                                $ann[] = $row;
                            }


                            if(count($ann) == 0)
                                echo "No annoucements";
                            else
                            { 
                                for($i=count($ann)-1;$i>=count($ann)-10;$i--   ) {
                                    echo $ann[$i]['announcement'];
                                    echo "<br>";
                                }
                            }
                            
                        ?>
                    </div> -->
                    <div class="col-lg-4">
                        <br>
                        <br>
                        <br>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Announcements</h3>
                            </div>
                            <div class="panel-body">
                                <div class="list-group">

                                <?php

                                    $ann = array(); 
                                    $ann_sql = "SELECT announcement from announcement where classname = '$class_user'";
                                    $all_ann = $conn->query($ann_sql);
                                    while($row = $all_ann->fetch_assoc()) {
                                        $ann[] = $row;
                                    }


                                    //if(count($ann) == 0)
                                    //    echo "No annoucements";
                                 
                                    for($i=0;$i<count($ann);$i++) {
                                        echo "<div href='#' class='list-group-item'>
                                        <span class='badge'>just now</span>
                                        <i class='fa fa-fw fa-check'></i>"." ".$ann[$i]['announcement']."</div>";
                                        echo "<br>";
                                    }
                                    
                                ?>
                                    
                                </div>
                                <div class="text-right">
                                    <a href="#">View All Announcements <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <br>
                        <br>
                        <?php
                            echo "<h2>".$class_user."'s Representatives</h2>";
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
