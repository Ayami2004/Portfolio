<?php

session_start();
include "connection.php";

if (isset($_SESSION["u"])) {
  
  $email = $_SESSION["u"]["email"];//Sender
  $msg = $_POST["m"];
  $email2; //Receiver

  if (isset($_POST["e"])) {
    $email2 = $_POST["e"];
  }

  $status = 0;

  $d = new DateTime();
  $tz = new DateTimeZone("Asia/Colombo");
  $d->setTimezone($tz);
  $date = $d->format("Y-m-d H:i:s");

  if (empty($email2)) {
    
    Database::iud("INSERT INTO `admin_chat`(`msg`,`msg_date`,`status`,`from`,`to`)VALUES
    ('".$msg."','".$date."','".$status."','".$email."','tharanikashmi2k20@gmail.com')");

    echo("Message sent to the Admin.");

  }else{

    Database::iud("INSERT INTO `admin_chat`(`msg`,`msg_date`,`status`,`from`,`to`)VALUES
    ('".$msg."','".$date."','".$status."','tharanikashmi2k20@gmail.com','".$email2."')");

    echo("Message Sent.");

  }

} else {

  echo("Please Login to your account.");
  
}


?>