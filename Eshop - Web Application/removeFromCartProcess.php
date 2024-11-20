<?php
    session_start();
    include("connection.php");

    if (isset($_SESSION)) {
        if (isset($_GET["id"])) {
            $cartId = $_GET["id"];

            Database::iud("DELETE FROM `cart` WHERE `cart_id` = '".$cartId."'");
            echo("Cart Item Deleted");
        } else {
            echo("Something went wrong");
        }
    } else {
        echo("Please Log in");
    }
?>