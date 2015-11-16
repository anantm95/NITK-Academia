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

    <h3>Attendance Tracker</h3>
 
<?php endblock() ?>