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

    $course_code = $_GET['code'];

?>

<?php include 'base.php' ?>

<?php startblock('body') ?>


    <div class="col-lg-4">
            
        <br>
        <div class="login-panel panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Enter test details</h3>
            </div>
            <div class="panel-body">
                <?php echo"<form role='form' action = 'test_update.php?course_code=".$course_code."' method='post'>"; ?>
                    <fieldset>
                        <div class="form-group">
                            <label for="inputtopic">Test Name</label>
                            <input class="form-control" placeholder="Please enter the test name" name="testname" type="text">
                        </div>
                        <div class="form-group">
                            <label for="inputtopic">Marks Obtained</label>
                            <input class="form-control" placeholder="Please enter marks obtained" name="marks_obt" type="number">
                        </div>
                        <div class="form-group">
                            <label for="inputtopic">Max Marks</label>
                            <input class="form-control" placeholder="Please enter maximum marks" name="marks_total" type="number">
                        </div>

                        <button type="submit" id="submit" name="submit" class="btn btn-lg btn-success btn-block">Update</button>

                    </fieldset>
                </form>
            </div>
        </div>

        <br><br><br><br><br><br><br><br><br><br><br>
    </div>
    <div class="col-lg-8" id="myfirstchart" style="height:588px;"></div>


 
<?php endblock() ?>

<script type="text/javascript">
    
    new Morris.Bar({
      // ID of the element in which to draw the chart.
      element: 'myfirstchart',
      // Chart data records -- each entry in this array corresponds to a point on
      // the chart.

      <?php 
          $marks = array(); 
          $marks_sql = "SELECT * from test_data where course_code = '$course_code' and email = '$user_email'";
          $all_marks = $conn->query($marks_sql);
          while($row = $all_marks->fetch_assoc()) {
              $marks[] = $row;
          }

      ?>

      data: <?php echo json_encode($marks);?>,
      // The name of the data record attribute that contains x-values.
      xkey: 'testname',
      // A list of names of data record attributes that contain y-values.
      ykeys: ['percentage'],
      // Labels for the ykeys -- will be displayed when you hover over the
      // chart.
      labels: ['Percentage'],
    });

</script>