<?php

    session_start();

   $email = $_POST["e"];
   $password = $_POST["p"];

   //echo($email);
   //echo($password);

   $connection= new mysqli("localhost","root","V@123Vishwa?","test","3306");

   if ($connection->connect_error) {
      echo("Connection Failed");
   }else{

       $q = "SELECT * FROM `user` WHERE `email` = '".$email."' AND `password` = '".$password."'";

      $result = $connection->query($q);

      $row_count = $result->num_rows;

      if ($row_count == 1) {
           $data = $result->fetch_assoc();
           
           $_SESSION["u"] = $data;
           echo("Success");
      }else{
            echo("Invalid email or password");
      }
   
    }


?>