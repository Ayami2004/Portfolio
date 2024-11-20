<?php

include "connection.php";
include "SMTP.php";
include "PHPMailer.php";
include "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST["e"])) {

    $email = $_POST["e"];
    
    $user_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $email . "'");
    $user_num = $user_rs->num_rows;

    if ($user_num == 1) {
        $code = uniqid();
        Database::iud("UPDATE `user` SET `vcode` = '".$code."' WHERE `email` = '".$email."'");

        //EMAIL CODE
        $mail = new PHPMailer(true);
        try {
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ayami13gum@gmail.com'; //sender email
            $mail->Password = 'ccrpkkdccmzaybwp'; //app password
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('ayami13gum@gmail.com', 'Reset Password');
            $mail->addReplyTo('ayami13gum@gmail.com', 'Reset Password');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'eShop forgot password Verification code'; //subject of the email
            $bodyContent = '<h1 style="color:red;">Verification code: '.$code.'</h1>';
            $mail->Body = $bodyContent;

            $mail->send();
            echo "Success";
        } catch (Exception $e) {
            echo "Verification Sending Failed. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Invalid Email Address";
    }

} else {
    echo "Please Enter your Email Address";
}

?>
