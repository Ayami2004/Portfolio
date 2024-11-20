<?php
session_start();
require("connection.php");

$user_id = $_SESSION["u"]["id"];

$vehicle_nos = json_decode($_POST["vehicle_no"]);
$vehicle_models = json_decode($_POST["vehicle_model"]);
$deleted_vehicles = json_decode($_POST["deleted_vehicles"]);

// Insert or update vehicles
foreach ($vehicle_nos as $index => $vehicle_no) {
    $vehicle_no = $connection->real_escape_string($vehicle_no);
    $vehicle_model = $connection->real_escape_string($vehicle_models[$index]);

    // Check if vehicle exists
    $checkVehicleQuery = "SELECT * FROM `vehicles` WHERE `user_id`='$user_id' AND `vehicle_no`='$vehicle_no'";
    $result = $connection->query($checkVehicleQuery);

    if ($result->num_rows > 0) {
        // Update existing vehicle
        $updateVehicleQuery = "UPDATE `vehicles` SET `vehicle_model`='$vehicle_model' WHERE `user_id`='$user_id' AND `vehicle_no`='$vehicle_no'";
        $connection->query($updateVehicleQuery);
    } else {
        // Insert new vehicle
        $insertVehicleQuery = "INSERT INTO `vehicles` (`user_id`, `vehicle_no`, `vehicle_model`) VALUES ('$user_id', '$vehicle_no', '$vehicle_model')";
        $connection->query($insertVehicleQuery);
    }
}

// Handle deleted vehicles
foreach ($deleted_vehicles as $deleted_vehicle_no) {
    $deleted_vehicle_no = $connection->real_escape_string($deleted_vehicle_no);
    $deleteVehicleQuery = "DELETE FROM `vehicles` WHERE `user_id`='$user_id' AND `vehicle_no`='$deleted_vehicle_no'";
    $connection->query($deleteVehicleQuery);
}

$connection->close();

echo "Success";
?>