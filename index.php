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
        header("Location: login.php");
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
            <?php echo "<h2>Hello! Welcome to your class group, ".$class_user."!";?>
        </div>

        <div class="col-lg-8">
            <br><br>
            <br>
            <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-calendar fa-fw"></i><b> Time-Table</b></h3>
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
            <div class="panel panel-info">
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
<?php endblock() ?>