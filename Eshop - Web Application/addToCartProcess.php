<?php
session_start();
    include("connection.php");
    if ($_SESSION["u"]) {
        if (isset($_GET["id"])) {
            if (isset($_GET["qty"])) {
                $productId = $_GET["id"];
                $qty = $_GET["qty"];
                $userEmail = $_SESSION["u"]["email"];

                $cartRS = Database::search("SELECT * FROM `cart` WHERE `cart_user_email` = '".$userEmail."' AND `cart_product_id` = '".$productId."'");
                $cartCount = $cartRS->num_rows;

                if ($cartCount == 0) {
                    Database::iud("INSERT INTO `cart` (`cart_qty`, `cart_user_email`, `cart_product_id`) VALUES ('1', '".$userEmail."', '".$productId."' );");
                    echo("Product Added to Cart");
                } else if ($cartCount == 1) {
                    $cartData = $cartRS->fetch_assoc();
                    $currentQty = $cartData["cart_qty"];
                    $newQty = (int)$currentQty + 1;
                    if ($currentQty <= $qty) {
                        Database::iud("UPDATE `cart` SET `cart_qty` = '".$newQty."' WHERE `cart_user_email` = '".$userEmail."' AND `cart_product_id` = '".$productId."'");
                        echo("Qty Updated");
                    } else {
                        echo("Not enough Stock");
                    }
                }
            } else {
                echo("Something went wrongx");
            }
            
        } else {
            echo("Something went wrong");
        }
    } else {
        echo("Please Log in To Your Account");
    }
?>