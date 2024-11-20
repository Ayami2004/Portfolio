<?php

  $fName = $_POST["f"];
  $lName = $_POST["l"];
  $nName = $_POST["n"];
  $password = $_POST["p"];
  $email = $_POST["e"];


 $connection= new mysqli("localhost","root","V@123Vishwa?","test","3306");

 if ($connection->connect_error) {
    echo("Connection Failed");
 }else{

   $q = "INSERT INTO `user`(`fname`,`lname`,`nname`,`password`,`email`)
    VALUES('".$fName."','".$lName."','".$nName."','".$password."','".$email."')";

    $connection->query($q);

    echo("User registration success");

 }


?>