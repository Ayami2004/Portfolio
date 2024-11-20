<?php

    require("connection.php");

    $fname = $_POST["fn"];
    $lname = $_POST["ln"];
    $email = $_POST["e"];
    $pw = $_POST["pw"];
    $mobile = $_POST["m"];
    $gender = $_POST["g"];

    if (empty(trim($fname))) {
        echo("Please Enter Your First Name");
    } else if (strlen($fname) > 50) {
        echo("First Name Must Contain Less Than 50 Characters");
    } else if (empty(trim($lname))) {
        echo("Please Enter Your Last Name");
    } else if (strlen($lname) > 50) {
        echo("Last Name Must Contain Less Than 50 Characters");
    } else if (empty(trim($email))) {
        echo("Please Enter Your Email Address");
    } else if (strlen($email) > 100) { 
        echo("Email Address Must Contain Less Than 50 Characters");
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo("Please Enter a Valid Email Address");
    } else if (empty(trim($pw))) {
        echo("Please Enter a Password");
    } else if (strlen($pw) > 20) {
        echo("Your Password is Too Long");
    } else if (strlen($pw) < 8 ) {
        echo("Password Must Contain At Least 8 Characters");
    } else if (empty(trim($mobile))) {
        echo("Please Enter Your Mobile Number");
    } else if (strlen($mobile) != 10) {
        echo("Mobile Number Must Contain Exactly 10 Digits");
    } else if (!preg_match("/07[0,1,2,4,5,6,7,8]{1}[0-9]{7}/", $mobile)) {
        echo("Please Enter a Valid Mobile Number");
    } else if (empty(trim($gender)) || $gender == 0) {
        echo("Please Select Your Gender");
    } else {
        $resultSet = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."' OR `mobile` = '".$mobile."'");
        $rowCount = $resultSet->num_rows;
        if ($rowCount > 0) {
            echo("Your Email Address or Mobile Number Already Exists.");
        } else {
            $date = new DateTime();
            $timeZone = new DateTimeZone("Asia/Colombo");
            $date->setTimezone($timeZone);
            $dateFormat = $date->format("Y-m-d H:i:s");

            Database::iud("INSERT INTO `user` (`fname`, `lname`, `email`, `password`, `joined_date`, `gender_id`, `status_id`, `mobile`) VALUES ('".$fname."', '".$lname."', '".$email."', '".$pw."', '".$dateFormat."', '".$gender."', '1', '".$mobile."');");
            
            echo("Success");
        }
    }

?>