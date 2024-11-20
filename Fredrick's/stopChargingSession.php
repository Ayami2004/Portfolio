<?php
session_start();
require("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION["charging_session_id"])) {
        //Acquiring the charging_session_id to identify the relevant record in the database
        $session_id = $_SESSION["charging_session_id"];
        $charger_id = $_SESSION["charger_id"];

        $charging_session_stop_q = "UPDATE `charging_sessions` SET `end_time` = NOW() WHERE `id` = '".$session_id."' AND `charger_id` = '".$charger_id."';";

        if ($connection->query($charging_session_stop_q) === TRUE) {
            echo "Charging session stopped successfully.";
            
        } else {
            echo "Error: " . $connection->error;
        }
    } else {
        echo "No active charging session found.";
    }
} else {
    echo "Invalid request method.";
}
?>