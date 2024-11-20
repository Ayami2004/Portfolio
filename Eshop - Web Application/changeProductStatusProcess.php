<?php
include("connection.php");
    $productId = $_GET["pid"];

    $productResultSet = Database::search("SELECT * FROM `product` WHERE `id` = '".$productId."'");

    if ($productResultSet->num_rows == 1) {
        $productData = $productResultSet->fetch_assoc();
        $productStatus = $productData["status_status_id"];

        if ($productStatus == 1) {
            Database::iud("UPDATE `product` SET `status_status_id` = '2' WHERE `id` = '".$productId."'");
            echo("Deactivated");
        } else if ($productStatus == 2) {
            Database::iud("UPDATE `product` SET `status_status_id` = '1' WHERE `id` = '".$productId."'");
            echo("Activated");
        }
    } else {
        echo("Something Went Wrong. Try Again Later");
    }
?>