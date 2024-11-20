<?php

    require("connection.php");

    $pw = $_POST["pw"];
    $cpw = $_POST["cpw"];
    $vcode = $_POST["vc"];
    $email = $_POST["e"];

    if (empty($pw)) {
        echo("Please Enter New Password");
    } else if (strlen($pw) < 8) {
        echo("Password Must Contain More Than 8 Characters");
    } else if (strlen($pw) > 20) {
        echo("Password Must Contain Less Than 20 Characters");
    } else if (empty($cpw)) {
        echo("Please ReEnter Your Password");
    } else if (strlen($cpw) < 8) {
        echo("Password Must Contain More Than 8 Characters");
    } else if (strlen($cpw) > 20) {
        echo("Password Must Contain Less Than 20 Characters");
    } else if ($pw == $cpw) {
        $verify_q = Database::search("SELECT * FROM `user` WHERE `vcode` = '".$vcode."' AND `email` = '".$email."'");
        $rowCount = $verify_q->num_rows;
        if ($rowCount == 1) {
            $update_pw_q = Database::iud("UPDATE `user` SET `password` = '".$pw."' WHERE `email` = '".$email."' AND `vcode` = '".$vcode."'");
            echo("Success");
        } else {
            echo("Invalid Verification Code");
        }
    } else {
        echo("The Passwords Do Not Match");
    }
    
?>