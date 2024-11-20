<?php

include "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST["e"])) {
  
  $email = $_POST["e"];

  $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email` = '".$email."'");
  $admin_num = $admin_rs->num_rows;

  if ($admin_num == 1) {
    $admin_data = $admin_rs->fetch_assoc();

    $code = uniqid();
    Database::iud("UPDATE `admin` SET `vcode`='".$code."' WHERE `email`='".$email."'");

    //EMAIL CODE
    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'tharanikashmi2k20@gmail.com';//sender's email
    $mail->Password = 'lpripnjebebgjaud';//app password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('tharanikashmi2k20@gmail.com', 'Verification Code');//sender's email, Sender's name
    $mail->addReplyTo('tharanikashmi2k20@gmail.com', 'Verification Code');//sender's email, Sender's name
    $mail->addAddress($email);//receiver's email
    $mail->isHTML(true);
    $mail->Subject = 'eShop Admin Login Verification Code';//Subject of the email
    $bodyContent = '<h1 style="color:red;">Your Verication Code is '.$code.'</h1>';//Content of the email
    $mail->Body    = $bodyContent;

    if(!$mail->send()){
      echo("Verification Code Sending Failed.");
    }else{
      echo("Success");
    }

  } else {
    echo("Invalid User.");
  }
  
} else {
  echo("Please Enter Your Email.");
}

?>