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

    $code = $_GET['code'];

?>

<?php include 'base_dialog.php' ?>

<?php startblock('body') ?>

    <div style="margin-top:50px;" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <?php echo "<h3 class='panel-title'>Add Announcement - ".$code."</h3>"; ?>
            </div>
            <div class="panel-body">
                <?php echo "<form role='form' action = 'add_course_announcement.php?code=".$code."' method='post'>"; ?>
                    <fieldset>
                        <div class="form-group">
                            <label for="inputcourseann">Announcement</label>
                            <input class="form-control" placeholder="Please enter the announcement" name="course_announcement" type="text">
                        </div>
                        
                        <button type="submit" id="submit" name="submit" class="btn btn-lg btn-success btn-block">Save</button>

                    </fieldset>
                </form>
            </div>
        </div>
    </div>

<?php endblock() ?>