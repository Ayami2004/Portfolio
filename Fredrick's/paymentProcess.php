<?php
session_start();
require("connection.php");

$unitPattern = "/^\d+$/";

if (isset($_SESSION["charging_session_id"])) {
    $charging_session_id = $_SESSION["charging_session_id"];
    
    if (isset($_POST["vid"])) {
        $vehicleId = $_POST["vid"];
        $_SESSION["charging_session_vehicleno"] = $vehicleId;
    } else {
        $vehicleId = $_SESSION["charging_session_vehicleno"];
    }

    if (isset($_SESSION["charger_id"])) {
        $chargerId = $_SESSION["charger_id"];
        
        if (isset($_POST["u"])) {
            $unitsCount = $_POST["u"];
            
            if (preg_match($unitPattern, $unitsCount)) {
                // Query to get the rate per unit
                $cost_per_unit_q = "SELECT `rate_per_unit` FROM `charger_type` WHERE `type` IN (SELECT `charger_type` FROM `chargers` WHERE `id` = '" . $chargerId . "');";
                $resultSet = $connection->query($cost_per_unit_q);

                if ($resultSet) {
                    $rowCount = $resultSet->num_rows;
                    
                    if ($rowCount == 1) {
                        $resultData = $resultSet->fetch_assoc();
                        $costPerUnit = $resultData["rate_per_unit"];
                        $noOfUnits = intval($unitsCount);
                        $chargingCost = $costPerUnit * $noOfUnits;
                        
                        // Store charging cost in session
                        $_SESSION["charging_cost"] = $chargingCost;
                        
                        // Update charging session with vehicle ID and units consumed
                        $charging_session_update_q = "UPDATE `charging_sessions` SET `vehicle_id` = '" . $vehicleId . "', `units_consumed` = '" . $noOfUnits . "' WHERE `id` = '" . $charging_session_id . "'";
                        
                        if ($connection->query($charging_session_update_q)) {
                            // Insert payment record
                            $payment_q = "INSERT INTO `payments` (`session_id`, `amount`, `time`) VALUES ('" . $charging_session_id . "', '" . $chargingCost . "', NOW());";
                            
                            if ($connection->query($payment_q)) {
                                // Get the inserted payment ID
                                $payment_id = $connection->insert_id;
                                
                                // Update charging session with payment ID
                                $payment_update_q = "UPDATE `charging_sessions` SET `payment_id` = '" . $payment_id . "' WHERE `id` = '" . $charging_session_id . "'";
                                
                                if ($connection->query($payment_update_q)) {
                                    echo "Success";
                                } else {
                                    echo "Failed to update charging session with payment ID: " . $connection->error;
                                }
                            } else {
                                echo "Failed to insert payment record: " . $connection->error;
                            }
                        } else {
                            echo "Failed to update charging session: " . $connection->error;
                        }
                    } else {
                        echo "Charger type not found or multiple types found.";
                    }
                } else {
                    echo "Error executing cost per unit query: " . $connection->error;
                }
            } else {
                echo "Please enter a valid unit count.";
            }
        } else {
            echo "Please enter the number of units consumed during your charging session.";
        }
    } else {
        echo "Charger Id Not Found";
    }
} else {
    echo "No active charging session found.";
}
?>