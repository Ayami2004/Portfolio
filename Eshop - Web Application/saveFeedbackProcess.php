<?php
    session_start();
    include("connection.php");

    if (isset($_SESSION)) {
        if (isset($_POST["id"])) {
            if (isset($_POST["feed"])) {
                if (isset($_POST["type"])) {
                    $email = $_SESSION["u"]["email"];
                    $type = $_POST["type"];
                    $feedback = $_POST["feed"];
                    $productId = $_POST["id"];

                    Database::iud("INSERT INTO `feedback` (`feed_datetime`, `feed_type`, `feed_msg`, `customer_email`, `feed_product_id`) VALUES (NOW(), '".$type."', '".$feedback."', '".$email."', '".$productId."')");
                    echo("Success");
                } else {
                    echo("Feedback type is missing");
                }
            } else {
                echo("Feedback is missing");
            }
        } else {
            echo("Product ID is missing");
        }
    } else {
        echo("Please Log In to Send Feedback");
    }
?>