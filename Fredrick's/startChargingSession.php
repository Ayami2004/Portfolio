<?php
session_start();
require("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["chargerId"])) {
        $chargerId = $_POST["chargerId"];
        $user_id = $_SESSION["u"]["id"];

        $charging_session_start_q = "INSERT INTO `charging_sessions` (`start_time`, `user_id`, `charger_id`) VALUES (NOW(), '".$user_id."', '".$chargerId."');";

        if ($connection->query($charging_session_start_q) === TRUE) {
            echo "Charging session started successfully.";
            $session_id = $connection->insert_id;

            //Saving the charging_session_id fetched from the database in session variables
            $_SESSION["charging_session_id"] = $session_id;
            $_SESSION["charger_id"] = $chargerId;
        } else {
            echo "Error: " . $connection->error;
        }
    } else {
        echo "No charger ID received.";
    }
} else {
    echo "Invalid request method.";
}
?>