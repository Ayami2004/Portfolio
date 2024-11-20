<?php
    session_start();
    require("connection.php");

    $phone_q = "SELECT * from `contact` WHERE `user_id` = '".$_SESSION["u"]["id"]."';";
    $resultSet = $connection->query($phone_q);
    $resultData = $resultSet->fetch_assoc();
    $user_mobile = $resultData["mobile"];

    
    $totalPayable = $_SESSION["charging_cost"];
    $user_fname = $_SESSION["u"]["first_name"];
    $user_lname = $_SESSION["u"]["last_name"];
    $user_email = $_SESSION["u"]["email"];
    $user_phone = $_SESSION["u"]["email"];
    $merchant_id = 1227678;
    $order_id = $_SESSION["charging_session_id"];
    $merchant_secret = "MTMyOTQ5MTA0ODE0NDU3MjIwNDAzOTM1MjAyMTE5MjM4NDAyNDUz";
    $currency = "LKR";
    $item = "EV Charging Payment";

    $hash = strtoupper(
        md5(
            $merchant_id . 
            $order_id . 
            number_format($amount, 2, '.', '') . 
            $currency .  
            strtoupper(md5($merchant_secret)) 
        ) 
    );

    $array = [];

    $array["items"] = $item;
    $array["amount"] = $amount;
    $array["merchant_id"] = $merchant_id;
    $array["order_id"] = $order_id;
    $array["currency"] = $currency;
    $array["hash"] = $hash;
    $array["first_name"] = $user_fname;
    $array["last_name"] = $user_lname;
    $array["email"] = $email;
    $array["phone"] = $user_mobile;
    $array["address"] = "162/2, Yashodara Mawatha, Puwakwatta, Meegoda";
    $array["city"] = "Colombo";
    $array["country"] = "Sri Lanka";

    $json_pay = json_encode($array);
    echo($json_pay);

?>