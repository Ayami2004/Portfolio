<?php
    $email = $_POST["email"];
    $pw = $_POST["pw"];

    if (trim(empty($email)) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo ("Please enter a valid email address");
    } else if (trim(empty($pw))) {
        echo ("Please enter a password");
    } else {
        echo("Success");
    }
?>