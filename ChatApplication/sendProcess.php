<?php

   session_start();

   $msg = $_POST["m"];
   $receiver = $_POST["r"];

   // echo($_SESSION["u"]["fname"]);

   $sender = $_SESSION["u"]["id"];

   $date = new DateTime();
   $datetimezone = new DateTimeZone("Asia/Colombo");
   $date->setTimezone($datetimezone);
   $finalDateTime = $date->format("Y-m-d H:i:s");

   $connection= new mysqli("localhost","root","V@123Vishwa?","test","3306");

   if ($connection->connect_error) {
      echo("Connection Failed");
   }else{

   $q = "INSERT INTO `chat`(`msg`,`sender`,`reciever`,`date`)
    VALUES('".$msg."','".$sender."','".$receiver."','".$finalDateTime."')";

    $connection->query($q);

    echo("Success");

   }

?>