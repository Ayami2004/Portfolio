<?php
session_start();
    include("connection.php");
    if (isset($_GET["id"])) {
        $productId = $_GET["id"];
        $userEmail = $_SESSION["u"]["email"];

        $watchListRS = Database::search("SELECT * FROM `watchlist` WHERE `product_id` = '".$productId."' AND `user_email` = '".$userEmail."'");
        $watchListCount = $watchListRS->num_rows;

        if ($watchListCount == 0) {
            Database::iud("INSERT INTO `watchlist` (`user_email`, `product_id`) VALUES ('".$userEmail."', '".$productId."');");
            echo("Added");
        } else if ($watchListCount == 1) {
            $watchListData = $watchListRS->fetch_assoc();
            $watchListID = $watchListData["id"];
            Database::iud("DELETE FROM `watchlist` WHERE `id` = '".$watchListID."'");
            echo("Removed");
        }
    } else {
        echo("No product has been selected to be added to the watchlist");
    }

?>