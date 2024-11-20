<?php
    include("connection.php");
    if (isset($_GET["id"])) {
        $watchId = $_GET["id"];

        $watchListRS = Database::search("SELECT * FROM `watchlist` WHERE `watch_id` = '".$watchId."'");
        $count = $watchListRS->num_rows;

        if ($count == 1) {
            Database::iud("DELETE FROM `watchlist` WHERE `watch_id` = '".$watchId."'");
            echo("Deleted");
        } else {
            echo("Error");
        }
    }
?>