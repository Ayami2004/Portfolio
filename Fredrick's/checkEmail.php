<?php
    require("connection.php");
    if ($connection->connect_error) {
        die("Connection Failed: ".$connection->connect_error);
    } else {
        if (isset($_POST["email"])) {
            $email = $connection->real_escape_string($_POST["email"]);
            $query = "SELECT * FROM `users` WHERE `email` = '".$email."';";
            $data = $connection->query($query);
            $count = $data->num_rows;
            if ($count > 0) {
                echo("Email Exists");
            } else {
                echo("Email Does Not Exist");
            }
        }
    }

    $connection->close();
?>