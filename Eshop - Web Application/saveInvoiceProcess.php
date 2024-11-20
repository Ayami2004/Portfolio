<?php
session_start();
include("connection.php");

if ($_SESSION["u"]) {
    if (isset($_POST["oid"])) {
        if (isset($_POST["pid"])) {
            if (isset($_POST["e"])) {
                if (isset($_POST["amount"])) {
                    if (isset($_POST["qty"])) {
                        $productId = $_POST["pid"];
                        $orderId = $_POST["oid"];
                        $userEmail = trim($_POST["e"]);
                        $amount = $_POST["amount"];
                        $qty = $_POST["qty"];

                        $productRS = Database::search("SELECT * FROM `product` WHERE `id` = '".$productId."'");
                        $productData = $productRS->fetch_assoc();
                
                        $currentQty = $productData["qty"];
                        $newQty = $currentQty - $qty;
                
                        Database::iud("UPDATE `product` SET `qty` = '".$newQty."' WHERE `id` = '".$productId."'");
                
                        Database::iud("INSERT INTO `invoice` (`order_id`, `invoice_datetime`, `total`, `invoice_qty`, `status`, `user_email`, `product_id`) VALUES ('".$orderId."', NOW(), '".$amount."', '".$qty."', '0', '".$userEmail."', '".$productId."')");
                        echo("Success");

                    } else {
                        echo ("Quantity is missing");
                    }
                } else {
                    echo ("Total Amount is missing");
                }
            } else {
                echo ("Email is missing");
            }
        } else {
            echo ("Product ID is missing");
        }
    } else {
        echo ("Order ID is missing");
    }
} else {
    echo ("Please Log In To Your Account");
}
