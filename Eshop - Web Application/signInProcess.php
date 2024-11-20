<?php

    session_start();

    require("connection.php");
    $email = $_POST["e"];
    $pw = $_POST["pw"];
    $rememberMe = $_POST["rm"];

    if (empty(trim($email))) {
        echo("Please Enter Your Email Address");
    } else if (strlen($email) > 100) {
        echo("Your Email Address is Too Long");
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo("Please Enter a Valid Email Address");
    } else if (empty(trim($pw))) {
        echo("Please Enter Your Password");
    } else if (strlen($pw) > 20) {
        echo("Your Password is Too Long");
    } else if (strlen($pw) < 8) {
        echo("Your Password is Too Short");
    } else {
        $resultSet = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."' AND `password` = '".$pw."';");
        $rowCount = $resultSet->num_rows;

        if ($rowCount === 1) {
            echo("Success");
            $data = $resultSet->fetch_assoc();
            $_SESSION["u"] = $data;

            if ($rememberMe == "true") {
                setcookie("email", $email, time()+(60*60*24*365));
                setcookie("password", $pw, time()+(60*60*24*365));
            }
        } else {
            echo("Invalid Email Address or Password");
        }
    }
?>