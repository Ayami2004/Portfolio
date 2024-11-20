<?php
session_start();
require("connection.php");
$user_id = $_SESSION["u"]["id"];
$fname = $_POST["f"];
$lname = $_POST["l"];
$nic = $_POST["n"];
$mobile = $_POST["m"];

$stmt = $connection->prepare("UPDATE `users` SET `first_name` = ?, `last_name` = ?, `nic` = ? WHERE `id` = ?");
$stmt->bind_param("sssi", $fname, $lname, $nic, $user_id);
$stmt->execute();
$stmt->close();

$stmt = $connection->prepare("UPDATE `contact` SET `mobile` = ? WHERE `user_id` = ?");
$stmt->bind_param("si", $mobile, $user_id);
$stmt->execute();
$stmt->close();

$query = "SELECT * FROM `users` WHERE `id` = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$updatedUser = $result->fetch_assoc();
$_SESSION["u"]["first_name"] = $updatedUser["first_name"];
$_SESSION["u"]["last_name"] = $updatedUser["last_name"];
$_SESSION["u"]["nic"] = $updatedUser["nic"];
$stmt->close();

$query = "SELECT * FROM `contact` WHERE `user_id` = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$updatedContact = $result->fetch_assoc();
$_SESSION["u"]["mobile"] = $updatedContact["mobile"];
$stmt->close();

echo ("Success");
?>