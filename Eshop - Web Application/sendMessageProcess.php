<?php
session_start();
include "connection.php";

$loggedUser = $_SESSION["u"]["email"];
$receiver = $_POST["to"];
$msg = $_POST["msg"];

Database::iud("INSERT INTO `chat` (`content`, `msg_datetime`, `chat_status`, `to`, `from`) VALUES ('".$msg."', NOW(), '1', '".$receiver."', '".$loggedUser."')");
echo("Success");

?>