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

        $vote_id = $_GET['vote_id'];

        $sql_vote_details = "SELECT * from vote_details where vote_id = '$vote_id'";
        $result = $conn->query($sql_vote_details);
        $result_array = $result->fetch_assoc();
        $vote_title = $result_array["vote_title"];
        $option1 = $result_array["option1"];
        $option2 = $result_array["option2"];
        $option3 = $result_array["option3"];
        $option4 = $result_array["option4"];
        $option5 = $result_array["option5"];

        echo "<h1> ".$vote_title."</h1>";
        //echo $vote_id;

        echo "<form action = 'update_vote.php?vote_id=".$vote_id."' method='post'>";

        if($option1 != NULL)
            echo"<input type='radio' name='chosenOption' value='1'/>"." ".$option1."</br>";
        if($option2 != NULL)
            echo"<input type='radio' name='chosenOption' value='2'/>"." ".$option2."</br>";
        if($option3 != NULL)
            echo"<input type='radio' name='chosenOption' value='3'/>"." ".$option3."</br>";
        if($option4 != NULL)
            echo"<input type='radio' name='chosenOption' value='4'/>"." ".$option4."</br>";
        if($option5 != NULL)
            echo"<input type='radio' name='chosenOption' value='5'/>"." ".$option5."</br>";

        echo "<br>";

        echo"<button type='submit' id='submit' name='submit' class='btn btn-lg btn-success'>Vote</button>";
        echo"</form>"
    
    ?>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php endblock() ?>